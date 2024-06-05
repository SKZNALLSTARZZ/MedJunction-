<?php

namespace Modules\Nurse\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\User;
use Modules\Nurse\Database\Factories\NurseFactory;

class NurseDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::where('role', 'nurse')->pluck('id');
        $nurses = collect();
        $userIds->each(function ($userId) use ($nurses) {
            $nurse = \Modules\Nurse\Database\Factories\NurseFactory::new()->create(['user_id' => $userId]);
            $nurses->push($nurse);
        });
    }
}
