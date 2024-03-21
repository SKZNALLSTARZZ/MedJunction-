<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Http\Requests\DepartmentRequest;
use Exception;

class DepartmentController extends Controller
{
    public function index()
    {
        try {
            $departments = Department::all();
            return response()->json(['data' => $departments]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $department = Department::findOrFail($id);
            return response()->json(['data' => $department]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(DepartmentRequest $request)
    {
        try {
            $department = new Department();
            $department->fill($request->validated());
            $department->save();

            return response()->json([
                'status_code' => 201,
                'status_message' => 'Department created successfully',
                'data' => $department
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(DepartmentRequest $request, $id)
    {
        try {
            $department = Department::find($id);
            $department->fill($request->validated());
            $department->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Department updated successfully',
                'data' => $department
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $department = Department::findOrFail($id);
            $department->delete();

            return response()->json(['status_message' => 'Department deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
