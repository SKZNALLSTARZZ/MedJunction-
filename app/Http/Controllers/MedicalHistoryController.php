<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalHistory;
use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalHistoryRequest;
use Exception;

class MedicalHistoryController extends Controller
{
    public function index()
    {
        try {
            $medicalHistories = MedicalHistory::all();
            return response()->json(['data' => $medicalHistories]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $medicalHistory = MedicalHistory::findOrFail($id);
            return response()->json(['data' => $medicalHistory]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(MedicalHistoryRequest $request)
    {
        try {
            $medicalHistory = new MedicalHistory();
            $medicalHistory->fill($request->validated());
            $medicalHistory->save();

            return response()->json([
                'status_code' => 201,
                'status_message' => 'Medical history created successfully',
                'data' => $medicalHistory
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(MedicalHistoryRequest $request, $id)
    {
        try {
            $medicalHistory = MedicalHistory::find($id);
            $medicalHistory->fill($request->validated());
            $medicalHistory->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Medical history updated successfully',
                'data' => $medicalHistory
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $medicalHistory = MedicalHistory::findOrFail($id);
            $medicalHistory->delete();

            return response()->json(['status_message' => 'Medical history deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
