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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign Key ke tabel users
            $table->string('ip_address')->nullable(); // Alamat IP pengguna
            $table->string('user_agent')->nullable(); // Informasi browser atau perangkat
            $table->text('payload')->nullable(); // Data sesi
            $table->timestamp('last_activity')->nullable(); // Waktu terakhir aktivitas pengguna
            $table->timestamps(); // Waktu pembuatan dan pembaruan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
