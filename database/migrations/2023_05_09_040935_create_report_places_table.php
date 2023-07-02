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
        Schema::create('report_places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('address');
            $table->enum('status', [1, 2, 3, 4])->default(1)->comment('1:Pending, 2:Processing, 3:Completed, 4:Cancelled');
            $table->boolean('active')->default(1)->comment('1:active; 0:not active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_places');
    }
};
