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
        Schema::create('garbage_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('icon')->nullable();
            $table->string('title')->nullable();
            $table->text('content');
            $table->boolean('active')->default(true)->comment('1:active; 0:no-active');
            $table->unsignedBigInteger('garbage_title_id');
            $table->foreign('garbage_title_id')->references('id')->on('garbage_titles')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('garbage_contents');
    }
};
