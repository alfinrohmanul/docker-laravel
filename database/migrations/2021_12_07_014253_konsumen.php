<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Konsumen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_konsumen', function (Blueprint $table) {
            $table->char('kode_konsumen');
            $table->char('no_konsumen');
            $table->char('nama_konsumen');
            $table->char('no_hp');
            $table->char('kota');
            $table->char('alamat');
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
        Schema::dropIfExists('tb_konsumen');
    }
}
