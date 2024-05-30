<?php

namespace Modules\Service\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Treatment\Entities\Treatment;
use Module\Speciality\Entities\Speciality;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'speciality_id',
    ];

    public function speciality()
    {
        return $this->belongsTo(Speciality::class);
    }

    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }
}
