<?php

namespace Modules\MedicinePrescription\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\MedicinePrescription\Database\Factories\MedicinePrescriptionFactory;

class MedicinePrescription extends Pivot
{
    use HasFactory;
    protected $table = 'medicine_prescription';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['prescription_id',
    'medicine_id',
    'dosage',
    'quantity',
    'instructions'];

    protected static function newFactory(): MedicinePrescriptionFactory
    {
        return MedicinePrescriptionFactory::new();
    }
}
