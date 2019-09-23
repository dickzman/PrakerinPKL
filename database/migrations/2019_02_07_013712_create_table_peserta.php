<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePeserta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta', function (Blueprint $table) {
            // $table->increments('id');
            $table->string('kode_pst')->unique()->primary();
            $table->string('nama_pst');
            $table->string('instansi');
            $table->string('jenis_kelamin');
            $table->string('masuk');
            $table->string('keluar');
            $table->string('status');
            $table->softdeletes();
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
        Schema::dropIfExists('peserta');
    }
}
