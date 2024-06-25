<?php

namespace Modules\PatientMedicalHistories\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\PatientMedicalHistories\Database\Factories\PatientMedicalHistoriesFactory;

class PatientMedicalHistories extends Model
{
    use HasFactory;
    protected $table = 'patient_medical_histories';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['patient_id', 'medical_history_id'];

    protected static function newFactory(): PatientMedicalHistoriesFactory
    {
        return PatientMedicalHistoriesFactory::new();
    }
}
