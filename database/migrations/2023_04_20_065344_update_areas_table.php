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
        Schema::table('areas', function (Blueprint $table) {
            $table->dropForeign(['ward_id']);
            $table->dropColumn('ward_id');
            $table->dropColumn('name');
            $table->dropColumn('address1');
            $table->dropColumn('address2');
            $table->dropColumn('status');
            $table->string('zip_no')->nullable(false)->change();
            $table->string('zip_no_address')->nullable()->after('zip_no');
            $table->bigInteger('pref_id')->unsigned()->after('zip_no_address');
            $table->foreign('pref_id')->references('id')->on('prefectures')->onDelete('cascade');
            $table->bigInteger('city_id')->unsigned()->after('pref_id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->string('address_no')->nullable()->after('city_id');
            $table->string('address')->nullable()->after('address_no');
            $table->boolean('active')->default(1)->comment('1:active, 0:inactive')->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('areas', function (Blueprint $table) {
            $table->bigInteger('ward_id')->unsigned()->after('id');
            $table->foreign('ward_id')->references('id')->on('wards')->onDelete('cascade');
            $table->string('name');
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->tinyInteger('status');
            $table->dropColumn('zip_no');
            $table->dropColumn('zip_no_address');
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');
            $table->dropForeign(['pref_id']);
            $table->dropColumn('pref_id');
            $table->dropColumn('address_no');
            $table->dropColumn('address');
            $table->dropColumn('active');
        });
    }
};
