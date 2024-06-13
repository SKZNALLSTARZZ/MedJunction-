<?php

namespace Modules\Consultation\Entities;

use Modules\Nurse\Entities\Nurse;
use Modules\Doctor\Entities\Doctor;
use Modules\Invoice\Entities\Invoice;
use Illuminate\Database\Eloquent\Model;
use Modules\Diagnosis\Entities\Diagnosis;
use Modules\Treatment\Entities\Treatment;
use Modules\VitalSign\Entities\VitalSign;
use Modules\Appointment\Entities\Appointment;
use Modules\Prescription\Entities\Prescription;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Consultation extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id',
        'nurse_id',
        'appointment_id',
        'treatment_id',
        'diagnosis_id',
        'invoice_id',
        'vitalSign_id',
        'complains',
        'prescription_id',
        'pictures',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function nurse()
    {
        return $this->belongsToMany(Nurse::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function vitalSign()
    {
        return $this->belongsTo(VitalSign::class);
    }

    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class);
    }

    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
