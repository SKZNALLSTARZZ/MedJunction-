<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'user_id',
        'sex',
        'blood_group',
        'birthdate',
        'height',
        'weight',
        'age',
        'allergies',
        'habits',
        'medical_history',
    ];

    public function Appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::deleting(function ($patient) {
            $patient->user->delete();
        });
    }
}
