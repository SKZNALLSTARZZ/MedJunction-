<?php
namespace Modules\Appointment\Repositories;

use Carbon\Carbon;
use Modules\Appointment\Entities\Appointment;


class AppointmentRepository
{
    protected $model;

    public function __construct(Appointment $appointment)
    {
        $this->model = $appointment;
    }

    public function getDoctorAppointments(int $doctorId)
    {
        return Appointment::where('doctor_id', $doctorId)
                  ->orderBy('created_at', 'desc')
                  ->with('patient')
                  ->get();
    }

    public function getPatientAppointments(int $doctorId)
    {
        return Appointment::where('doctor_id', $doctorId)
                  ->orderBy('created_at', 'desc')
                  ->with('doctor')
                  ->get();
    }

    public function getDoctorAppointmentsForSelectedPatient(int $doctorId, int $patientId)
    {
        return Appointment::where('doctor_id', $doctorId)
        ->where('patient_id', $patientId)
        ->orderBy('created_at', 'desc')
        ->with('patient', 'doctor', 'treatment')
        ->get();
    }
    public function totalAppointmentCount()
{
    $monthlyCounts = [];

    for ($i = 0; $i < 12; $i++) {
        $count = Appointment::whereYear('created_at', Carbon::now()->subMonths($i)->year)
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
    $totalCount = Appointment::count();

    return [
        'monthlyCounts' => $monthlyCounts,
        'percentageChange' => $percentageChange,
        'totalCount' => $totalCount,
    ];
}
public function getTodayAppointments()
{
    return Appointment::whereDate('date', Carbon::today())
        ->with('patient')
        ->orderBy('start_time')
        ->take(5)
        ->get();
}


}
