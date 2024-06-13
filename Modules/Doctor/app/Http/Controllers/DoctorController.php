<?php

namespace Modules\Doctor\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Doctor\Entities\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Modules\Doctor\Repositories\DoctorRepository;
use Modules\Doctor\Http\Requests\DoctorAddRequest;
use Modules\Doctor\Http\Requests\DoctorUpdateRequest;

class DoctorController extends Controller
{
    protected $doctorRepository;

    public function __construct(DoctorRepository $doctorRepository)
    {
        $this->doctorRepository = $doctorRepository;
    }

    public function consultedPatients()
    {
        try{
            $user = auth()->user();
            $doctor = $user->doctor;
            if (!$doctor) {
                return response()->json(['error' => 'Doctor not found for the authenticated user'], Response::HTTP_NOT_FOUND);
            }
            $patients = $this->doctorRepository->getConsultedPatients($doctor->id);
            return response()->json($patients, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function getConsultedPatientCounts()
    {
        try{
            $user = auth()->user();
            $doctor = $user->doctor;
            if (!$doctor) {
                return response()->json(['error' => 'Doctor not found for the authenticated user'], Response::HTTP_NOT_FOUND);
            }
            $counts = $this->doctorRepository->getConsultedPatientCounts($doctor->id);
            return response()->json($counts, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function index()
    {
        try {
            $doctors = Doctor::all();
            return response()->json($doctors, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(DoctorAddRequest $request)
    {
        try {
            $doctor = new Doctor();
            $doctor->fill($request->validated());
            $doctor->save();

            return response()->json($doctor, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $doctor = Doctor::find($id);

            if (!$doctor) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json($doctor, Response::HTTP_OK);
        }  catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(DoctorUpdateRequest $request,int $id)
    {
        try {
            $doctor = Doctor::find($id);

            if (!$doctor) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $doctor->update($request->validated());
            return response()->json($doctor, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id)
    {
        try {
            $doctor = Doctor::find($id);

            if (!$doctor) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $doctor->delete();

            return response()->json(['message' => 'Resource deleted successfully'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
