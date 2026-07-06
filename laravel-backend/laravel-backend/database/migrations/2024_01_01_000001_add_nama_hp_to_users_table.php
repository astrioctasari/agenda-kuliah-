<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Modifikasi tabel users default Laravel: ganti email jadi hp, tambah nama
        Schema::table('users', function (Blueprint $table) {
            $table->string('nama')->after('id');
            $table->string('hp')->unique()->after('nama');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nama', 'hp']);
        });
    }
};
