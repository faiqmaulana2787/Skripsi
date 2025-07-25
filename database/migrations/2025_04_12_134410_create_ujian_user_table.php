<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ujian_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ujian_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });        
    }
    public function down(): void
    {
        Schema::dropIfExists('ujian_user');
    }
};
