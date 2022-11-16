<?php

namespace App\Http\Controllers\Api\BaseController;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BaseResource\OrganizationResource;
use App\Http\Resources\Api\BaseResource\OrganizationResourceCollection;
use App\Models\BaseModels\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrganizationController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth:api', ['except' => ['viewOrganization', 'viewAllOrganizations']]);
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

    public function updateOrganization(Request $request, $id)
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
        $organization = Organization::find($id);
        if($organization == null){
            return response()->json(['message' => 'Такая организация не найдена'], 404);
        }
        $organization = Organization::find($id);
        $organization->name = $request->all()['name'];
        $organization->short_name = $request->all()['short_name'];
        $organization->save();
        return response()->json(['message' => 'Организация успешно изменена'],200);
    }

    public function deleteOrganization($id)
    {
        $organization = Organization::find($id);
        if($organization == null){
            return response()->json(['message' => 'Такая организация не найдена'], 404);
        }
        $organization->delete();
        return response()->json(['message' => 'Организация успешно удалена'], 200);
    }

    public function viewOrganization($id)
    {
        $organization = Organization::find($id);
        if($organization == null){
            return response()->json(['message' => 'Такая организация не найдена'], 404);
        }
        $organization = new OrganizationResource(
            Organization::find($id)
        );
        return response()->json(['data' => $organization], 200);
    }

    public function viewAllOrganizations()
    {
        $data = new OrganizationResourceCollection(
            Organization::all()
        );
        return response()->json( ['data'=> $data], 200);
    }

}
