<?php

namespace Modules\Habit\Entities;

use Modules\Patient\Entities\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Habit extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id','type', 'frequency', 'duration'];

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'patient_habits');
    }
}
