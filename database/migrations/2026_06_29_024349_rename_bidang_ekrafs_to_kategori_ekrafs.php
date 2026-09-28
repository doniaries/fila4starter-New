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
        // 1. Drop foreign key in pelaku_ekrafs
        Schema::table('pelaku_ekrafs', function (Blueprint $table) {
            $table->dropForeign(['bidang_ekraf_id']);
        });

        // 2. Rename table
        Schema::rename('bidang_ekrafs', 'kategori_ekrafs');

        // 3. Rename column and add new foreign key
        Schema::table('pelaku_ekrafs', function (Blueprint $table) {
            $table->renameColumn('bidang_ekraf_id', 'kategori_ekraf_id');
            $table->foreign('kategori_ekraf_id')->references('id')->on('kategori_ekrafs')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelaku_ekrafs', function (Blueprint $table) {
            $table->dropForeign(['kategori_ekraf_id']);
        });

        Schema::rename('kategori_ekrafs', 'bidang_ekrafs');

        Schema::table('pelaku_ekrafs', function (Blueprint $table) {
            $table->renameColumn('kategori_ekraf_id', 'bidang_ekraf_id');
            $table->foreign('bidang_ekraf_id')->references('id')->on('bidang_ekrafs')->cascadeOnDelete();
        });
    }
};
