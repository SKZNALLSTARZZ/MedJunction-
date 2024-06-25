<?php

namespace Modules\PatientHabits\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\PatientHabits\Database\Factories\PatientHabitsFactory;

class PatientHabits extends Model
{
    use HasFactory;
    protected $table = 'patient_habits';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['patient_id', 'habit_id'];

    protected static function newFactory(): PatientHabitsFactory
    {
        return PatientHabitsFactory::new();
    }
}
