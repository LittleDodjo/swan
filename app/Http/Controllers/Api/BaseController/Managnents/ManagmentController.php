<?php

namespace App\Http\Controllers\Api\BaseController\Managnents;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BaseResource\Departament\DepartamentResource;
use App\Http\Resources\Api\BaseResource\Managment\ManagmentResource;
use App\Http\Resources\Api\BaseResource\Managment\ManagmentResourceCollection;
use App\Http\Resources\Api\BaseResource\Pivots\DepartamentsToManagmentResource;
use App\Http\Resources\Api\BaseResource\Pivots\DepartamentsToManagmentResourceCollection;
use App\Models\BaseModels\Departaments\Departament;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Managments\Managment;
use App\Models\BaseModels\Pivots\DepartamentsToManagment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManagmentController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth:api');
    }

    public function newManagment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_depends_id' => 'required',
            'employee_manager_id' => 'required',
            'caption' => 'required',
        ], [
            'employee_depends_id.required' => 'Необходимо указать зависимого человека',
            'employee_manager_id.required' => 'Необходимо указать руководителя',
            'caption' => 'Необходимо указать наименование',
        ]);
        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 400);
        }
        $managment = new Managment($validator->validated());
        $managment->save();
        return response()->json(['message' => 'Управление создано'], 201);
    }

    public function deleteManagment(Request $request, $id)
    {
        $managment = Managment::find($id);
        if ($managment == null) {
            return response()->json(['message' => 'Такое управление не найдено'], 404);
        }
        $managment->delete();
        return response()->json(['message' => 'Управление удалено'], 200);
    }

    public function viewManagment(Request $requestm, $id)
    {
        $managment = Managment::find($id);
        if ($managment == null) {
            return response()->json(['message' => 'Такое управление не найдено'], 404);
        }
        return response()->json(new ManagmentResource($managment), 200);
    }

    public function viewAllManagments(Request $request)
    {
        $managment = new ManagmentResourceCollection(Managment::all());
        return response()->json($managment, 200);
    }

    public function changeEmloyeeDepends(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
        ], [
            'employee_id.required' => 'Необходим идентификатор сотрудника'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $employee = Employee::find($validator->all()['employee_id']);
        $managment = Managment::find($id);
        $managment->save();
        if ($employee == null || $managment == null) {
            return response()->json(['message' => 'такие данные не найдены'], 404);
        }
        $managment->employee_depends_id = $employee->id;
        return response()->json(['message' => 'Зависимость изменена'], 200);
    }

    public function changeEmployeeManager(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
        ], [
            'employee_id.required' => 'Необходим идентификатор сотрудника'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $employee = Employee::find($validator->all()['employee_id']);
        $managment = Managment::find($id);
        if ($employee == null || $managment == null) {
            return response()->json(['message' => 'такие данные не найдены'], 404);
        }
        $managment->employee_manager_id = $employee->id;
        $managment->save();
        return response()->json(['message' => 'Руководитель изменен'], 200);
    }

}
