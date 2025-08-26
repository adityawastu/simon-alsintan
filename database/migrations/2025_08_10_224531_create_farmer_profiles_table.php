<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('farmer_profiles', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
      $table->string('no_ktp')->nullable();
      $table->string('alamat')->nullable();
      $table->string('desa')->nullable();
      $table->string('kecamatan')->nullable();
      $table->string('kabupaten')->nullable();
      $table->string('provinsi')->nullable();
      $table->decimal('luas_lahan', 10, 2)->nullable();
      $table->string('jenis_tanaman')->nullable();
      $table->string('kontak')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('farmer_profiles');
  }
};
