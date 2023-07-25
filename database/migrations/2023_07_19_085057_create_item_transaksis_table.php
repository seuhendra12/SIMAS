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
        Schema::create('item_transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_id')->nullable();
            $table->unsignedBigInteger('jenis_sampah_id')->nullable();
            $table->bigInteger('berat');
            $table->bigInteger('point');
            $table->timestamps();

            $table->foreign('transaksi_id')->references('id')->on('transaksis')->onDelete('cascade');
            $table->foreign('jenis_sampah_id')->references('id')->on('jenis_sampahs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_transaksis');
    }
};
