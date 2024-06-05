<?php

namespace Modules\Department\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Department\Entities\Department;
use Modules\Department\Database\Factories\DepartmentFactory;

class DepartmentDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Modules\Department\Database\Factories\DepartmentFactory::new()->count(10)->create();
    }
}
