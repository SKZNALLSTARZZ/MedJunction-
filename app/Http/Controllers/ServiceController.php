<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceAddRequest;
use App\Http\Requests\ServiceUpdateRequest;

class ServiceController extends Controller
{
    public function index()
    {
        try {
            $services = Service::all();
            return response()->json(['data' => $services]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $service = Service::findOrFail($id);
            return response()->json(['data' => $service]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(ServiceAddRequest $request)
    {
        try {
            $service= new Service();
            $service->fill($request->validated());
            $service->save();

            return response()->json([
                'status_code' => 201,
                'status_message' => 'Service created successfully',
                'data' => $service
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(ServiceUpdateRequest $request, $id)
    {
        try {
            $service = Service::find($id);
            $service->fill($request->validated());
            $service->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Service updated successfully',
                'data' => $service
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $service = Service::findOrFail($id);
            $service->delete();

            return response()->json(['status_message' => 'Service deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
