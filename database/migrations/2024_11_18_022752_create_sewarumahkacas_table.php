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
        Schema::create('sewarumahkacas', function (Blueprint $table) {
            $table->id();
            $table->string('id_masterrumahkaca');
            $table->string('namapenyewa');
            $table->string('keperluan');
            $table->string('tanggal_start');
            $table->string('tanggal_end');
            $table->string('buktibayar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sewarumahkacas');
    }
};
