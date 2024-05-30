<?php

namespace Modules\Pharmacist\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Pharmacist\Entities\Pharmacist;
use Modules\Pharmacist\Http\Request\PharmacistAddRequest;
use Modules\Pharmacist\Http\Request\PharmacistUpdateRequest;

class PharmacistController extends Controller
{
    public function index()
    {
        try {
            $pharmacists = Pharmacist::all();
            return response()->json($pharmacists, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(PharmacistAddRequest $request)
    {
        try {

            $pharmacist = new Pharmacist();
            $pharmacist->fill($request->validated());
            $pharmacist->save();

            return response()->json($pharmacist, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMEssage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id)
    {
        try {
            $pharmacist = Pharmacist::find($id);

            if (!$pharmacist) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json($pharmacist, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(PharmacistUpdateRequest $request, int $id)
    {
        try {
            $pharmacist = Pharmacist::find($id);

            if (!$pharmacist) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $pharmacist->update($request->validated());
            return response()->json($pharmacist, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id)
    {
        try {
            $pharmacist = Pharmacist::find($id);

            if (!$pharmacist) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $pharmacist->delete();

            return response()->json(['message' => 'Resource deleted successfully'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
