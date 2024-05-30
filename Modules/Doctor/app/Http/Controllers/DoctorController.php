<?php

namespace Modules\Doctor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Doctor\Entities\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Doctor\Http\Requests\DoctorAddRequest;
use Modules\Doctor\Http\Requests\DoctorUpdateRequest;

class DoctorController extends Controller
{
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

    public function show(int $id)
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
