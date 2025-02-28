<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cabangs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Nama cabang harus unik
            $table->string('kota');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cabangs');
    }
};
