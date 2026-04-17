<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wishlists', function (Blueprint $target) {
    $target->id();
    $target->integer('kodeUser'); // ID Mahasiswa/Dosen dari session
    $target->integer('kodeBuku');
    $target->string('role'); // Untuk membedakan wishlist mahasiswa/dosen
    $target->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};
