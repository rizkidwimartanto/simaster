<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DataPelanggan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pelanggan', function(Blueprint $table){
            $table->id();
            $table->string('idpel')->nullable();
            $table->string('nama')->nullable();
            $table->string('nama_stakeholder')->nullable();
            $table->string('jenis_stakeholder')->nullable();
            $table->string('nohp_stakeholder')->nullable();
            $table->string('namapic_lapangan')->nullable();
            $table->string('nohp_piclapangan')->nullable();
            $table->text('alamat')->nullable();
            $table->text('maps')->nullable();
            $table->text('latitude')->nullable();
            $table->text('longtitude')->nullable();
            $table->text('unitulp')->nullable();
            $table->text('tarif')->nullable();
            $table->text('daya')->nullable();
            $table->text('kogol')->nullable();
            $table->text('fakmkwh')->nullable();
            $table->text('rpbp')->nullable();
            $table->text('rpujl')->nullable();
            $table->text('nomor_kwh')->nullable();
            $table->text('penyulang')->nullable();
            $table->text('nama_section')->nullable();
            $table->text('tipe_kubikel')->nullable();
            $table->date('created_at');
            $table->date('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_pelanggan');
    }
}
