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
        Schema::create('container_garbage_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("garbage_type_id")->nullable();
            $table->foreign('garbage_type_id')->references('id')->on('garbage_types')->cascadeOnDelete();
            $table->integer('bin_size');
            $table->string('image')->nullable();
            $table->boolean('active')->default(1)->comment('1:active, 0:inactive');
            $table->unique(['garbage_type_id', 'bin_size']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('container_garbage_types');
    }
};
