<?php
namespace Modules\Invoice\Repositories;

use Modules\Invoice\Entities\Invoice;


class InvoiceRepository
{
    public function getPaidInvoicesByPatient($patientId)
    {
        return Invoice::whereHas('consultation.appointment', function($query) use ($patientId) {
            $query->where('patient_id', $patientId)
                  ->where('is_consulted', true);
        })->whereHas('payment', function($query) {
            $query->where('status', 'paid');
        })->get();
    }

    public function getPaidInvoices()
    {
        return Invoice::whereHas('consultation.appointment', function($query) {
            $query->where('is_consulted', true);
        })->whereHas('payment', function($query) {
            $query->where('status', 'paid');
        })->get();
    }

    public function getInvoiceDetails($invoiceId)
    {
        return Invoice::with([
            'consultation.appointment.patient.user:id,email',
            'consultation.prescription.medicines' => function($query) {
                $query->select('medicines.id', 'medicines.name', 'medicines.price')
                      ->withPivot('quantity');
            },
            'consultation.appointment.treatment:id,name,price'
        ])->findOrFail($invoiceId);
    }
}
