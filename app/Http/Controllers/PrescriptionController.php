<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use Illuminate\Http\Request;
use Exception;
use App\Http\Requests\PrescriptionRequest;

class PrescriptionController extends Controller
{
    public function index()
    {
        try {
            $prescriptions = Prescription::all();
            return response()->json(['data' => $prescriptions]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $prescription = Prescription::findOrFail($id);
            return response()->json(['data' => $prescription]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(PrescriptionRequest $request)
    {
        try {
            $prescription= new Prescription();
            $prescription->fill($request->validated());
            $prescription->save();

            return response()->json([
                'status_code' => 201,
                'status_message' => 'Prescription created successfully',
                'data' => $prescription
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(PrescriptionRequest $request, $id)
    {
        try {
            $prescription = Prescription::find($id);
            $prescription->fill($request->validated());
            $prescription->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Prescription updated successfully',
                'data' => $prescription
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $prescription = Prescription::findOrFail($id);
            $prescription->delete();

            return response()->json(['status_message' => 'Prescription deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
