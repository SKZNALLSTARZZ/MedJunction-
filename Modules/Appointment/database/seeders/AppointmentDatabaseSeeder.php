<?php

namespace Modules\Appointment\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Appointment\database\factories\AppointmentFactory;

class AppointmentDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Modules\Appointment\Database\Factories\AppointmentFactory::new()->count(45)->create();
    }
}
