<?php

namespace Modules\Nurse\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Nurse\Entities\Nurse;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Nurse\Http\Requests\NurseAddRequest;
use Modules\Nurse\Http\Requests\NurseUpdateRequest;

class NurseController extends Controller
{
    public function index()
    {
        try {
            $nurses = Nurse::all();
            return response()->json($nurses, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function store(NurseAddRequest $request)
    {
        try {

            $nurse = new Nurse();
            $nurse->fill($request->validated());
            $nurse->save();

            return response()->json($nurse, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMEssage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id)
    {
        try {
            $nurse = Nurse::find($id);

            if (!$nurse) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json($nurse, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function update(NurseUpdateRequest $request, int $id)
    {
        try {
            $nurse = Nurse::find($id);

            if (!$nurse) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $nurse->update($request->validated());
            return response()->json($nurse, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id)
    {
        try {
            $nurse = Nurse::find($id);

            if (!$nurse) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $nurse->delete();

            return response()->json(['message' => 'Resource deleted successfully'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
