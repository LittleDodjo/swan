<?php

namespace App\Http\Controllers\Outgoing;

use App\Http\Controllers\Controller;
use App\Models\Outgoing\OrganizationRegister;
use Illuminate\Http\Request;

class OrganizationRegisterController extends Controller
{

    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Outgoing\OrganizationRegister $organizationRegister
     * @return \Illuminate\Http\Response
     */
    public function show(OrganizationRegister $organizationRegister)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Outgoing\OrganizationRegister $organizationRegister
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrganizationRegister $organizationRegister)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Outgoing\OrganizationRegister $organizationRegister
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrganizationRegister $organizationRegister)
    {
        //
    }
}
