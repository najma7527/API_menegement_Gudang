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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedBigInteger('katagori_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('stok')->default(0);
            $table->string('satuan')->nullable();
            $table->decimal('harga', 12, 2)->default(0);
            $table->timestamps();

        $table->foreign('katagori_id')
            ->references('id')->on('katagoris')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
