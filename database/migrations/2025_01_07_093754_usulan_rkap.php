<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsulanRkap extends Migration
{
    public function up()
    {
        Schema::create('data_usulan_rkap', function (Blueprint $table) {
            $table->id();
            $table->string('nama_petugas')->nullable();
            $table->string('nomor_hp')->nullable();
            $table->string('foto')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('rencana_usulan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_usulan_rkap');
    }
}
