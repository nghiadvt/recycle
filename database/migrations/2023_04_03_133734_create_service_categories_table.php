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
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')->onDelete('cascade')->references('id')->on('service_categories');
            $table->string('slug')->unique()->nullable();
            $table->string('description')->nullable();
            $table->boolean('active')->default(1)->comment("1: active; 0: inactive");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_categories');
    }
};
