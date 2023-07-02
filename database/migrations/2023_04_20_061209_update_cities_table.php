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
        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->string('city_no')->after('id');
            $table->bigInteger('pref_id')->unsigned()->after('name');
            $table->foreign('pref_id')->references('id')->on('prefectures')->onDelete('cascade');
            $table->integer('pref_no')->after('pref_id');
            $table->boolean('active')->default(0)->comment('1:active, 0:inactive')->nullable()->after('pref_no');
            $table->integer('order')->nullable()->after('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->enum("type", ['AICHI', 'AKITA', 'AOMORI', 'CHIBA', 'EHIME', 'FUKUI', 'FUKUOKA', 'FUKUSHIMA']);
            $table->dropForeign(['pref_id']);
            $table->dropColumn('pref_id');
            $table->dropColumn('city_no');
            $table->dropColumn('pref_no');
            $table->dropColumn('active');
            $table->dropColumn('order');
        });
    }
};
