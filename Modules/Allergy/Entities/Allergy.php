<?php

namespace Modules\Allergy\Entities;

use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Allergy extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'name', 'severity', 'reaction'];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
