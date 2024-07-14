<?php
namespace Modules\Patient\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
        $query = Patient::with('user:id,email,img_url', 'habits:id,type', 'allergies:id,name', 'medicalHistories:id,medical_condition');

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
    public function totalPatientCount()
{
    $monthlyCounts = [];

    for ($i = 0; $i < 12; $i++) {
        $count = Patient::whereYear('created_at', Carbon::now()->subMonths($i)->year)
                        ->whereMonth('created_at', Carbon::now()->subMonths($i)->month)
                        ->count();
        $monthlyCounts[] = $count;
    }

    $monthlyCounts = array_reverse($monthlyCounts);

    // Calculate the percentage change between the current month and the previous month
    $currentMonthCount = $monthlyCounts[count($monthlyCounts) - 1];
    $previousMonthCount = $monthlyCounts[count($monthlyCounts) - 2];

    if ($previousMonthCount != 0) {
        $percentageChange = (($currentMonthCount - $previousMonthCount) / $previousMonthCount) * 100;
    } else {
        $percentageChange = $currentMonthCount * 100; // if previous month is 0, just return current month as percentage
    }
    $percentageChange = number_format($percentageChange, 2);
    $totalCount = Patient::count();

    return [
        'monthlyCounts' => $monthlyCounts,
        'percentageChange' => $percentageChange,
        'totalCount' => $totalCount,
    ];
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
    public function getLastFivePatients()
    {
        $patients = Patient::join('users', 'users.id', '=', 'patients.user_id')
            ->join('appointments', 'appointments.patient_id', '=', 'patients.id')
            ->orderBy('patients.created_at', 'desc')
            ->select('patients.id', 'patients.name', 'patients.phone', 'users.img_url', DB::raw("DATE_FORMAT(patients.created_at, '%l:%i %p') as formatted_time"))
            ->distinct()
            ->take(5)
            ->get();

            foreach ($patients as $patient) {
                $imageData = null;
                if ($patient->img_url) {
                    $imagePath = storage_path('app/public/uploads/' . basename($patient->img_url));
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
}
