<?php

namespace Modules\Payment\Entities;


use Modules\Invoice\Entities\Invoice;
use Illuminate\Database\Eloquent\Model;
use Modules\Receptionist\Entities\Receptionist;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'receptionist_id',
        'status',
        'payment_type',
        'remarks',
        'amount',
    ];

    public function receptionist()
    {
        return $this->belongsTo(Receptionist::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
