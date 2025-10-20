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
    Schema::create('katagoris', function (Blueprint $table) {
        $table->unsignedBigInteger('id', true);
        $table->string('nama');
        $table->text('deskripsi')->nullable();
        $table->string('warna')->nullable();
        $table->timestamps();
    });
    }

    public function down(): void
    {
    Schema::dropIfExists('katagoris');
    }
};
