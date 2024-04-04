<?php

namespace App\Models;

use App\Models\Speciality;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'status',
        'speciality_id',
    ];

    public function speciality()
    {
        return $this->belongsTo(Speciality::class);
    }
}
