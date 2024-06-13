<?php

namespace Modules\VitalSign\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Consultation\Entities\Consultation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VitalSign extends Model
{
    use HasFactory;

    protected $fillable = [
        'body_temperature',
        'pulse_rate',
        'respiration_rate',
        'blood_pressure',
        'oxygen_saturation',
    ];

    public function prescription()
    {
        return $this->hasone(Consultation::class);
    }
}
