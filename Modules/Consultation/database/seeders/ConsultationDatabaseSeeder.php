<?php

namespace Modules\Consultation\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Consultation\Database\Factories\ConsultationFactory;

class ConsultationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Modules\Consultation\Database\Factories\ConsultationFactory::new()->count(110)->create();
    }
}
