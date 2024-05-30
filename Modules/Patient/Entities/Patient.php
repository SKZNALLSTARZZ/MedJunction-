<?php

namespace Modules\Patient\Entities;

use Modules\User\Entities\User;
use Modules\Habit\Entities\Habit;
use Modules\Allergy\Entities\Allergy;
use Modules\Appointment\Entities\Appointment;
use Modules\MedicalHistory\Entities\MedicalHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'user_id',
        'gender',
        'blood_group',
        'birthdate',
        'height',
        'weight',
        'age',
    ];

    public function Appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function allergies()
    {
        return $this->hasMany(Allergy::class);
    }

    public function habits()
    {
        return $this->hasMany(Habit::class);
    }

    public function medicalHistories()
    {
        return $this->hasMany(MedicalHistory::class);
    }

    protected static function booted()
    {
        static::deleting(function ($patient) {
            $patient->user->delete();
        });
    }
}
