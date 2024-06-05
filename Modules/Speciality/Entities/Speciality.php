<?php

namespace Modules\Speciality\Entities;


use Modules\Nurse\Entities\Nurse;
use Modules\Doctor\Entities\Doctor;
use Modules\Service\Entities\Service;
use Illuminate\Database\Eloquent\Model;
use Modules\Department\Entities\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Speciality extends Model
{
    use HasFactory;

    protected $fillable = ['name','description', 'department_id'];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function nurses()
    {
        return $this->hasMany(Nurse::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
