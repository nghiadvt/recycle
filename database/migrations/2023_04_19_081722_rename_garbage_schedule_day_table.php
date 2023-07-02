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
        Schema::rename('garbage_schedule_day', 'garbage_schedule');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('garbage_schedule', 'garbage_schedule_day');
    }
};
