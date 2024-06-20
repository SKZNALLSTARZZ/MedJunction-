<?php

namespace Modules\Medicine\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Prescription\Entities\Prescription;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'pharmacist_id',
        'name',
        'price',
        'status',
        'inStock',
        'measure',
    ];


    public function prescriptions()
    {
        return $this->belongsToMany(Prescription::class, 'medicine_prescription')
                    ->withPivot('dosage', 'quantity', 'instructions');
    }
}
