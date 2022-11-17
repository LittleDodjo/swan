<?php

namespace App\Http\Controllers\Api\BaseController\Departaments;

use App\Http\Controllers\Controller;
use App\Models\BaseModels\Departaments\Departament;
use App\Models\BaseModels\Departaments\EmployeeDepartament;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Managments\Managment;
use App\Models\BaseModels\Pivots\DepartamentToEmployees;
use App\Models\BaseModels\Pivots\EmployeeDepartamentsToEmployee;
use App\Models\BaseModels\Pivots\EmployeeToEmployeeDepency;
use App\Models\BaseModels\Pivots\ManagmentToDepartaments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;


class DepartamentController extends Controller
{

    public $config = [
        'mdep' => [
            'model' => Departament::class,
            'depends_model' => Managment::class,
            'depends_key' => 'managment_depends',
            'pivot_table' => ManagmentToDepartaments::class,
            'pivot_key' => 'departament_id',
            'pivot_employees_table' => DepartamentToEmployees::class,
        ],
        'edep' => [
            'model' => EmployeeDepartament::class,
            'depends_model' => Employee::class,
            'depends_key' => 'employee_depends',
            'pivot_table' => EmployeeToEmployeeDepency::class,
            'pivot_key' => 'employee_id',
            'pivot_employees_table' => EmployeeDepartamentsToEmployee::class,
        ],
        'all_table' => [
            'mdep' => 'departament_id',
            'edep' => 'employee_departament_id',
        ],
    ];

    public function __construct()
    {
//        $this->middleware('auth:api');
    }


    public function newDepartament(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'caption' => 'required|string',
            'short_name' => 'required|string',
            'display_number' => 'required|string',
            'employee_primary_manager_id' => 'required|integer',
            'type' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }
        $type = $request->all()['type'];
        $model = $this->config[$type]['model'];
        $key = $this->config[$type]['depends_key'];
        $departament = new $model(
            $validator->validated()
        );
        $departament->$key = $request->all()[$key];
        return response()->json([$departament, $request->all()[$key], $key], 200);
    }


    private function appendDepency($pivotModel, $key, $id){

    }

}
