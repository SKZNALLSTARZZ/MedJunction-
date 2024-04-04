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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('sex', ['male', 'female']);
            $table->string('blood_group')->nullable();
            $table->date('birthdate')->nullable();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->integer('age')->nullable();
            $table->text('allergies')->nullable();
            $table->text('habits')->nullable();
            $table->text('medical_history')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_patient');
    }
};
