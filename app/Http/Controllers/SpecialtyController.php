<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SpecialtyRequest;
use Exception;

class SpecialtyController extends Controller
{
    public function index()
    {
        try {
            $specialties = Specialty::all();
            return response()->json(['data' => $specialties]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $specialty = Specialty::findOrFail($id);
            return response()->json(['data' => $specialty]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(SpecialtyRequest $request)
    {
        try {
            $specialty = new Specialty();
            $specialty->fill($request->validated());
            $specialty->save();

            return response()->json([
                'status_code' => 201,
                'status_message' => 'Specialty created successfully',
                'data' => $specialty
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(SpecialtyRequest $request, $id)
    {
        try {
            $specialty = Specialty::find($id);
            $specialty->fill($request->validated());
            $specialty->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Specialty updated successfully',
                'data' => $specialty
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $specialty = Specialty::findOrFail($id);
            $specialty->delete();

            return response()->json(['status_message' => 'Specialty deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
