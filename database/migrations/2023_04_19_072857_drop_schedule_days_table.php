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
        Schema::drop('schedule_days');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('schedule_days', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('day_of_week', [1, 2, 3, 4, 5, 6, 7])->comment('Monday->Sunday');
            $table->timestamps();
        });
    }
};
