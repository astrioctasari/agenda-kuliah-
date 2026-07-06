<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('judul');
            $table->string('matkul')->nullable();
            $table->longText('html')->nullable(); // isi catatan (teks berformat + tabel)
            $table->string('rot')->default('0'); // sudut rotasi kartu (estetik)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catatans');
    }
};
