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
        Schema::disableForeignKeyConstraints();
        Schema::table('garbage_schedule_day', function (Blueprint $table) {
            $table->dropForeign(['schedule_day_id']);
            $table->dropColumn('schedule_day_id');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::enableForeignKeyConstraints();
        Schema::table('garbage_schedule_day', function (Blueprint $table) {
            $table->integer('schedule_day_id');
        });
        Schema::disableForeignKeyConstraints();
    }
};
