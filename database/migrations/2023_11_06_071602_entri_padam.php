<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EntriPadam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entri_padam', function (Blueprint $table) {
            $table->id();
            $table->text('penyebab_padam')->nullable();
            $table->text('nama_pelanggan')->nullable();
            $table->text('penyulang')->nullable();
            $table->text('section')->nullable();
            $table->text('penyebab_fix')->nullable();
            $table->text('jam_padam')->nullable();
            $table->text('jam_nyala')->nullable();
            $table->text('durasi_padam')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('status')->nullable();
            $table->text('status_wa')->nullable();
            $table->text('kalipadam')->nullable();
            $table->timestamps(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entri_padam');
    }
}
