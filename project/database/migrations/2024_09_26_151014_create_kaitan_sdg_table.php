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
        Schema::create('mkaitan_sdg', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->string('nama', 200); // Nama field with a max length of 200
            $table->boolean('aktif')->default(1); // Aktif field as boolean (bit in SQL)
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kaitan_sdg');
    }
};
