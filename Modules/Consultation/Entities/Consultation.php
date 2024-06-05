<?php

namespace Modules\Consultation\Entities;

use Module\Nurse\Entities\Nurse;
use Modules\Doctor\Entities\Doctor;
use Module\Invoice\Entities\Invoice;
use Illuminate\Database\Eloquent\Model;
use Module\Diagnosis\Entities\Diagnosis;
use Module\Treatment\Entities\Treatment;
use Module\VitalSign\Entities\VitalSign;
use Modules\Appointment\Entities\Appointment;
use Module\Prescription\Entities\Prescription;
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
        'pictures',
    ];

    public function doctor()
    {
        return $this->hasMany(Doctor::class);
    }

    public function nurse()
    {
        return $this->hasMany(Nurse::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function vitalSign()
    {
        return $this->hasOne(VitalSign::class);
    }

    public function diagnosis()
    {
        return $this->hasOne(Diagnosis::class);
    }

    public function treatment()
    {
        return $this->hasMany(Treatment::class);
    }

    public function prescription()
    {
        return $this->hasOne(Prescription::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
