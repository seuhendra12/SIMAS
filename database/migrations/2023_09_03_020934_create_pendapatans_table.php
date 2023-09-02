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
    Schema::create('pendapatans', function (Blueprint $table) {
      $table->id();
      $table->date('tanggal')->nullable();
      $table->unsignedBigInteger('jenis_sampah_id')->nullable();
      $table->decimal('total_pendapatan')->default(0);
      $table->timestamps();

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
    Schema::dropIfExists('pendapatans');
  }
};
