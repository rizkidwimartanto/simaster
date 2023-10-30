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
            $table->text('alamat')->nullable();
            $table->text('maps')->nullable();
            $table->text('latitude')->nullable();
            $table->text('longtitude')->nullable();
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
