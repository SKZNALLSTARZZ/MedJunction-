<?php

namespace Modules\Allergy\Entities;

use Modules\Patient\Entities\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Allergy extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'name', 'severity', 'reaction'];

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'patient_allergies');
    }
}
