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
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->bigInteger('login_id');
            $table->foreign('login_id')->references('id')->on('admins');
            $table->string('name');
            $table->string('email');
            $table->string('email_login');
            $table->string('password');
            $table->string('remember_token')->nullable();
            $table->string('login_type')->default('admin');
            $table->dateTime('email_verified_at')->nullable();
            $table->string('confirmation_code');
            $table->dateTime('last_login')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
