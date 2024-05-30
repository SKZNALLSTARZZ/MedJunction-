<?php

namespace Modules\Diagnosis\Entities;

use Illuminate\Database\Eloquent\Model;
use Module\Consultation\Entities\Consultation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diagnosis extends Model
{
    use HasFactory;
    protected $fillable = ['diagnosis_code', 'diagnosis_description'];

    public function consultations()
    {
        return $this->belongsTo(Consultation::class);
    }
}
