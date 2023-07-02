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
        Schema::create('service_articles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('services_category_id')->unsigned();
            $table->foreign('services_category_id')->onDelete('cascade')->references('id')->on('service_categories');
            $table->bigInteger('services_id')->unsigned();
            $table->foreign('services_id')->onDelete('cascade')->references('id')->on('services');
            $table->string('title');
            $table->string('slug')->unique()->nullable();
            $table->text('content')->nullable();
            $table->string('description')->nullable();
            $table->boolean('active')->comment('1:active, 0:inactive')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_articles');
    }
};
