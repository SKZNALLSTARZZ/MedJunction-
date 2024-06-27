<?php
namespace Modules\Appointment\Repositories;

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
}
