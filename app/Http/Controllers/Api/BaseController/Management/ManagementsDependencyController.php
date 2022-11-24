<?php

namespace App\Http\Controllers\Api\BaseController\Management;

use App\Http\Controllers\Controller;
use App\Models\BaseModels\Managements\Management;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManagementsDependencyController extends Controller
{
    /**
     * Отобразить зависимости управлений
     *
     * @return Response
     */
    public function index(): Response
    {
        return \response(Management::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Management $management
     * @return Response
     */
    public function show(Management $management): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        //
    }
}
