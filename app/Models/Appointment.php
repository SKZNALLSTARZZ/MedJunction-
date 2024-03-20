<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['appointment_date', 'doctor_id', 'patient_id', 'consultation_notes'];

    public function doctor()
    {
        return $this->belongsTo(Employee::class, 'doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function consultation()
    {
        return $this->hasOne(Consultation::class);
    }
}
