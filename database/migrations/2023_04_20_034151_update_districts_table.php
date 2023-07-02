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
        Schema::disableForeignKeyConstraints();
        Schema::table('districts', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');
            $table->string('pref_no')->after('id');
            $table->boolean('active')->default(0)->comment('1:active, 0:inactive')->after('name');
            $table->integer('order')->after('active')->nullable();
        });
        Schema::rename('districts', 'prefectures');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::rename('prefectures', 'districts');
        Schema::table('districts', function (Blueprint $table) {
            $table->string('type')->nullable();
            $table->bigInteger('city_id')->unsigned()->after('id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->dropColumn('pref_no');
            $table->dropColumn('active');
            $table->dropColumn('order');
        });
    }
};
