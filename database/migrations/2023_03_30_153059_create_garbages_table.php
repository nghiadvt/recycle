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
        Schema::create('garbages', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("name");
            $table->string("description")->nullable();
            $table->decimal("price");
            $table->boolean("active")->default(1)->comment("1:active; 0:not active");
            $table->unsignedBigInteger("garbage_type_id");
            $table->foreign('garbage_type_id')->references('id')->on('garbage_types')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('garbages');
    }
};
