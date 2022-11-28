<?php

namespace App\Http\Controllers\BaseController\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest\Employee\StoreDefaultRequest;
use App\Http\Requests\BaseRequest\Employee\UpdateDefaultRequest;
use App\Http\Resources\BaseResource\Employee\DefaultResource;
use App\Http\Resources\BaseResource\Employee\DefaultResourceCollection;
use App\Models\BaseModel\Employee\Employee;
use App\Models\BaseModel\Employee\EmployeeDefaults;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class EmployeeDefaultsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(EmployeeDefaults::class, 'default');
    }

    /**
     * Просмотр всех отсутствий всех сотрудников
     *
     * @return Response
     */
    public function index(): Response
    {
//        $this->authorize('viewAny');
        return response(
            new DefaultResourceCollection(EmployeeDefaults::paginate(50))
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDefaultRequest $request
     * @return Response
     */
    public function store(StoreDefaultRequest $request): Response
    {
//        $this->authorize('create');
        EmployeeDefaults::create($request->validated());
        return \response($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param EmployeeDefaults $default
     * @return Response
     */
    public function show(EmployeeDefaults $default): Response
    {
//        $this->authorize('view', $default);
        return response(new DefaultResource($default));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDefaultRequest $request
     * @param EmployeeDefaults $default
     * @return Response
     */
    public function update(UpdateDefaultRequest $request, EmployeeDefaults $default): Response
    {
        $default->update($request->validated());
        return \response(['message' => 'Отсутствие успешно обновлено']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EmployeeDefaults $default
     * @return Response
     */
    public function destroy(EmployeeDefaults $default): Response
    {
        $default->delete();
        return response(['message' => 'Причина удалена']);
    }
}
