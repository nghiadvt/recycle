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
        Schema::table('schedule_days', function (Blueprint $table) {
            $table->dropColumn('is_repeat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedule_days', function (Blueprint $table) {
            $table->boolean('is_repeat')->default(0)->comment("1:true; 0:false");
        });
    }
};
