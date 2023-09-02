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
        Schema::create('transaksi_jual_sampahs', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->unsignedBigInteger('jenis_sampah_id')->nullable();
            $table->string('nama')->nullable();
            $table->decimal('berat', 10, 2)->nullable();
            $table->decimal('harga', 10, 2)->nullable();
            $table->timestamps();

            // Menambahkan foreign key untuk jenis_sampah_id
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
        Schema::dropIfExists('transaksi_jual_sampahs');
    }
};
