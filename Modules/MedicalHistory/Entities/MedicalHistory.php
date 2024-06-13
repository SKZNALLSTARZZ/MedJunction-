<?php

namespace Modules\MedicalHistory\Entities;


use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalHistory extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'date', 'medical_condition', 'treatment', 'outcome'];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
