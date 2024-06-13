<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Modules\User\Database\Seeders\UserDatabaseSeeder;
use Modules\Habit\Database\Seeders\HabitDatabaseSeeder;
use Modules\Nurse\Database\Seeders\NurseDatabaseSeeder;
use Modules\Doctor\Database\Seeders\DoctorDatabaseSeeder;
use Modules\Allergy\Database\Seeders\AllergyDatabaseSeeder;
use Modules\Invoice\Database\Seeders\InvoiceDatabaseSeeder;
use Modules\Patient\Database\Seeders\PatientDatabaseSeeder;
use Modules\Payment\Database\Seeders\PaymentDatabaseSeeder;
use Modules\Service\Database\Seeders\ServiceDatabaseSeeder;
use Modules\Medicine\Database\Seeders\MedicineDatabaseSeeder;
use Modules\Diagnosis\Database\Seeders\DiagnosisDatabaseSeeder;
use Modules\Treatment\Database\Seeders\TreatmentDatabaseSeeder;
use Modules\VitalSign\Database\Seeders\VitalSignDatabaseSeeder;
use Modules\Department\Database\Seeders\DepartmentDatabaseSeeder;
use Modules\Pharmacist\Database\Seeders\PharmacistDatabaseSeeder;
use Modules\Speciality\Database\Seeders\SpecialityDatabaseSeeder;
use Modules\Appointment\Database\Seeders\AppointmentDatabaseSeeder;
use Modules\Consultation\Database\Seeders\ConsultationDatabaseSeeder;
use Modules\Prescription\Database\Seeders\PrescriptionDatabaseSeeder;
use Modules\Receptionist\Database\Seeders\ReceptionistDatabaseSeeder;
use Modules\MedicalHistory\Database\Seeders\MedicalHistoryDatabaseSeeder;
use Modules\MedicinePrescription\Database\Seeders\MedicinePrescriptionDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserDatabaseSeeder::class,
            DepartmentDatabaseSeeder::class,
            SpecialityDatabaseSeeder::class,
            PatientDatabaseSeeder::class,
            DoctorDatabaseSeeder::class,
            NurseDatabaseSeeder::class,
            ReceptionistDatabaseSeeder::class,
            PharmacistDatabaseSeeder::class,
            ServiceDatabaseSeeder::class,
            AllergyDatabaseSeeder::class,
            HabitDatabaseSeeder::class,
            MedicalHistoryDatabaseSeeder::class,
            DiagnosisDatabaseSeeder::class,
            MedicineDatabaseSeeder::class,
            AppointmentDatabaseSeeder::class,
            PaymentDatabaseSeeder::class,
            InvoiceDatabaseSeeder::class,
            TreatmentDatabaseSeeder::class,
            VitalSignDatabaseSeeder::class,
            PrescriptionDatabaseSeeder::class,
            ConsultationDatabaseSeeder::class,
            MedicinePrescriptionDatabaseSeeder::class,
        ]);
    }
}
