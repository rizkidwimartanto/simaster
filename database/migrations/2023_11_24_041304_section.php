<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Section extends Migration
{
    /**
     * Run the migrations.
     *~
     * @return void
     */
    public function up()
    {
        Schema::create('section', function (Blueprint $table) {
            $table->id('id_section');
            $table->text('penyulang')->nullable();
            $table->text('nama_section')->nullable();
            $table->text('id_vsld')->nullable();
            $table->text('id_apkt')->nullable();
            $table->text('unit')->nullable();
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
        Schema::dropIfExists('section');
    }
}
