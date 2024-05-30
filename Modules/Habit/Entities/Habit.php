<?php

namespace Modules\Habit\Entities;

use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Habit extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id','type', 'frequency', 'duration'];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
