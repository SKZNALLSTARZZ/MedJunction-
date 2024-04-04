<?php

namespace App\Http\Controllers;

use App\Models\Pharmacist;
use Illuminate\Http\Request;
use App\Http\Requests\PharmacistAddRequest;
use App\Http\Requests\PharmacistUpdateRequest;
use Exception;

class PharmacistController extends Controller
{
    public function index()
    {
        try {
            $pharmacists = Pharmacist::all();
            return response()->json(['data' => $pharmacists]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $pharmacist = Pharmacist::findOrFail($id);
            return response()->json(['data' => $pharmacist]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(PharmacistAddRequest $request)
    {
        try {
            $pharmacist= new Pharmacist();
            $pharmacist->fill($request->validated());
            $pharmacist->save();

            return response()->json([
                'status_code' => 201,
                'status_message' => 'Pharmacist created successfully',
                'data' => $pharmacist
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(PharmacistUpdateRequest $request, $id)
    {
        try {
            $pharmacist = Pharmacist::find($id);
            $pharmacist->fill($request->validated());
            $pharmacist->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Pharmacist updated successfully',
                'data' => $pharmacist
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $pharmacist = Pharmacist::findOrFail($id);
            $pharmacist->delete();

            return response()->json(['status_message' => 'Pharmacist deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
