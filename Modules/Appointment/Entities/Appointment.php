<?php

namespace Modules\Appointment\Entities;

use Modules\Doctor\Entities\Doctor;
use Modules\Patient\Entities\Patient;
use Modules\Consultation\Entities\Consultation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'start_time', 'end_time', 'description', 'status', 'doctor_id', 'patient_id', 'is_consulted', 'treatment_id',];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function consultation()
    {
        return $this->hasOne(Consultation::class);
    }

    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }
}
