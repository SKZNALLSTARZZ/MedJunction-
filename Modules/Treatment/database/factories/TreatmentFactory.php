<?php

namespace Modules\Treatment\Database\Factories;

use Modules\Service\Entities\Service;
use Modules\Treatment\Entities\Treatment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Treatment>
 */
class TreatmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Treatment::class;

    public function definition(): array
    {
        if (Service::count() === 0) {
            Service::factory()->count(18)->create();
        }

        $treatmentsByService = [
            'Coronary Angioplasty' => [
                ['name' => 'Balloon Angioplasty', 'description' => ''],
                ['name' => 'Stent Placement', 'description' => ''],
            ],
            'Cardiac Catheterization' => [
                ['name' => 'Diagnostic Catheterization', 'description' => ''],
                ['name' => 'Therapeutic Catheterization', 'description' => ''],
            ],
            'Pacemaker Implantation' => [
                ['name' => 'Single-Chamber Pacemaker', 'description' => ''],
                ['name' => 'Dual-Chamber Pacemaker', 'description' => ''],
            ],
            'Electrophysiological Study (EPS)' => [
                ['name' => 'Arrhythmia Diagnosis', 'description' => ''],
                ['name' => 'Ablation Therapy', 'description' => ''],
            ],
            'Heart Failure Clinic' => [
                ['name' => 'Medication Management', 'description' => ''],
                ['name' => 'Lifestyle Counseling', 'description' => ''],
            ],
            'Ventricular Assist Device (VAD) Program' => [
                ['name' => 'VAD Implantation', 'description' => ''],
                ['name' => 'Post-implantation Care', 'description' => ''],
            ],
            'Chemotherapy Administration' => [
                ['name' => 'Intravenous Chemotherapy', 'description' => ''],
                ['name' => 'Oral Chemotherapy', 'description' => ''],
            ],
            'Targeted Therapy' => [
                ['name' => 'Monoclonal Antibodies', 'description' => ''],
                ['name' => 'Tyrosine Kinase Inhibitors', 'description' => ''],
            ],
            'External Beam Radiation Therapy' => [
                ['name' => 'Intensity-Modulated Radiation Therapy (IMRT)', 'description' => ''],
                ['name' => 'Stereotactic Body Radiotherapy (SBRT)', 'description' => ''],
            ],
            'Brachytherapy' => [
                ['name' => 'Prostate Brachytherapy', 'description' => ''],
                ['name' => 'Cervical Cancer Brachytherapy', 'description' => ''],
            ],
            'Tumor Resection' => [
                ['name' => 'Lumpectomy', 'description' => ''],
                ['name' => 'Mastectomy', 'description' => ''],
            ],
            'Reconstructive Surgery' => [
                ['name' => 'Breast Reconstruction', 'description' => ''],
                ['name' => 'Skin Grafting', 'description' => ''],
            ],
            'Hip Replacement' => [
                ['name' => 'Total Hip Replacement', 'description' => ''],
                ['name' => 'Partial Hip Replacement', 'description' => ''],
            ],
            'Knee Replacement' => [
                ['name' => 'Total Knee Replacement', 'description' => ''],
                ['name' => 'Partial Knee Replacement', 'description' => ''],
            ],
            'Arthroscopy' => [
                ['name' => 'Shoulder Arthroscopy', 'description' => ''],
                ['name' => 'Knee Arthroscopy', 'description' => ''],
            ],
            'Ligament Repair' => [
                ['name' => 'ACL Reconstruction', 'description' => ''],
                ['name' => 'MCL Repair', 'description' => ''],
            ],
            'Spinal Fusion' => [
                ['name' => 'Cervical Spinal Fusion', 'description' => ''],
                ['name' => 'Lumbar Spinal Fusion', 'description' => ''],
            ],
            'Disc Replacement' => [
                ['name' => 'Cervical Disc Replacement', 'description' => ''],
                ['name' => 'Lumbar Disc Replacement', 'description' => ''],
            ],
        ];

        $service = Service::inRandomOrder()->first();

        $treatmentInfo = $this->faker->randomElement($treatmentsByService[$service->title]);

        return [
            'service_id' => $service->id,
            'name' => $treatmentInfo['name'],
            'description' => $treatmentInfo['description'],
            'price' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
