<?php

namespace Modules\Prescription\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Prescription\Entities\Prescription;
use Modules\Prescription\Http\Requests\PrescriptionRequest;
use Modules\Prescription\Repositories\PrescriptionRepository;

class PrescriptionController extends Controller
{
    protected $prescriptionRepository;
    public function __construct(PrescriptionRepository $prescriptionRepository) {
        $this->prescriptionRepository = $prescriptionRepository;
    }
    public function index()
    {

        try {
            $prescriptions = Prescription::all();
            return response()->json($prescriptions, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(PrescriptionRequest $request)
    {
        try {

            $prescription = new Prescription();
            $prescription->fill($request->validated());
            $prescription->save();

            return response()->json($prescription, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMEssage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id)
    {
        try {
            $prescription = Prescription::find($id);

            if (!$prescription) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json($prescription, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(PrescriptionRequest $request, int $id)
    {
        try {
            $prescription = Prescription::find($id);

            if (!$prescription) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $prescription->update($request->validated());
            return response()->json($prescription, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id)
    {
        try {
            $prescription = Prescription::find($id);

            if (!$prescription) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $prescription->delete();

            return response()->json(['message' => 'Resource deleted successfully'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function countAllPrescription()
    {
        try {
            $count = $this->prescriptionRepository->totalPrescriptionCount();

            return response()->json($count, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
