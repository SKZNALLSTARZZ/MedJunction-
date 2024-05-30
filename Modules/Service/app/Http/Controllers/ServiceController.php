<?php

namespace Modules\Service\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Service\Entities\Service;
use Modules\Allergy\Http\Requests\AllergyAddRequest;
use Modules\Allergy\Http\Requests\AllergyUpdateRequest;

class ServiceController extends Controller
{
    public function index()
    {
        try {
            $services = Service::all();
            return response()->json($services, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(AllergyAddRequest $request)
    {
        try {

            $service = new Service();
            $service->fill($request->validated());
            $service->save();

            return response()->json($service, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMEssage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id)
    {
        try {
            $service = Service::find($id);

            if (!$service) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json($service, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(AllergyUpdateRequest $request, int $id)
    {
        try {
            $service = Service::find($id);

            if (!$service) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $service->update($request->validated());
            return response()->json($service, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id)
    {
        try {
            $service = Service::find($id);

            if (!$service) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $service->delete();

            return response()->json(['message' => 'Resource deleted successfully'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
