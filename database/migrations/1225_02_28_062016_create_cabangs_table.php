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
            $table->foreignId('kota_id')->nullable()->constrained('kotas')->onDelete('set null');
            $table->foreignId('provinsi_id')->nullable()->constrained('kotas')->onDelete('set null');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('cabangs');
    }
};
