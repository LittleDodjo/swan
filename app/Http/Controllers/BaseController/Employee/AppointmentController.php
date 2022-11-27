<?php

namespace App\Http\Controllers\BaseController\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest\Employee\StoreAppointmentRequest;
use App\Http\Requests\BaseRequest\Employee\UpdateAppointmentRequest;
use App\Http\Resources\BaseResource\Employee\AppointmentResource;
use App\Http\Resources\BaseResource\Employee\AppointmentResourceCollection;
use App\Models\BaseModel\Employee\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AppointmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Appointment::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response(new AppointmentResourceCollection(Appointment::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAppointmentRequest $request
     * @return Response
     */
    public function store(StoreAppointmentRequest $request): Response
    {
        Appointment::create($request->validated());
        return response(['message' => 'Должность создана']);
    }

    /**
     * Display the specified resource.
     *
     * @param Appointment $appointment
     * @return Response
     */
    public function show(Appointment $appointment): Response
    {
        return response(new AppointmentResource($appointment));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAppointmentRequest $request
     * @param Appointment $appointment
     * @return Response
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment): Response
    {
        $appointment->update($request->validated());
        return response(['message' => 'Должность обновлена']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Appointment $appointment
     * @return Response
     */
    public function destroy(Appointment $appointment): Response
    {
        $appointment->delete();
        return response(['message' => 'Должность удалена']);
    }
}
