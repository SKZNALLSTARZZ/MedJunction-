<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Requests\InvoiceAddRequest;
use App\Http\Requests\InvoiceUpdateRequest;

class InvoiceController extends Controller
{
    public function index()
    {
        try {
            $invoices = Invoice::all();
            return response()->json(['data' => $invoices]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $invoice = Invoice::findOrFail($id);
            return response()->json(['data' => $invoice]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(InvoiceAddRequest $request)
    {
        try {
            $invoice= new Invoice();
            $invoice->fill($request->validated());
            $invoice->save();

            return response()->json([
                'status_code' => 201,
                'status_message' => 'Invoice created successfully',
                'data' => $invoice
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(InvoiceUpdateRequest $request, $id)
    {
        try {
            $invoice = Invoice::find($id);
            $invoice->fill($request->validated());
            $invoice->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Invoice updated successfully',
                'data' => $invoice
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $invoice = Invoice::findOrFail($id);
            $invoice->delete();

            return response()->json(['status_message' => 'Invoice deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
