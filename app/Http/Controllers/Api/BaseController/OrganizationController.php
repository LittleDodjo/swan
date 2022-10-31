<?php

namespace App\Http\Controllers\Api\BaseController;

use App\Http\Controllers\Controller;
use App\Models\BaseModels\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrganizationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    public function newOrganization(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'short_name' => 'required',
            ], [
                'name.required' => 'Необходимо указать имя организации',
                'short_name.required' => 'Необходимо указать короткое имя организации'
            ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ], 400);
        }
        $organization = Organization::create($validator->validated());
        return response()->json([
            'message' => 'Организация успешно создана',
            'data' => $organization,
        ], 201);
    }

    public function updateOrganization()
    {

    }

    public function deleteOrganization()
    {

    }

    public function viewOrganization()
    {

    }

    public function viewAllOrganizations()
    {

    }


}
