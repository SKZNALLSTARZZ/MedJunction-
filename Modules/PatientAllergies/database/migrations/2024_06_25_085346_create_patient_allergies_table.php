<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patient_allergies', function (Blueprint $table) {
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('allergy_id')->constrained('allergies')->onDelete('cascade');
            $table->primary(['patient_id', 'allergy_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.clear
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_allergies');
    }
};
