<?php

namespace App\Http\Controllers\BaseController\Department;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource\Pivot\AllDepartmentResourceCollection;
use App\Models\BaseModel\Pivot\AllDepartment;
use Illuminate\Http\Response;

class AllDepartmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * Выводит полный список всех отделов
     * @return Response
     */
    public function index(): Response
    {
        return response(new AllDepartmentResourceCollection(AllDepartment::all()));
    }
}
