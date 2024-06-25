<?php

namespace Modules\PatientAllergies\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\PatientAllergies\Database\Factories\PatientAllergiesFactory;

class PatientAllergies extends Model
{
    use HasFactory;
    protected $table = 'patient_allergies';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['patient_id', 'allergy_id'];

    protected static function newFactory(): PatientAllergiesFactory
    {
        return PatientAllergiesFactory::new();
    }
}
