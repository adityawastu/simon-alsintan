<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('farmer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('nik')->nullable()->index();
            $table->string('no_hp')->nullable();
            $table->text('alamat')->nullable();
            $table->decimal('luas_lahan', 8, 2)->nullable(); // ha
            $table->string('komoditas_utama')->nullable();
            $table->string('kelompok_tani')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('farmer_profiles');
    }
};
