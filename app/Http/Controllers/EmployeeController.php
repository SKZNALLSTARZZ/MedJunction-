<?php

namespace App\Http\Controllers;


use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class EmployeeController extends Controller
{
    public function index()
    {
        try {
            $employees = Employee::all();
            return response()->json(['data' => $employees]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            return response()->json(['data' => $employee]);
        }  catch (Exception $e) {
            return response()->json(['error' => 'Employee not found.'], 404);
        }
    }

    public function store(EmployeeRequest $request)
    {
        try {
            $employee = new Employee();
            $employee->fill($request->validated());
            $employee->save();

            return response()->json([
                'status_code' => 201,
                'status_message' => 'Employee created successfully',
                'data' => $employee
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(EmployeeRequest $request, $id)
    {
        try {
            $employee = Employee::find($id);
            $employee->fill($request->validated());
            $employee->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Employee updated successfully',
                'data' => $employee
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Employee not found.'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();

            return response()->json(['status_message' => 'Employee deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Employee not found.'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
