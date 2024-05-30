<?php

namespace Modules\Receptionist\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Receptionist\Entities\Receptionist;
use Modules\Allergy\Http\Requests\AllergyAddRequest;
use Modules\Allergy\Http\Requests\AllergyUpdateRequest;

class ReceptionistController extends Controller
{
    public function index()
    {
        try {
            $receptionists = Receptionist::all();
            return response()->json($receptionists, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(AllergyAddRequest $request)
    {
        try {

            $receptionist = new Receptionist();
            $receptionist->fill($request->validated());
            $receptionist->save();

            return response()->json($receptionist, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMEssage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id)
    {
        try {
            $receptionist = Receptionist::find($id);

            if (!$receptionist) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json($receptionist, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(AllergyUpdateRequest $request, int $id)
    {
        try {
            $receptionist = Receptionist::find($id);

            if (!$receptionist) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $receptionist->update($request->validated());
            return response()->json($receptionist, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id)
    {
        try {
            $receptionist = Receptionist::find($id);

            if (!$receptionist) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $receptionist->delete();

            return response()->json(['message' => 'Resource deleted successfully'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
