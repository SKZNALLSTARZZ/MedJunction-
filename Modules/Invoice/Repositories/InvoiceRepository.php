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
        $invoices = Invoice::with('consultation.appointment.patient.user:id,email,img_url')->whereHas('consultation.appointment', function($query) {
            $query->where('is_consulted', true);
        })->whereHas('payment', function($query) {
            $query->where('status', 'paid');
        })->get();

        foreach ($invoices as $invoice) {
            $imageData = null;
            if ($invoice->consultation->appointment->patient->user && $invoice->consultation->appointment->patient->user->img_url) {
                $imagePath = storage_path('app/public/uploads/' . basename($invoice->consultation->appointment->patient->user->img_url));
                if (file_exists($imagePath)) {
                    $imageData = base64_encode(file_get_contents($imagePath));
                }else{
                    $imageData = "No DATA!";
                }
            }
            $invoice->img_data = $imageData;
        }
        return $invoices ;

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
