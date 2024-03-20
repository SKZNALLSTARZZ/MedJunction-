<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    protected $fillable = ['specialty_name'];

    public function doctors()
    {
        return $this->belongsToMany(Employee::class, 'doctor_specialties');
    }
}
