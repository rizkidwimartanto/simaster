<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Unit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('unit', function (Blueprint $table){
        $table->id();
        $table->text('id_unit')->nullable();
        $table->text('nama_unit')->nullable();
        $table->text('nohp_mulp')->nullable();
        $table->text('nohp_tlteknik')->nullable();
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
        //
    }
}
