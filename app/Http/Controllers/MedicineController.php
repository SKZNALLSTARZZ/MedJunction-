<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Http\Requests\MedicineAddRequest;
use App\Http\Requests\MedicineUpdateRequest;

class MedicineController extends Controller
{
    public function index()
    {
        try {
            $medicines = Medicine::all();
            return response()->json(['data' => $medicines]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $medicine = Medicine::findOrFail($id);
            return response()->json(['data' => $medicine]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(MedicineAddRequest $request)
    {
        try {
            $medicine= new Medicine();
            $medicine->fill($request->validated());
            $medicine->save();

            return response()->json([
                'status_code' => 201,
                'status_message' => 'Medicine created successfully',
                'data' => $medicine
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(MedicineUpdateRequest $request, $id)
    {
        try {
            $medicine = Medicine::find($id);
            $medicine->fill($request->validated());
            $medicine->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Medicine updated successfully',
                'data' => $medicine
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $medicine = Medicine::findOrFail($id);
            $medicine->delete();

            return response()->json(['status_message' => 'Medicine deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
