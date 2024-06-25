<?php

namespace Modules\MedicalHistory\Entities;

use Modules\Patient\Entities\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalHistory extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'date', 'medical_condition', 'treatment', 'outcome'];

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'patient_medical_histories');
    }
}
