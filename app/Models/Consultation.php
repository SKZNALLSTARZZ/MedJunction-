<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;
    protected $fillable = [
        'remarks',
    ];

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    public function nurse()
    {
        return $this->hasMany(Nurse::class);
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    public function prescription()
    {
        return $this->hasOne(Prescription::class);
    }

    public function appointment()
    {
        return $this->hasOne(Appointment::class);
    }
}
