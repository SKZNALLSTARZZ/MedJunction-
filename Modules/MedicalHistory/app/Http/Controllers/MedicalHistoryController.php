<?php

namespace Modules\MedicalHistory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\MedicalHistory\Entities\MedicalHistory;
use Modules\MedicalHistory\Http\Requests\MedicalHistoryAddRequest;
use Modules\MedicalHistory\Http\Requests\MedicalHistoryUpdateRequest;

class MedicalHistoryController extends Controller
{
    public function index()
    {
        try {
            $medicalHistories = MedicalHistory::all();
            return response()->json($medicalHistories, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(MedicalHistoryAddRequest $request)
    {
        try {

            $medicalHistory = new MedicalHistory();
            $medicalHistory->fill($request->validated());
            $medicalHistory->save();

            return response()->json($medicalHistory, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMEssage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id)
    {
        try {
            $medicalHistory = MedicalHistory::find($id);

            if (!$medicalHistory) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json($medicalHistory, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(MedicalHistoryUpdateRequest $request, int $id)
    {
        try {
            $medicalHistory = MedicalHistory::find($id);

            if (!$medicalHistory) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $medicalHistory->update($request->validated());
            return response()->json($medicalHistory, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id)
    {
        try {
            $medicalHistory = MedicalHistory::find($id);

            if (!$medicalHistory) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $medicalHistory->delete();

            return response()->json(['message' => 'Resource deleted successfully'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
