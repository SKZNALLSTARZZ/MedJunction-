<?php

namespace Modules\Payment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Payment\Entities\Payment;
use Modules\Payment\Resources\PaymentResource;
use Modules\Payment\Repositories\PaymentRepository;
use Modules\Payment\Http\Requests\PaymentAddRequest;
use Modules\Payment\Http\Requests\PaymentUpdateRequest;

class PaymentController extends Controller
{
    protected $paymentRepository;
    public function __construct(PaymentRepository $paymentRepository) {
        $this->PaymentRepository = $paymentRepository;
    }
    public function index()
    {
        try {
            $payments = Payment::all();
            return response()->json($payments, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id)
    {
        try {
            $payment = Payment::find($id);

            if (!$payment) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json($payment, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(PaymentAddRequest $request)
    {
        try {
            $payment= new Payment();
            $payment->fill($request->validated());
            $payment->save();

            return response()->json($payment, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMEssage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(PaymentUpdateRequest $request, int $id)
    {
        try {
            $payment = Payment::find($id);

            if (!$payment) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $payment->update($request->validated());
            return response()->json($payment, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMEssage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id)
    {
        try {
            $payment = Payment::find($id);

            if (!$payment) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $payment->delete();

            return response()->json(['message' => 'Resource deleted successfully'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getLastFivePayments(Request $request)
    {
        $payments = $this->PaymentRepository->getLastFivePayments();

        return PaymentResource::collection($payments);
    }
    public function countAllPayment()
    {
        try {
            $count = $this->PaymentRepository->totalPaymentCount();

            return response()->json($count, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
