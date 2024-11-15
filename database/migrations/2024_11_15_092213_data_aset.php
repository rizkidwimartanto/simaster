<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DataAset extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_aset', function (Blueprint $table) {
            $table->id();
            $table->string('ulp')->nullable();
            $table->string('kms_jtm')->nullable();
            $table->string('kms_jtr')->nullable();
            $table->string('jumlah_trafo')->nullable();
            $table->string('total_daya_trafo')->nullable();
            $table->string('sr')->nullable();
            $table->string('jumlah_tiang_tm')->nullable();
            $table->string('jumlah_tiang_tr')->nullable();
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
        Schema::dropIfExists('data_aset');
    }
}
