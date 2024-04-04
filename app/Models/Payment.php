<?php

namespace App\Models;

use App\Models\Consultation;
use App\Models\Receptionist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultation_id',
        'receptionist_id',
        'status',
        'remarks',
        'amount',
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function receptionist()
    {
        return $this->belongsTo(Receptionist::class);
    }
}
