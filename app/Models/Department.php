<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function Doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function Nurses()
    {
        return $this->hasMany(Nurse::class);
    }


}
