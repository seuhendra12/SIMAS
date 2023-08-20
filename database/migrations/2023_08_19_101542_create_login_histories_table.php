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
    Schema::create('login_histories', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table->timestamp('login_time');
      $table->ipAddress('ip_address');
      $table->timestamps();

      // Menambahkan foreign key untuk user_id
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('login_histories');
  }
};
