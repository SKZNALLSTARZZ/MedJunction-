<?php

namespace Modules\Habit\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Habit\Entities\Habit\Habit;
use Modules\Habit\Http\Requests\HabitAddRequest;
use Modules\Habit\Http\Requests\HabitUpdateRequest;

class HabitController extends Controller
{
    public function index()
    {
        try {
            $habits = Habit::all();
            return response()->json($habits, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(HabitAddRequest $request)
    {
        try {

            $habit = new Habit();
            $habit->fill($request->validated());
            $habit->save();

            return response()->json($habit, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMEssage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id)
    {
        try {
            $habit = Habit::find($id);

            if (!$habit) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json($habit, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(HabitUpdateRequest $request, int $id)
    {
        try {
            $habit = Habit::find($id);

            if (!$habit) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $habit->update($request->validated());
            return response()->json($habit, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id)
    {
        try {
            $habit = Habit::find($id);

            if (!$habit) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $habit->delete();

            return response()->json(['message' => 'Resource deleted successfully'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
