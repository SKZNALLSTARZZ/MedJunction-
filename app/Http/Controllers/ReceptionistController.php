<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Receptionist;
use Illuminate\Http\Request;
use App\Http\Requests\ReceptionistAddRequest;
use App\Http\Requests\ReceptionistUpdateRequest;

class ReceptionistController extends Controller
{
    public function index()
    {
        try {
            $receptionists = Receptionist::all();
            return response()->json(['data' => $receptionists]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $receptionist = Receptionist::findOrFail($id);
            return response()->json(['data' => $receptionist]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(ReceptionistAddRequest $request)
    {
        try {
            $receptionist= new Receptionist();
            $receptionist->fill($request->validated());
            $receptionist->save();

            return response()->json([
                'status_code' => 201,
                'status_message' => 'Receptionist created successfully',
                'data' => $receptionist
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(ReceptionistUpdateRequest $request, $id)
    {
        try {
            $receptionist = Receptionist::find($id);
            $receptionist->fill($request->validated());
            $receptionist->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Receptionist updated successfully',
                'data' => $receptionist
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $receptionist = Receptionist::findOrFail($id);
            $receptionist->delete();

            return response()->json(['status_message' => 'Receptionist deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
