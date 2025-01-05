<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DataKinerja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_kinerja', function (Blueprint $table) {
            $table->id();
            $table->string('gi')->nullable();
            $table->string('trafo')->nullable();
            $table->string('daya_terpasang')->nullable();
            $table->string('daya_terpakai')->nullable();
            $table->string('daya_terpasang_terpakai_persen')->nullable();
            $table->string('daya_tersisa')->nullable();
            $table->string('daya_tersisa_persen')->nullable();
            $table->string('bulan')->nullable();
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
        Schema::dropIfExists('data_kinerja');
    }
}
