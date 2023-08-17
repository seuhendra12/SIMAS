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
        Schema::create('total_sampahs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_sampah_id');
            $table->foreign('jenis_sampah_id')->references('id')->on('jenis_sampahs');
            $table->decimal('total_berat', 10, 2)->default(0); // Misalnya, kolom total_berat
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
        Schema::dropIfExists('total_sampahs');
    }
};
