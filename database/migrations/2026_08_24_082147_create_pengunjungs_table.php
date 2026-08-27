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
    Schema::create('pengunjung', function (Blueprint $table) {
        $table->id('id_pengunjung');
        $table->string('nisn_nip', 32);
        $table->string('nama', 100);
        $table->string('kelas_jabatan', 100);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::dropIfExists('pengunjung');
    }
};
