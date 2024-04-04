<?php

namespace App\Models;

use App\Models\Pharmacist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'status',
        'inStock',
        'measure',
        'pharmacist_id',
    ];

    public function pharmacist()
    {
        return $this->belongsTo(Pharmacist::class);
    }
}
