<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConsultationAddRequest;
use App\Http\Requests\ConsultationUpdateRequest;

class ConsultationController extends Controller
{
    public function index()
    {
        try {
            $consultations = Consultation::all();
            return response()->json(['data' => $consultations]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $consultation = Consultation::findOrFail($id);
            return response()->json(['data' => $consultation]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(ConsultationAddRequest $request)
    {
        try {
            $consultation = new Consultation();
            $consultation->fill($request->validated());
            $consultation->save();

            return response()->json([
                'status_code' => 201,
                'status_message' => 'Consultation created successfully',
                'data' => $consultation
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(ConsultationUpdateRequest $request, $id)
    {
        try {
            $consultation = Consultation::find($id);
            $consultation->fill($request->validated());
            $consultation->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Consultation updated successfully',
                'data' => $consultation
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $consultation = Consultation::findOrFail($id);
            $consultation->delete();

            return response()->json(['status_message' => 'Consultation deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
