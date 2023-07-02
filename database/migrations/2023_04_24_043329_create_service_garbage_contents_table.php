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
        Schema::create('service_garbage_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('service_garbage_type_id');
            $table->unsignedBigInteger('service_garbage_id');
            $table->text("content");
            $table->boolean("active")->default(1)->comment("1:active; 0:not active");
            $table->foreign('service_garbage_type_id')->references('id')->on('service_garbage_types')->cascadeOnDelete();
            $table->foreign('service_garbage_id')->references('id')->on('service_garbages')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_garbage_contents');
    }
};
