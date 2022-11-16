<?php

namespace App\Http\Controllers\Api\BaseController\Departaments;

use App\Http\Controllers\Controller;
use App\Models\BaseModels\Departaments\Departament;
use App\Models\BaseModels\Departaments\EmployeeDepartament;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Pivots\DepartamentToEmployees;
use App\Models\BaseModels\Pivots\EmployeeDepartamentsToEmployee;
use App\Models\BaseModels\Pivots\EmployeeToEmployeeDepency;
use App\Models\BaseModels\Pivots\ManagmentToDepartaments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;


class DepartamentController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth:api');
    }


    public function newDepartament(Request $request)
    {

    }
}
