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
        Schema::create('konsultasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');

            for ($i = 1; $i <= 4; $i++) {
                $table->Integer("kode_ptn_$i")->nullable();
                $table->Integer("kode_jurusan_$i")->nullable();

                $table->foreign("kode_ptn_$i")->references('kode_ptn')->on('p_t_n_s')->onDelete('set null');
                $table->foreign("kode_jurusan_$i")->references('kode_jurusan')->on('jurusans')->onDelete('set null');
            }

            $table->decimal('nilai_semester_1', 5, 2);
            $table->decimal('nilai_semester_2', 5, 2);
            $table->decimal('nilai_semester_3', 5, 2);
            $table->decimal('nilai_semester_4', 5, 2);
            $table->decimal('nilai_semester_5', 5, 2);
            $table->timestamps();
        });             
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsultasis');
    }
};
