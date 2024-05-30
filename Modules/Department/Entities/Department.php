<?php

namespace Modules\Department\Entities;

use Modules\Speciality\Entities\Speciality;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function specialties()
    {
        return $this->hasMany(Speciality::class);
    }

}
