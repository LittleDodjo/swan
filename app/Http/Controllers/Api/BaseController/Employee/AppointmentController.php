<?php

namespace App\Http\Controllers\Api\BaseController\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BaseResource\Employee\AppointmentResource;
use App\Http\Resources\Api\BaseResource\Employee\AppointmentResourceCollection;
use App\Models\BaseModels\Employees\Appointment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth:api');
    }

    public function newAppointment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'caption' => 'required',
        ], [
            'caption.required' => 'Необходимо указать наименование должности'
        ]);
        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 400);
        }
        $data = $request->all();
        $appointment = new Appointment();
        $appointment->caption = $data['caption'];
        if (isset($data['short_name'])) $appointment->short_name = $data['short_name'];
        if (isset($data['is_manager'])) $appointment->short_name = $data['is_manager'];
        if (isset($data['is_primary_manager'])) $appointment->short_name = $data['is_primary_manager'];
        $appointment->save();
        return response()->json(['message' => 'Должность создана'], 201);
    }

    public function deleteAppointment(Request $request, $id)
    {
        $appointment = Appointment::find($id);
        if ($appointment == null) {
            return response()->json(['message' => 'Такой должности не существует'], 404);
        }
        $appointment->delete();
        return response()->json(['message' => 'Должность удалена'], 200);
    }

    public function viewAppointment(Request $request, $id)
    {
        $appointment = Appointment::find($id);
        if ($appointment == null) {
            return response()->json(['message' => 'Такой должности не существует'], 404);
        }
        $data = new AppointmentResource(
            $appointment
        );
        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function viewAllAppointment(Request $request)
    {
        return response()->json([
            'data' => new AppointmentResourceCollection(
                Appointment::all()
            )
        ], 200);
    }

    public function updatePrimaryManager(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'is_primary_manager' => 'required|boolean',
            'id' => 'required|integer',
        ], [
            'is_primary_manager.required' => 'Необходимо указать статус',
            'is_primary_manager.boolean' => 'Неверный формат данных',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $appointment = Appointment::find($request->all()['id']);
        if ($appointment == null) {
            return response()->json(['message' => 'Такой должности не существует'], 404);
        }
        $appointment->is_primary_manager = $request->all()['is_primary_manager'];
        $appointment->save();
        return response()->json([
            'message' => 'Статус руководителя изменен',
        ], 200);
    }

    public function updateManager(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'is_manager' => 'required|boolean',
            'id' => 'required|integer',
        ], [
            'is_manager.required' => 'Необходимо указать статус',
            'is_manager.boolean' => 'Неверный формат данных',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $appointment = Appointment::find($request->all()['id']);
        if ($appointment == null) {
            return response()->json(['message' => 'Такой должности не существует'], 404);
        }
        $appointment->is_manager = $request->all()['is_manager'];
        $appointment->save();
        return response()->json([
            'message' => 'Статус заместителя изменен',
        ], 200);
    }

    public function updateCaption(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'caption' => 'required',
            'id' => 'required|integer',
        ], [
            'caption.required' => 'Необходимо указать наименование должности',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $appointment = Appointment::find($request->all()['id']);
        if ($appointment == null) {
            return response()->json(['message' => 'Такой должности не существует'], 404);
        }
        $appointment->caption = $request->all()['caption'];
        $appointment->save();
        return response()->json(['message' => 'Наименование должности изменено'], 200);
    }

    public function updateShortName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'short_name' => 'required',
            'id' => 'required|integer',
        ], [
            'short_name.required' => 'Необходимо указать короткое наименование должности',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $appointment = Appointment::find($request->all()['id']);
        if ($appointment == null) {
            return response()->json(['message' => 'Такой должности не существует'], 404);
        }
        $appointment->short_name = $request->all()['short_name'];
        $appointment->save();
        return response()->json(['message' => 'Короткое наименование изменено'], 200);
    }

}
