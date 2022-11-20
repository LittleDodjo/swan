<?php

namespace App\Http\Controllers\Api\BaseController;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BaseResource\OrganizationResource;
use App\Http\Resources\Api\BaseResource\OrganizationResourceCollection;
use App\Models\BaseModels\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrganizationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => 'show']);
        $this->authorizeResource(Organization::class, 'organization');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        $organizations = new OrganizationResourceCollection(
            Organization::all()
        );
        return response()->json($organizations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        return response()->json(new OrganizationResource($organization));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
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
            return response()->json($validator->errors(), 400);
        }
//        $organization->update($validator->validated());
        return response()->json(['message' => 'Организация успешно изменена']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        $organization->delete();
        return response()->json(['message' => 'Организация успешно удалена']);
    }
}
