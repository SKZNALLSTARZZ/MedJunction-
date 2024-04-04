<?php

namespace App\Models;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'payment_type',
        'amount',
        'discount_amount',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
