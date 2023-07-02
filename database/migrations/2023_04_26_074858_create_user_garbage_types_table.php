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
        Schema::create('user_garbage_types', function (Blueprint $table) {
            $table->unsignedBigInteger("garbage_type_id");
            $table->foreign('garbage_type_id')->references('id')->on('garbage_types')->cascadeOnDelete();
            $table->bigInteger('account_id');
            $table->foreign('account_id')->onDelete('cascade')->references('id')->on('accounts');
            $table->integer('weight');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_garbage_types');
    }
};
