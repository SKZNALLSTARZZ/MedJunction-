<?php

namespace Modules\Invoice\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Invoice\Entities\Invoice;
use Modules\Payment\Entities\Payment;

class InvoiceDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = Payment::all();
        $invoices = Invoice::factory()->count(10)->create([
            'payment_id' => $payments->random(),
        ]);
    }
}
