<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentAddRequest;
use App\Http\Requests\PaymentUpdateRequest;

class PaymentController extends Controller
{
    public function index()
    {
        try {
            $payments = Payment::all();
            return response()->json(['data' => $payments]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $payment = Payment::findOrFail($id);
            return response()->json(['data' => $payment]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(PaymentAddRequest $request)
    {
        try {
            $payment= new Payment();
            $payment->fill($request->validated());
            $payment->save();

            return response()->json([
                'status_code' => 201,
                'status_message' => 'Payment created successfully',
                'data' => $payment
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(PaymentUpdateRequest $request, $id)
    {
        try {
            $payment = Payment::find($id);
            $payment->fill($request->validated());
            $payment->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Payment updated successfully',
                'data' => $payment
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $payment = Payment::findOrFail($id);
            $payment->delete();

            return response()->json(['status_message' => 'Payment deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
