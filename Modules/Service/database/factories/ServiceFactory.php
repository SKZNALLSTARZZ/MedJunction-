<?php

namespace Modules\Service\Database\Factories;

use Modules\Service\Entities\Service;
use Modules\Speciality\Entities\Speciality;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Service::class;

    public function definition(): array
    {
        if (Speciality::count() === 0) {
            Speciality::factory()->count(9)->create();
        }

        $servicesBySpeciality = [
            'Interventional Cardiology' => [
                'Coronary Angioplasty',
                'Cardiac Catheterization',
            ],
            'Electrophysiology' => [
                'Pacemaker Implantation',
                'Electrophysiological Study (EPS)',
            ],
            'Heart Failure Management' => [
                'Heart Failure Clinic',
                'Ventricular Assist Device (VAD) Program',
            ],
            'Medical Oncology' => [
                'Chemotherapy Administration',
                'Targeted Therapy',
            ],
            'Radiation Oncology' => [
                'External Beam Radiation Therapy',
                'Brachytherapy',
            ],
            'Surgical Oncology' => [
                'Tumor Resection',
                'Reconstructive Surgery',
            ],
            'Joint Replacement' => [
                'Hip Replacement',
                'Knee Replacement',
            ],
            'Sports Medicine' => [
                'Arthroscopy',
                'Ligament Repair',
            ],
            'Spine Surgery' => [
                'Spinal Fusion',
                'Disc Replacement',
            ],
        ];

        $speciality = Speciality::inRandomOrder()->first();

        $serviceName = $this->faker->randomElement($servicesBySpeciality[$speciality->name]);

        return [
            'title' => $serviceName,
            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'speciality_id' => $speciality->id,
        ];
    }
}
