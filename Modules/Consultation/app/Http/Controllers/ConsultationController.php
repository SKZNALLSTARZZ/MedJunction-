<?php

namespace Modules\Consultation\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Consultation\Http\Requests\ConsultationAddRequest;
use Module\Consultation\Entities\Consultation;
use Modules\Consultation\Http\Requests\ConsultationUpdateRequest;

class ConsultationController extends Controller
{
    public function index()
    {
        try {
            $consultations = Consultation::all();
            return response()->json($consultations, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function store(ConsultationAddRequest $request)
    {
        try {
            $consultation = new Consultation();
            $consultation->fill($request->validated());
            $consultation->save();

            return response()->json($consultation, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMEssage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id)
    {
        try {
            $consultation = Consultation::find($id);

            if (!$consultation) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json($consultation, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(ConsultationUpdateRequest $request, int $id)
    {
        try {
            $consultation = Consultation::find($id);

            if (!$consultation) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $consultation->update($request->validated());
            return response()->json($consultation, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id)
    {
        try {
            $consultation = Consultation::find($id);

            if (!$consultation) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $consultation->delete();

            return response()->json(['status_message' => 'Consultation deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
