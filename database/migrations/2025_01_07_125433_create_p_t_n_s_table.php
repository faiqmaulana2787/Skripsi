<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('p_t_n_s', function (Blueprint $table) {
            $table->integer('kode_ptn')->primary();
            $table->string('nama_ptn');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('p_t_n_s');
    }
};
