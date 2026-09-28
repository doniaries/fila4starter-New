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
        Schema::table('posts', function (Blueprint $table) {
            // Drop unused index
            $table->dropIndex(['foto_utama']);

            // Add unique constraint for data integrity
            // Note: If duplicate slugs exist, this will fail. We assume clean data or handled manually.
            $table->unique('slug');
        });

        Schema::table('post_tag', function (Blueprint $table) {
            // Drop redundant index (already covered by composite unique index)
            $table->dropIndex(['post_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->index('foto_utama');
        });

        Schema::table('post_tag', function (Blueprint $table) {
            $table->index('post_id');
        });
    }
};
