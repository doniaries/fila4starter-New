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
        Schema::table('struktur_organisasis', function (Blueprint $table) {
            $conn = Schema::getConnection();

            // Check and drop for 'name' unique index
            $indexName = 'struktur_organisasis_name_unique';
            $existsName = collect($conn->select("SHOW INDEX FROM struktur_organisasis WHERE Key_name = ?", [$indexName]))->isNotEmpty();
            if ($existsName) {
                $table->dropUnique(['name']);
            }

            // Check and drop for 'slug' unique index
            $indexSlug = 'struktur_organisasis_slug_unique';
            $existsSlug = collect($conn->select("SHOW INDEX FROM struktur_organisasis WHERE Key_name = ?", [$indexSlug]))->isNotEmpty();
            if ($existsSlug) {
                $table->dropUnique(['slug']);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('struktur_organisasis', function (Blueprint $table) {
            $conn = Schema::getConnection();

            // Re-add 'name' unique only if not exists
            $indexName = 'struktur_organisasis_name_unique';
            $existsName = collect($conn->select("SHOW INDEX FROM struktur_organisasis WHERE Key_name = ?", [$indexName]))->isEmpty();
            if ($existsName) {
                $table->unique('name');
            }

            // Re-add 'slug' unique only if not exists
            $indexSlug = 'struktur_organisasis_slug_unique';
            $existsSlug = collect($conn->select("SHOW INDEX FROM struktur_organisasis WHERE Key_name = ?", [$indexSlug]))->isEmpty();
            if ($existsSlug) {
                $table->unique('slug');
            }
        });
    }
};
