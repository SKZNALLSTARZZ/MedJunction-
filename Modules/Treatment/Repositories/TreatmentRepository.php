<?php
namespace Modules\Treatment\Repositories;

use Modules\Service\Entities\Service;
use Modules\Treatment\Entities\Treatment;
use Modules\Speciality\Entities\Speciality;


class TreatmentRepository
{
    public function getTreatment()
    {
        return Treatment::whereHas('service')->with([
            'service.speciality',
        ])->get();
    }
    public function getAllServices()
    {
        $services = Service::distinct()->get(['id', 'title'])->map(function ($service) {
            return [
                'id' => $service->id,
                'name' => $service->title,
            ];
        });

        // Adding 'All' as the first service
        $services->prepend(['id' => 0, 'name' => 'All']);

        return $services;
    }

    public function getAllSpecialities()
    {
        $specialities = Speciality::distinct()->get(['id', 'name'])->map(function ($speciality) {
            return [
                'id' => $speciality->id,
                'name' => $speciality->name,
            ];
        });

        // Adding 'All' as the first speciality
        $specialities->prepend(['id' => 0, 'name' => 'All']);

        return $specialities;
    }
}
