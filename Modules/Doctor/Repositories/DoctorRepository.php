<?php
namespace Modules\Doctor\Repositories;

use Carbon\Carbon;
use Modules\Doctor\Entities\Doctor;
use Modules\Patient\Entities\Patient;
use Modules\Appointment\Entities\Appointment;


class DoctorRepository
{
    protected $model;

    public function __construct(Doctor $doctor)
    {
        $this->model = $doctor;
    }

    public function getConsultedPatients(int $doctorId)
    {
        return Patient::whereHas('appointments', function($query) use ($doctorId) {
            $query->where('doctor_id', $doctorId)
                  ->where('is_consulted', true)
                  ->whereHas('consultation');
        })->get();
    }

    public function getConsultedPatientCounts(int $doctorId)
    {
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();
        $startOfYear = Carbon::now()->startOfYear();

        $dailyCount = Patient::whereHas('appointments', function($query) use ($doctorId, $today) {
            $query->where('doctor_id', $doctorId)
                ->where('is_consulted', true)
                ->whereDate('date', $today)
                ->whereHas('consultation');
        })->count();

        $monthlyCount = Patient::whereHas('appointments', function($query) use ($doctorId, $startOfMonth) {
            $query->where('doctor_id', $doctorId)
                ->where('is_consulted', true)
                ->whereDate('date', '>=', $startOfMonth)
                ->whereHas('consultation');
        })->count();

        $yearlyCount = Patient::whereHas('appointments', function($query) use ($doctorId, $startOfYear) {
            $query->where('doctor_id', $doctorId)
                ->where('is_consulted', true)
                ->whereDate('date', '>=', $startOfYear)
                ->whereHas('consultation');
        })->count();

        return [
            'daily' => $dailyCount,
            'monthly' => $monthlyCount,
            'yearly' => $yearlyCount,
        ];
    }
    public function all(){
        $doctors = Doctor::with('user:id,email,img_url')->get();

        foreach ($doctors as $doctor) {
            $imageData = null;
            if ($doctor->user && $doctor->user->img_url) {
                $imagePath = storage_path('app/public/uploads/' . basename($doctor->user->img_url));
                if (file_exists($imagePath)) {
                    $imageData = base64_encode(file_get_contents($imagePath));
                }else{
                    $imageData = "No DATA!";
                }
            }
            $doctor->img_data = $imageData;
        }

        return $doctors;
    }
}
