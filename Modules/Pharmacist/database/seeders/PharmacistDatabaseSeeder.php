<?php

namespace Modules\Pharmacist\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\User;
use Modules\Pharmacist\Database\Factories\PharmacistFactory;

class PharmacistDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::where('role', 'pharmacist')->pluck('id');
        $pharmacists = collect();
        $userIds->each(function ($userId) use ($pharmacists) {
            $pharmacist = \Modules\Pharmacist\Database\Factories\PharmacistFactory::new()->create(['user_id' => $userId]);
            $pharmacists->push($pharmacist);
        });
    }
}
