<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penilaian_logbooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembimbing_id')->constrained('pembimbing', 'id')->onDelete('cascade');
            $table->string('nik');
            $table->foreign('nik')->references('nik')->on('pemagang')->onDelete('cascade');
            $table->unsignedTinyInteger('nilai');   // 0 – 100
            $table->text('catatan')->nullable();     // komentar/feedback
            $table->timestamps();

            // Satu pembimbing hanya bisa beri satu nilai per pemagang
            $table->unique(['pembimbing_id', 'nik']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaian_logbooks');
    }
};
