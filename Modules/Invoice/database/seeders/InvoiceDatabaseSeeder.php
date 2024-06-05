<?php

namespace Modules\Invoice\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Invoice\Database\Factories\InvoiceFactory;

class InvoiceDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Modules\Invoice\Database\Factories\InvoiceFactory::new()->count(35)->create();
    }
}
