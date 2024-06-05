<?php

namespace Modules\Service\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Service\Database\Factories\ServiceFactory;

class ServiceDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Modules\Service\Database\Factories\ServiceFactory::new()->count(10)->create([]);
    }
}
