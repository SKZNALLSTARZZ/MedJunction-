<?php

namespace Modules\Invoice\Entities;


use Modules\Payment\Entities\Payment;
use Illuminate\Database\Eloquent\Model;
use Modules\Consultation\Entities\Consultation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'discount_amount',
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
