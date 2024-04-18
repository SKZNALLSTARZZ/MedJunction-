<?php

namespace App\Http\Controllers;

use Exception;
use App\Repositories\PatientRepository;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Requests\PatientAddRequest;
use App\Http\Requests\PatientUpdateRequest;

class PatientController extends Controller
{
    private $patientRepository;
    public function __construct(PatientRepository $patienRepository) {
        $this->patientRepository = $patienRepository;
    }

    public function index()
    {
        try {
            $patients = $this->patientRepository->all();
            return response()->json($patients);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function count()
    {
        try {
            $daily = $this->patientRepository->dailyCount();
            $monthly = $this->patientRepository->monthlyCount();
            $yearly = $this->patientRepository->yearlyCount();

            $res = [
                'daily' => $daily,
                'monthly' => $monthly,
                'yearly' => $yearly
            ];
            return response()->json($res);
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
