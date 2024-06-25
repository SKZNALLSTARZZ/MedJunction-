<?php

namespace Modules\Treatment\Entities;

use Modules\Service\Entities\Service;
use Illuminate\Database\Eloquent\Model;
use Modules\Appointment\Entities\Appointment;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Treatment extends Model
{
    use HasFactory;
    protected $fillable = ['service_id', 'name', 'description', 'price'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
