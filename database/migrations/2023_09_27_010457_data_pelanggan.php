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
            $table->string('idpel');
            $table->string('nama');
            $table->text('alamat');
            $table->string('unitup1');
            $table->string('unitap');
            $table->string('unitup');
            $table->string('tarif');
            $table->string('daya');
            $table->string('kogol');
            $table->string('fakmkwh');
            $table->string('rpbp');
            $table->string('rpujl');
            $table->string('pemda');
            $table->string('nomorkwh');
            $table->string('statusplg');
            $table->string('kdpembmeter');
            $table->string('penyulang')->nullable();
            $table->string('nama_section')->nullable();
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
