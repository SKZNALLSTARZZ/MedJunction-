<?php

namespace Modules\Allergy\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Allergy\Entities\Allergy;
use Modules\Allergy\Http\Requests\AllergyAddRequest;
use Modules\Allergy\Http\Requests\AllergyUpdateRequest;

class AllergyController extends Controller
{
    public function index()
    {
        try {
            $allergies = Allergy::all();
            return response()->json($allergies, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(AllergyAddRequest $request)
    {
        try {

            $allergy = new Allergy();
            $allergy->fill($request->validated());
            $allergy->save();

            return response()->json($allergy, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMEssage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id)
    {
        try {
            $allergy = Allergy::find($id);

            if (!$allergy) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json($allergy, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(AllergyUpdateRequest $request, int $id)
    {
        try {
            $allergy = Allergy::find($id);

            if (!$allergy) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $allergy->update($request->validated());
            return response()->json($allergy, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id)
    {
        try {
            $allergy = Allergy::find($id);

            if (!$allergy) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $allergy->delete();

            return response()->json(['message' => 'Resource deleted successfully'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
