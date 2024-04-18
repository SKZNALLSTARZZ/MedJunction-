<?php
namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Patient;

class  PatientRepository{

    public function all(){
        return Patient::with('user:id,email,img_url')->get();
    }

    public function dailyCount(){
        $currentDate = Carbon::today();
        return Patient::whereDate('created_at', $currentDate)->count();
    }

    public function monthlyCount(){
        $currentMonth = Carbon::now()->month;
        return Patient::whereMonth('created_at', $currentMonth)->count();
    }

    public function yearlyCount(){
        $currentYear = Carbon::now()->year;
        return Patient::whereYear('created_at', $currentYear)->count();
    }
}
