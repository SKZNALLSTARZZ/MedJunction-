<?php

namespace App\Http\Controllers;


use Exception;
use App\Models\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorAddRequest;
use App\Http\Requests\DoctorUpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DoctorController extends Controller
{
    public function index()
    {
        try {
            $doctors = Doctor::all();
            return response()->json(['data' => $doctors]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $doctor = Doctor::findOrFail($id);
            return response()->json(['data' => $doctor]);
        }  catch (Exception $e) {
            return response()->json(['error' => 'Employee not found.'], 404);
        }
    }

    public function store(DoctorAddRequest $request)
    {
        try {
            $doctor = new Doctor();
            $doctor->fill($request->validated());
            $doctor->save();

            return response()->json([
                'status_code' => 201,
                'status_message' => 'Doctor created successfully',
                'data' => $doctor
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(DoctorUpdateRequest $request, $id)
    {
        try {
            $doctor = Doctor::find($id);
            $doctor->fill($request->validated());
            $doctor->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Doctor updated successfully',
                'data' => $doctor
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Doctor not found.'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->delete();

            return response()->json(['status_message' => 'Doctor deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Doctor not found.'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
