<?php

namespace App\Http\Controllers\Api\BaseController\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BaseRequest\Employee\AppointmentRequest;
use App\Http\Resources\Api\BaseResource\Employee\AppointmentResource;
use App\Http\Resources\Api\BaseResource\Employee\AppointmentResourceCollection;
use App\Models\BaseModels\Employees\Appointment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

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
     * @return Application|ResponseFactory|Response
     */
    public function index(): Response|Application|ResponseFactory
    {
        return response(new AppointmentResourceCollection(Appointment::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AppointmentRequest $request
     * @return Response
     */
    public function store(AppointmentRequest $request): Response
    {
        Appointment::create($request->validated());
        return response(['message' => 'Должность успешно создана']);
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
     * @param AppointmentRequest $request
     * @param Appointment $appointment
     * @return Response
     */
    public function update(AppointmentRequest $request, Appointment $appointment): Response
    {
        $appointment->update($request->validated());
        return response(['message' => 'Должность успешно обновлена']);
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
