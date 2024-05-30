<?php

namespace Modules\Pharmacist\Entities;

use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Medicine\Entities\Medicine;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pharmacist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medicines()
    {
        return $this->hasMany(Medicine::class);
    }
}
