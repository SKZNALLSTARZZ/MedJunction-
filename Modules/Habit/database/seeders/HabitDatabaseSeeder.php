<?php

namespace Modules\Habit\Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\HabitFactory;
use Modules\Patient\Entities\Patient;

class HabitDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Modules\Habit\Database\Factories\HabitFactory::new()->count(10)->create();
    }
}
