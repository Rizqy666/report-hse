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
        Schema::create('hse_checklists', function (Blueprint $table) {
            $table->id();
            $table->string('reported_by')->nullable();
            $table->date('date')->nullable();
            $table->string('inst_dept')->nullable();

            $table->json('ppe')->nullable();
            $table->json('ppe_notes')->nullable();

            $table->json('working_position')->nullable();
            $table->json('working_position_notes')->nullable();

            $table->json('ergonomic')->nullable();
            $table->json('ergonomic_notes')->nullable();

            $table->json('tools')->nullable();
            $table->json('tools_notes')->nullable();

            $table->json('procedures')->nullable();
            $table->json('procedures_notes')->nullable();

            $table->json('environment')->nullable();
            $table->json('environment_notes')->nullable();

            $table->string('condition_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hse_checklists');
    }
};
