<?php

namespace Modules\Prescription\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Medicine\Entities\Medicine;
use Module\Consultation\Entities\Consultation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prescription extends Model
{
    use HasFactory;


    protected $fillable = [
        'dosage',
        'quantity',
        'instructions',
        'amount',
        'consultation_id',
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function medicines()
    {
        return $this->hasMany(Medicine::class);
    }

}
