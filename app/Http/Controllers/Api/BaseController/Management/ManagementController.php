<?php

namespace App\Http\Controllers\Api\BaseController\Management;

use App\Http\Controllers\Api\BaseHelper\DependencyHelper;
use App\Http\Controllers\Api\BaseProvider\DependencyProvider;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BaseRequest\Management\ManagementRequest;
use App\Http\Requests\Api\BaseRequest\Management\ManagementUpdateRequest;
use App\Http\Resources\Api\BaseResource\Management\ManagementResource;
use App\Http\Resources\Api\BaseResource\Management\ManagementResourceCollection;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Managements\Management;
use Illuminate\Http\Response;

class ManagementController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Management::class, 'management');
    }

    /**
     * Отобразить все управления
     *
     * @return Response
     */
    public function index(): Response
    {
        return response(new ManagementResourceCollection(Management::all()));
    }

    /**
     * Создать управление, сделать привязку сотрудников, отправить ответ
     * @param ManagementRequest $request
     * @return Response
     */
    public function store(ManagementRequest $request): Response
    {
        $dependsEmployee = Employee::find($request->employee_depends_id); // Ведомый сотрудник
        $primaryEmployee = Employee::find($request->employee_manager_id); //Руководитель управления
        if ($dependsEmployee == null || $primaryEmployee == null) {
            return response(['message' => 'Сотрудник не найден'], 404);
        }
        if ($primaryEmployee->is($dependsEmployee)) {
            return response(['message' => 'Нельзя выполнить привязку одинаковых сотрудников'], 400);
        }
        if (!DependencyProvider::checkManagementManager($primaryEmployee->rank)) {
            return response(['message' => 'Нельзя выполнить привязку к сотруднику такого ранга'], 400);
        }
        if (!DependencyProvider::checkManagementDependency($dependsEmployee->rank)) {
            return response(['message' => 'Данного сотрудника нельзя назначить руководителем управления'], 400);
        }
        $management = Management::create($request->validated());
        $primaryEmployee->employeeDependency->update(['management_id' => $management->id]);
        $primaryEmployee->employeeDependency->update(['employee_id' => $dependsEmployee->id]);
        return response(['message' => 'Управление создано'], 201);
    }

    /**
     * Отобразить управление по id
     *
     * @param Management $management
     * @return Response
     */
    public function show(Management $management): Response
    {
        return response(new ManagementResource($management));
    }

    /**
     * Обновить данные управления
     *
     * @param ManagementUpdateRequest $request
     * @param Management $management
     * @return Response
     */
    public function update(ManagementUpdateRequest $request, Management $management): Response
    {
        $dependsEmployee = Employee::find($request->employee_depends_id); // ведомый сотрудник
        $primaryEmployee = Employee::find($request->employee_manager_id); // начальник управления
        $except = [];
        if ($dependsEmployee != null) {
            if (!DependencyProvider::checkManagementDependency($dependsEmployee->rank)) {
                $except[] = 'employee_depends_id';
            }
        }
        if ($primaryEmployee != null) {
            if (!DependencyProvider::checkManagementManager($primaryEmployee->rank)) {
                $except[] = 'employee_manager_id';
            }
            DependencyHelper::updateManagementDependency($management, $primaryEmployee->id);
        }
        $management->update($request->safe()->except($except));
        return \response(['message' => 'Управление обновлено']);
    }

    /**
     * Удалить управление
     *
     * @param Management $management
     * @return Response
     */
    public function destroy(Management $management): Response
    {
        $primaryEmployee = Employee::find($management->employee_manager_id);
        $primaryEmployee->employeeDependency->update([
            'management_id' => null,
            'employee_id' => null,
        ]);
        $management->delete();
        return response(['message' => 'Управление удалено']);
    }
}
