<?php

namespace App\Http\Controllers\BaseController;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest\StoreOrganizationRequest;
use App\Http\Requests\BaseRequest\UpdateOrganizationRequest;
use App\Http\Resources\BaseResource\OrganizationResource;
use App\Http\Resources\BaseResource\OrganizationResourceCollection;
use App\Models\BaseModel\Organization;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrganizationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Organization::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response(new OrganizationResourceCollection(Organization::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrganizationRequest $request
     * @return Response
     */
    public function store(StoreOrganizationRequest $request): Response
    {
        Organization::create($request->validated());
        return response(['message' => 'Организация создана']);
    }

    /**
     * Display the specified resource.
     *
     * @param Organization $organization
     * @return Response
     */
    public function show(Organization $organization): Response
    {
        return response(new OrganizationResource($organization));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrganizationRequest $request
     * @param Organization $organization
     * @return Response
     */
    public function update(UpdateOrganizationRequest $request, Organization $organization): Response
    {
        $organization->update($request->validated());
        return \response(['message' => 'Организация успешно обновлена']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Organization $organization
     * @return Response
     */
    public function destroy(Organization $organization): Response
    {
        $organization->delete();
        return response(['message' => 'Организация удалена']);
    }
}
