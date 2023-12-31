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
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('nik')->unique();
      $table->string('name');
      $table->enum('role', [
        'SuperAdmin',
        'Admin',
        'Kelurahan',
        'Petugas',
        'RT',
        'RW',
        'User',
        ])->default('User');
      $table->tinyInteger('is_active');
      $table->string('password');
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
    Schema::dropIfExists('users');
  }
};
