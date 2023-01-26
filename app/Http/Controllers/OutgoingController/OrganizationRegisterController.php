<?php

namespace App\Http\Controllers\OutgoingController;

use App\Http\Controllers\Controller;
use App\Http\Requests\OutgoingRequest\StoreOrganizationRegisterRequest;
use App\Http\Requests\OutgoingRequest\UpdateOrganizationRegisterRequest;
use App\Http\Resources\OutgoingResource\OrganizationRegisterResource;
use App\Http\Resources\OutgoingResource\OrganizationRegisterResourceCollection;
use App\Models\OutgoingModel\OrganizationRegister;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrganizationRegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(OrganizationRegister::class, 'correspondent');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response(new OrganizationRegisterResourceCollection(OrganizationRegister::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrganizationRegisterRequest $request
     * @return Response
     */
    public function store(StoreOrganizationRegisterRequest $request): Response
    {
        OrganizationRegister::create($request->validated());
        return response(['message' => 'Организация добавлена в реестр']);
    }

    /**
     * Display the specified resource.
     *
     * @param OrganizationRegister $correspondent
     * @return Response
     */
    public function show(OrganizationRegister $correspondent): Response
    {
        return response(new OrganizationRegisterResource($correspondent));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrganizationRegisterRequest $request
     * @param OrganizationRegister $correspondent
     * @return Response
     */
    public function update(UpdateOrganizationRegisterRequest $request, OrganizationRegister $correspondent): Response
    {
        $correspondent->update($request->validated());
        return response(['message' => 'Данные организации обновлены']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param OrganizationRegister $correspondent
     * @return Response
     */
    public function destroy(OrganizationRegister $correspondent): Response
    {
        $correspondent->delete();
        return response(['message' => 'Организация удалена из реестра']);
    }
}
