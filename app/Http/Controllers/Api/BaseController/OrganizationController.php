<?php

namespace App\Http\Controllers\Api\BaseController;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BaseRequest\OrganizationRequest;
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
     * @param OrganizationRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(OrganizationRequest $request)
    {
        $organization = Organization::create($request->validated());
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
     * @param OrganizationRequest $request
     * @param Organization $organization
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(OrganizationRequest $request, Organization $organization)
    {
        $organization->update($request->validated());
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
