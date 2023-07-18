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
        Schema::create('jenis_sampahs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->nullable();
            $table->bigInteger('point_perkg')->nullable();
            $table->unsignedBigInteger('kategori_sampah_id')->nullable();
            $table->timestamps();

            $table->foreign('kategori_sampah_id')->references('id')->on('kategori_sampahs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jenis_sampahs');
    }
};
