<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->bigInteger('idpemeriksaan')->primary();
            $table->unsignedBigInteger('idpasien');
            $table->foreign('idpasien')->references('idpasien')->on('pasiens')->onUpdate('cascade')->onDelete('cascade');
            $table->date('tgl_pemeriksaan');
            $table->string('jenis_pemeriksaan');
            $table->text('detail_pemeriksaan');
            $table->text('foto_rontgen');
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
        Schema::dropIfExists('pemeriksaans');
    }
};
