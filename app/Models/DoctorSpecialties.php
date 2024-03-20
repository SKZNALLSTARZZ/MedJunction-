<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSpecialties extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = ['doctor_id', 'specialty_id'];

    protected $fillable = ['doctor_id', 'specialty_id'];
}
