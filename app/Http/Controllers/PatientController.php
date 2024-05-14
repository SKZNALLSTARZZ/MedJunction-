<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\PatientRepository;
use App\Http\Requests\PatientAddRequest;
use App\Http\Requests\PatientUpdateRequest;
use App\Services\TwilioService;
use App\Services\PasswordService;

class PatientController extends Controller
{
    private $patientRepository;
    public function __construct(PatientRepository $patienRepository, UserRepository $userRepository) {
        $this->patientRepository = $patienRepository;
        $this->userRepository = $userRepository;
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
            $patient = $this->patientRepository->Single($id);
            return response()->json([$patient]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(PatientAddRequest $request)
    {
        try {
            $password = PasswordService::generateRandomPassword(8);
            $userData = [
                'type' => $request->input('type'),
                'img_url' => $request->input('img_url'),
                'email' => $request->input('email'),
                'password' => bcrypt($password),
            ];
            $user = $this->userRepository->createUser($userData);

            $patient = new Patient();
            $patient->fill($request->validated());
            $patient->user_id = $user->id;
            $patient->save();

            TwilioService::sendMessage($patient->phone, "Your password is: $password");

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
