<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Trafo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_trafo', function (Blueprint $table) {
            $table->id();
            $table->text('kategori')->nullable();
            $table->text('gi')->nullable();
            $table->text('unit_layanan')->nullable();
            $table->text('penyulang')->nullable();
            $table->text('no_tiang')->nullable();
            $table->text('no_gardu_distribusi')->nullable();
            $table->text('tipe_belitan_trafo')->nullable();
            $table->text('jam_padam')->nullable();
            $table->text('jam_nyala')->nullable();
            $table->text('latitude')->nullable();
            $table->text('longtitude')->nullable();
            $table->text('lama_padam')->nullable();
            $table->text('daya')->nullable();
            $table->text('merk')->nullable();
            $table->text('no_seri')->nullable();
            $table->text('tahun_pasang')->nullable();
            $table->text('beban_X1')->nullable();
            $table->text('beban_X2')->nullable();
            $table->text('beban_Xo')->nullable();
            $table->text('lokasi')->nullable();
            $table->text('penyebab')->nullable();
            $table->text('no_pk_apkt')->nullable();
            $table->text('bebanA')->nullable();
            $table->text('kva_aset')->nullable();
            $table->text('waktu_ukur')->nullable();
            $table->text('jumlah_jurusan')->nullable();
            $table->text('fasa')->nullable();
            $table->text('beban_jurusan_X1')->nullable();
            $table->text('beban_jurusan_N')->nullable();
            $table->text('perhitungan_beban')->nullable();
            $table->text('klasifikasi_beban')->nullable();
            $table->text('beban_ampere')->nullable();
            $table->text('kesesuaian')->nullable();
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
        Schema::dropIfExists('data_trafo');
    }
}
