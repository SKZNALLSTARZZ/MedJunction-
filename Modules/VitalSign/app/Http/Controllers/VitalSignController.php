<?php

namespace Modules\VitalSign\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\VitalSign\Entities\VitalSign;
use Modules\VitalSign\Http\Requests\VitalSignAddRequest;
use Modules\VitalSign\Http\Requests\VitalSignUpdateRequest;

class VitalSignController extends Controller
{
    public function index()
    {
        try {
            $vitalSigns = VitalSign::all();
            return response()->json($vitalSigns, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(VitalSignAddRequest $request)
    {
        try {

            $vitalSign = new VitalSign();
            $vitalSign->fill($request->validated());
            $vitalSign->save();

            return response()->json($vitalSign, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMEssage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id)
    {
        try {
            $vitalSign = VitalSign::find($id);

            if (!$vitalSign) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json($vitalSign, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(VitalSignUpdateRequest $request, int $id)
    {
        try {
            $vitalSign = VitalSign::find($id);

            if (!$vitalSign) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $vitalSign->update($request->validated());
            return response()->json($vitalSign, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id)
    {
        try {
            $vitalSign = VitalSign::find($id);

            if (!$vitalSign) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $vitalSign->delete();

            return response()->json(['message' => 'Resource deleted successfully'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
