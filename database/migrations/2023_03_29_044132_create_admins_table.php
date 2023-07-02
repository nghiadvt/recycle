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
        Schema::create('admins', function (Blueprint $table) {
                $table->bigInteger('id')->autoIncrement();
                $table->string('first_name');
                $table->string('last_name');
                $table->tinyInteger('gender');
                $table->integer('created_by')->nullable();
                $table->tinyInteger('status');
                $table->dateTime('deleted_at')->nullable();
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
