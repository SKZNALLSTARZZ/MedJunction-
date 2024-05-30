<?php

namespace Modules\Diagnosis\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Diagnosis\Entities\Diagnosis;
use Modules\Diagnosis\Http\Requests\DiagnosisAddRequest;
use Modules\Diagnosis\Http\Requests\DiagnosisUpdateRequest;

class DiagnosisController extends Controller
{
    public function index()
    {
        try {
            $diagnoses = Diagnosis::all();
            return response()->json($diagnoses, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(DiagnosisAddRequest $request)
    {
        try {

            $diagnosis = new Diagnosis();
            $diagnosis->fill($request->validated());
            $diagnosis->save();

            return response()->json($diagnosis, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMEssage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id)
    {
        try {
            $diagnosis = Diagnosis::find($id);

            if (!$diagnosis) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json($diagnosis, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(DiagnosisUpdateRequest $request, int $id)
    {
        try {
            $diagnosis = Diagnosis::find($id);

            if (!$diagnosis) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $diagnosis->update($request->validated());
            return response()->json($diagnosis, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id)
    {
        try {
            $diagnosis = Diagnosis::find($id);

            if (!$diagnosis) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $diagnosis->delete();

            return response()->json(['message' => 'Resource deleted successfully'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
