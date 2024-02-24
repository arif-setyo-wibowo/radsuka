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
            $table->bigInteger('idpemeriksaan')->unsigned()->unique()->primary();
            $table->unsignedBigInteger('idpasien');
            $table->foreign('idpasien')->references('idpasien')->on('pasiens')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('tgl_pemeriksaan');
            $table->string('jenis_pemeriksaan');
            $table->text('detail_pemeriksaan');
            $table->string('barcode');
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
