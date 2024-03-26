<?php

namespace App\Http\Controllers;

use App\Models\Nurse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\NurseAddRequest;
use App\Http\Requests\NurseUpdateRequest;

class NurseController extends Controller
{
    public function index()
    {
        try {
            $nurses = Nurse::all();
            return response()->json(['data' => $nurses]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $nurse = Nurse::findOrFail($id);
            return response()->json(['data' => $nurse]);
        }  catch (Exception $e) {
            return response()->json(['error' => 'Nurse not found.'], 404);
        }
    }

    public function store(NurseAddRequest $request)
    {
        try {
            $nurse = new Nurse();
            $nurse->fill($request->validated());
            $nurse->save();

            return response()->json([
                'status_code' => 201,
                'status_message' => 'Nurse created successfully',
                'data' => $nurse
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(NurseUpdateRequest $request, $id)
    {
        try {
            $nurse = Nurse::find($id);
            $nurse->fill($request->validated());
            $nurse->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Nurse updated successfully',
                'data' => $doctor
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Nurse not found.'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $nurse = Nurse::findOrFail($id);
            $nurse->delete();

            return response()->json(['status_message' => 'Nurse deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Nurse not found.'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
