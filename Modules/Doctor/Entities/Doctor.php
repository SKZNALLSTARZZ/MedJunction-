<?php

namespace Modules\Doctor\Entities;

use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Speciality\Entities\Speciality;
use Modules\Appointment\Entities\Appointment;
use Modules\Consultation\Entities\Consultation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'phone',
        'user_id',
        'speciality_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function speciality()
    {
        return $this->hasOne(Speciality::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    public function consultations()
    {
        return $this->hasManyThrough(Consultation::class, Appointment::class, 'doctor_id', 'appointment_id');
    }
}
