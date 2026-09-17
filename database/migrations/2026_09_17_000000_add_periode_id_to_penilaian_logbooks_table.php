<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penilaian_logbooks', function (Blueprint $table) {
            $table->foreignId('periode_id')
                  ->nullable()
                  ->after('nik')
                  ->constrained('periode_magang', 'id')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('penilaian_logbooks', function (Blueprint $table) {
            $table->dropForeign(['periode_id']);
            $table->dropColumn('periode_id');
        });
    }
};
