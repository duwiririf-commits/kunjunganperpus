<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kunjungan', function (Blueprint $table) {
            $table->id('id_kunjungan');
            $table->unsignedBigInteger('id_pengunjung');
            $table->date('tanggal_kunjungan');
            $table->text('keperluan');
            $table->timestamps();

            $table->foreign('id_pengunjung')
                  ->references('id_pengunjung')
                  ->on('pengunjung')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kunjungan');
    }
};