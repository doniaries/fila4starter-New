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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('posts_count')->default(0);
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->unsignedInteger('posts_count')->default(0);
        });

        Schema::table('kategori_ekrafs', function (Blueprint $table) {
            $table->unsignedInteger('pelaku_ekrafs_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('posts_count');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('posts_count');
        });

        Schema::table('kategori_ekrafs', function (Blueprint $table) {
            $table->dropColumn('pelaku_ekrafs_count');
        });
    }
};
