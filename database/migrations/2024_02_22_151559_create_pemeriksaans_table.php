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
            $table->id('idpemeriksaan');
            $table->foreign('idpasien')->references('pasiens');
            $table->timestamp('tgl_pemeriksaan');
            $table->string('jenis_pemeriksaan');
            $table->text('detail_pemeriksaan');
            $table->string('barcode');
            $table->string('hasilrontgen');
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
