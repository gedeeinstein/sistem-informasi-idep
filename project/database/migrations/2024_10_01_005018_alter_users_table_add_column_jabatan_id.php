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
        // Schema::table('users', function (Blueprint $table) {
        //     $table->foreignId('jabatan_id')->constrained('mjabatan')->cascadeOnDelete();
        // });
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('jabatan_id')
                  ->nullable()
                  ->constrained('mjabatan')
                  ->cascadeOnDelete()
                  ->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['jabatan_id']);
            $table->dropColumn('jabatan_id');
        });
    }
};
