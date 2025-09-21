<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DataTiangTm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_tiang_tm', function (Blueprint $table) {
            $table->id();
            $table->string('global_id')->nullable();
            $table->string('asset_group')->nullable();
            $table->string('asset_type')->nullable();
            $table->string('description')->nullable();
            $table->string('penyulang')->nullable();
            $table->string('parent_lokasi')->nullable();
            $table->string('formatted_address')->nullable();
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('kode_konstruksi_1')->nullable();
            $table->string('kode_konstruksi_2')->nullable();
            $table->string('kode_konstruksi_3')->nullable();
            $table->string('kode_konstruksi_4')->nullable();
            $table->string('type_pondasi')->nullable();
            $table->string('jenis_tiang')->nullable();
            $table->string('ukuran_tiang')->nullable();
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
        Schema::dropIfExists('data_tiang_tm');
    }
}
