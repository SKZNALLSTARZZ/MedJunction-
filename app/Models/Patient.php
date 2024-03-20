<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['patient_name', 'patient_phone', 'patient_email'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    public function medicalHistory()
    {
        return $this->hasOne(MedicalHistory::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function bills()
    {
        return $this->hasMany(Billing::class);
    }
}
