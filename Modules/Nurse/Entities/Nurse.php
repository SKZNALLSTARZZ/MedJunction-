<?php

namespace Modules\Nurse\Entities;

use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Module\Speciality\Entities\Speciality;
use Module\Consultation\Entities\Consultation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nurse extends Model
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

    public function consultations()
    {
        return $this->belongsToMany(Consultation::class);
    }
}
