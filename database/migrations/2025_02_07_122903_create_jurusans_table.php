<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jurusans', function (Blueprint $table) {
            $table->integer('kode_jurusan')->primary();
            $table->integer('kode_ptn')->nullable();
            $table->string('jenjang');
            $table->string('nama_jurusan');
            $table->integer('nilai_jurusan');
            $table->timestamps();

            $table->foreign('kode_ptn')->references('kode_ptn')->on('p_t_n_s')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('jurusans');
    }
};
