<?php
namespace Modules\Patient\Repositories;

use Carbon\Carbon;
use Modules\Patient\Entities\Patient;


class  PatientRepository{

    public function all(){
        $patients = Patient::with('user:id,email,img_url')->get();

        foreach ($patients as $patient) {
            $imageData = null;
            if ($patient->user && $patient->user->img_url) {
                $imagePath = storage_path('app/public/uploads/' . basename($patient->user->img_url));
                if (file_exists($imagePath)) {
                    $imageData = base64_encode(file_get_contents($imagePath));
                }else{
                    $imageData = "No DATA!";
                }
            }
            $patient->img_data = $imageData;
        }

        return $patients;
    }

    public function Single($id){
        $query = Patient::with('user:id,email,img_url');

        if ($id !== null) {
            $query->where('id', $id);
        }

        $patient = $query->first();

        if ($patient) {
            $imageData = null;
            if ($patient->user && $patient->user->img_url) {
                $imagePath = storage_path('app/public/uploads/' . basename($patient->user->img_url));
                if (file_exists($imagePath)) {
                    $imageData = base64_encode(file_get_contents($imagePath));
                } else {
                    $imageData = "No DATA!";
                }
            }
            $patient->img_data = $imageData;
        }

        return $patient;
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

    public function singleByUserId($userId)
    {
        $query = Patient::with('user:id,email,img_url')->where('user_id', $userId);

        $patient = $query->first();

        if ($patient) {
            $imageData = null;
            if ($patient->user && $patient->user->img_url) {
                $imagePath = storage_path('app/public/uploads/' . basename($patient->user->img_url));
                if (file_exists($imagePath)) {
                    $imageData = base64_encode(file_get_contents($imagePath));
                } else {
                    $imageData = "No DATA!";
                }
            }
            $patient->img_data = $imageData;
        }

        return $patient;
    }
}
