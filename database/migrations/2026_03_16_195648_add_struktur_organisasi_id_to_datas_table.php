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
        Schema::table('datas', function (Blueprint $table) {
            $table->foreignId('struktur_organisasi_id')->after('kategori_data_id')->nullable()->constrained('struktur_organisasis')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('datas', function (Blueprint $table) {
            $table->dropForeign(['struktur_organisasi_id']);
            $table->dropColumn('struktur_organisasi_id');
        });
    }
};
