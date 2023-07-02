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
        Schema::table('wards', function (Blueprint $table) {
            $table->dropForeign(['district_id']);
        });
        Schema::dropIfExists('wards');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('wards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('district_id')->unsigned();
            $table->foreign('district_id')->references('id')->on('prefectures')->onDelete('cascade');
            $table->string('name');
            $table->enum("type", ['Kawasaki', 'Zama', 'Chigasaki']);
            $table->timestamps();
        });
    }
};
