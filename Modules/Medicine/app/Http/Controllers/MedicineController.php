<?php

namespace Modules\Medicine\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Medicine\Entities\Medicine;
use Modules\Medicine\resources\MedicineResource;
use Modules\Medicine\Http\Requests\MedicineAddRequest;
use Modules\Medicine\Http\Requests\MedicineUpdateRequest;

class MedicineController extends Controller
{
    public function index()
    {
        try {
            $medicines = Medicine::all();
            return response()->json(MedicineResource::collection($medicines), Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id)
    {
        try {
            $medicine = Medicine::find($id);

            if (!$medicine) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json($medicine, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(MedicineAddRequest $request)
    {
        try {
            $medicine= new Medicine();
            $medicine->fill($request->validated());
            $medicine->save();

            return response()->json($medicine, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMEssage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(MedicineUpdateRequest $request, $id)
    {
        try {
            $medicine = Medicine::find($id);

            if (!$medicine) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $medicine->update($request->validated());
            return response()->json($medicine, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMEssage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id)
    {
        try {
            $medicine = Medicine::find($id);

            if (!$medicine) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $medicine->delete();

            return response()->json(['message' => 'Resource deleted successfully'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
