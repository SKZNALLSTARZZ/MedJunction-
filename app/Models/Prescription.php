<?php

namespace App\Models;

use App\Models\Consultation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prescription extends Model
{
    use HasFactory;


    protected $fillable = [
        'state',
        'symptom',
        'advice',
        'medicine',
        'validity',
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }
}
