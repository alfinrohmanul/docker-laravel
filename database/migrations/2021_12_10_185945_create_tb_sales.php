<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_sales', function (Blueprint $table) {
            $table->char('kode_sales');
            $table->char('no_sales');
            $table->char('nama_sales');
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
        Schema::dropIfExists('tb_sales');
    }
}
