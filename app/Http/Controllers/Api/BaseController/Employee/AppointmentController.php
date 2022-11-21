<?php

namespace App\Http\Controllers\Api\BaseController\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BaseRequest\Employee\AppointmentRequest;
use App\Http\Resources\Api\BaseResource\Employee\AppointmentResource;
use App\Http\Resources\Api\BaseResource\Employee\AppointmentResourceCollection;
use App\Models\BaseModels\Employees\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AppointmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Appointment::class, 'appointment');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index()
    {
        return response(new AppointmentResourceCollection(Appointment::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentRequest $request)
    {
        Appointment::create($request->validated());
        return response(['message' => 'Должность успешно создана']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\BaseModels\Employees\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        return response(new AppointmentResource($appointment));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BaseModels\Employees\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->validated());
        return response(['message' => 'Должность успешно обновлена']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\BaseModels\Employees\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return response(['message' => 'Должность удалена']);
    }
}
