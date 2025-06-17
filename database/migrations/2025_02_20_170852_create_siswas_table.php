<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('asal_sekolah')->nullable();
            $table->enum('kelas', ['VII', 'VIII', 'IX', 'X', 'XI', 'XII'])->nullable();

            // Pilihan 1 sampai 4
            for ($i = 1; $i <= 4; $i++) {
                $table->integer("kode_ptn_$i")->nullable();
                $table->integer("kode_jurusan_$i")->nullable();

                $table->foreign("kode_ptn_$i")->references('kode_ptn')->on('p_t_n_s')->onDelete('set null');
                $table->foreign("kode_jurusan_$i")->references('kode_jurusan')->on('jurusans')->onDelete('set null');
            }

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
