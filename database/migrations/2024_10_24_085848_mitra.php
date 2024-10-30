<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Mitra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keypoint', function (Blueprint $table) {
            $table->id();
            $table->string('penyulang')->nullable();
            $table->string('absw')->nullable();
            $table->string('jenis_keypoint')->nullable();
            $table->string('nomor_tiang')->nullable();
            $table->string('status_keypoint')->nullable();
            $table->string('kondisi_keypoint')->nullable();
            $table->string('merk')->nullable();
            $table->string('no_seri')->nullable();
            $table->string('setting_ocr')->nullable();
            $table->string('setting_gfr')->nullable();
            $table->string('setting_grupaktif')->nullable();
            $table->string('alamat')->nullable();
            $table->string('tanggal_har')->nullable();
            $table->string('tanggal_pasang')->nullable();
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
        Schema::dropIfExists('keypoint');
    }
}
