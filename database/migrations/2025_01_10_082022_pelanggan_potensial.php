<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PelangganPotensial extends Migration
{
    public function up()
    {
        Schema::create('data_pelanggan_potensial', function (Blueprint $table) {
            $table->id();
            $table->string('unit_ulp')->nullable();
            $table->string('od_id')->nullable();
            $table->string('count_unitulp')->nullable();
            $table->string('sum_daya')->nullable();
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
        Schema::dropIfExists('data_pelanggan_potensial');
    }
}
