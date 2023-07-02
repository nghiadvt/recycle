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
        Schema::create('missend_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("report_id")->nullable();
            $table->foreign('report_id')->references('id')->on('reports')->cascadeOnDelete();
            $table->string("garbage_type")->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missend_reports');
    }
};
