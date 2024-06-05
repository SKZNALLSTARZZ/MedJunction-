<?php

namespace Modules\VitalSign\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\VitalSign\Entities\VitalSign;
use Module\Consultation\Entities\Consultation;
use Modules\VitalSign\Database\Factories\VitalSignFactory;

class VitalSignDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Modules\VitalSign\Database\Factories\VitalSignFactory::new()->count(10)->create();
    }
}
