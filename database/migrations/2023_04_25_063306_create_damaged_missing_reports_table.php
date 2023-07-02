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
        Schema::create('damaged_missing_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("report_id")->nullable();
            $table->foreign('report_id')->references('id')->on('reports')->cascadeOnDelete();
            $table->unsignedBigInteger("container_garbage_type_id")->nullable();
            $table->foreign('container_garbage_type_id')->references('id')
                ->on('container_garbage_types')->cascadeOnDelete();
            $table->enum('type', ['Damage', 'Missing']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('damaged_missing_reports');
    }
};
