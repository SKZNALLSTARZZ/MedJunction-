<?php
namespace App\Services;

use Illuminate\Support\Str;

class PasswordService
{
    public static function generateRandomPassword($length = 8)
    {
        return Str::random($length);
    }
}
