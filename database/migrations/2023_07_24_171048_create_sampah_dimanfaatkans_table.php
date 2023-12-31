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
    Schema::create('sampah_dimanfaatkans', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('jenis_sampah_id')->nullable();
      $table->bigInteger('berat')->nullable();
      $table->date('tanggal_dimanfaatkan')->nullable();
      $table->text('keterangan')->nullable();
      $table->unsignedBigInteger('petugas_id')->nullable();
      $table->enum('status', ['ditolak', 'dalam proses', 'selesai'])->default('dalam proses');
      $table->timestamps();

      $table->foreign('jenis_sampah_id')->references('id')->on('jenis_sampahs')->onDelete('cascade');
      $table->foreign('petugas_id')->references('id')->on('users')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('sampah_dimanfaatkans');
  }
};
