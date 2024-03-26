<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Http\Requests\PatientUpdateRequest;
use App\Http\Requests\PatientAddRequest;
use Exception;

class PatientController extends Controller
{
    public function index()
    {
        try {
            $patients = Patient::all();
            return response()->json(['data' => $patients]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $patient = Patient::findOrFail($id);
            return response()->json(['data' => $patient]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(PatientAddRequest $request)
    {
        try {
            $patient = new Patient();
            $patient->fill($request->validated());
            $patient->save();

            return response()->json([
                'status_code' => 201,
                'status_message' => 'Patient created successfully',
                'data' => $patient
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(PatientUpdateRequest $request, $id)
    {
        try {
            $patient = Patient::find($id);
            $patient->fill($request->validated());
            $patient->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Patient updated successfully',
                'data' => $patient
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $patient = Patient::findOrFail($id);
            $patient->delete();

            return response()->json(['status_message' => 'Patient deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
