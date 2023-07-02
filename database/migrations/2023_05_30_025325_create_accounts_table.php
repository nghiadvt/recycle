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
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->rememberToken();
            $table->enum('role', [0, 1, 2])->comment('0:admin, 1:buyer, 2:seller');
            $table->decimal('price');
            $table->time('email_verified_at');
            $table->time('last_login');
            $table->string('confirmation_code');
            $table->enum('status', [0, 1])->comment('0:inactive, 1:active');
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
