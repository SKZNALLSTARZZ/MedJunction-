<?php

namespace Modules\Department\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Department\Entities\Department;
use Modules\Department\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{
    public function index()
    {
        try {
            $departments = Department::all();
            return response()->json($departments, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function store(DepartmentRequest $request)
    {
        try {
            $department = new Department();
            $department->fill($request->validated());
            $department->save();

            return response()->json($department, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMEssage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id)
    {
        try {
            $department = Department::find($id);

            if (!$department) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }
            return response()->json($department, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function update(DepartmentRequest $request, int $id)
    {
        try {
            $department = Department::find($id);

            if (!$department) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $department->update($request->validated());
            return response()->json($department, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function destroy(int $id)
    {
        try {
            $department = Department::find($id);

            if (!$department) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $department->delete();

            return response()->json(['status_message' => 'Department deleted successfully'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
