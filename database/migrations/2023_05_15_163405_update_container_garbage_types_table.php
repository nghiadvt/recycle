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
        Schema::table('container_garbage_types', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dropForeign(['garbage_type_id']);
            $table->dropUnique(['garbage_type_id', 'bin_size']);
            $table->foreign('garbage_type_id')->references('id')->on('garbage_types')->cascadeOnDelete();
            Schema::enableForeignKeyConstraints();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('container_garbage_types', function (Blueprint $table) {
            $table->unique(['garbage_type_id', 'bin_size']);
        });
    }
};
