<?php
namespace Modules\Consultation\Repositories;

use Modules\Consultation\Entities\Consultation;


class ConsultationRepository
{
    public function getConsultationsForPatient($patientId)
    {
        return Consultation::whereHas('appointment', function ($query) use ($patientId) {
            $query->where('patient_id', $patientId)
                  ->where('is_consulted', true);
        })->with(['appointment', 'diagnosis', 'treatment', 'vitalSign', 'prescription.medicines'])->get();
    }
}
