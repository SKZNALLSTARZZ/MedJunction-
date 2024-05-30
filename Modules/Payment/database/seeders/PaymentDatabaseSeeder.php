<?php

namespace Modules\Payment\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Payment\Entities\Payment;
use Module\Consultation\Entities\Consultation;
use Modules\Receptionist\Entities\Receptionist;

class PaymentDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $consultations = Consultation::all();
        $receptionists = Receptionist::all();

        $payments = Payment::factory()->count(15)->create([
            'consultation_id' => $consultations->random(),
            'receptionist_id' => $receptionists->random(),
        ]);
    }
}
