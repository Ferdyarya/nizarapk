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
        Schema::create('pembangunanrumahkacas', function (Blueprint $table) {
            $table->id();
            $table->string('id_masterpegawai');
            $table->date('tanggal');
            $table->string('namarumah');
            $table->string('deskripsi');
            $table->string('keperluandana');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembangunanrumahkacas');
    }
};
