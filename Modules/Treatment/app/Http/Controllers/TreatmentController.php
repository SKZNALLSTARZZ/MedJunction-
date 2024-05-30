<?php

namespace Modules\Treatment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Treatment\Entities\Treatment;
use Modules\Treatment\Http\Requests\TreatmentAddRequest;
use Modules\Treatment\Http\Requests\TreatmentUpdateRequest;

class TreatmentController extends Controller
{
    public function index()
    {
        try {
            $treatments = Treatment::all();
            return response()->json($treatments, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(TreatmentAddRequest $request)
    {
        try {

            $treatment = new Treatment();
            $treatment->fill($request->validated());
            $treatment->save();

            return response()->json($treatment, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMEssage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id)
    {
        try {
            $treatment = Treatment::find($id);

            if (!$treatment) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json($treatment, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(TreatmentUpdateRequest $request, int $id)
    {
        try {
            $treatment = Treatment::find($id);

            if (!$treatment) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $treatment->update($request->validated());
            return response()->json($treatment, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id)
    {
        try {
            $treatment = Treatment::find($id);

            if (!$treatment) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $treatment->delete();

            return response()->json(['message' => 'Resource deleted successfully'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
