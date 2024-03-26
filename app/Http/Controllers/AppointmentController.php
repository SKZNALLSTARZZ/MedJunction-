<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentAddRequest;
use App\Http\Requests\AppointmentUpdateRequest;

class AppointmentController extends Controller
{
    public function index()
    {
        try {
            $appointments = Appointment::all();
            return response()->json(['data' => $appointments]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $appointment = Appointment::findOrFail($id);
            return response()->json(['data' => $appointment]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(AppointmentAddRequest $request)
    {
        try {
            $appointment = new Appointment();
            $appointment->fill($request->validated());
            $appointment->save();

            return response()->json([
                'status_code' => 201,
                'status_message' => 'Appointment created successfully',
                'data' => $appointment
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(AppointmentUpdateRequest $request, $id)
    {
        try {
            $appointment = Appointment::find($id);
            $appointment->fill($request->validated());
            $appointment->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Appointment updated successfully',
                'data' => $appointment
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $appointment = Appointment::findOrFail($id);
            $appointment->delete();

            return response()->json(['status_message' => 'Appointment deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
