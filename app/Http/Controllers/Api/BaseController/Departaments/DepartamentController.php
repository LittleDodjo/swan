<?php

namespace App\Http\Controllers\Api\BaseController\Departaments;

use App\Http\Controllers\Controller;
use App\Models\BaseModels\Departaments\Departament;
use App\Models\BaseModels\Departaments\EmployeeDepartament;
use Illuminate\Http\Request;

class DepartamentController extends Controller
{

    private $departament_types = [
        'c_dep' => Departament::class,
        'e_dep' => [
            'model' => EmployeeDepartament::class,
            ],
    ];

    public function __construct(){
        $this->middleware('auth:api');
    }


    public function newDepartament(Request $request){

    }

    public function getDepartament(Request $request, $id){

    }

    public function getAllDepartaments(Request $request){

    }

}
