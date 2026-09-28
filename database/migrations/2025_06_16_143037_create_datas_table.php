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
        Schema::create('datas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_data')->nullable();
            $table->string('slug')->nullable();
            $table->foreignId('kategori_data_id')->nullable()->constrained('kategori_data')->nullOnDelete();
            $table->text('deskripsi')->nullable();
            $table->string('cover')->nullable();
            $table->integer('tahun_terbit')->nullable();
            $table->string('file')->nullable();
            $table->string('tipe_file')->nullable();
            $table->boolean('is_public')->default(true);
            $table->integer('views')->default(0);
            $table->integer('downloads')->default(0);
            $table->datetime('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('nama_data');
            $table->index('slug');
            $table->index('tahun_terbit');
            $table->index('downloads');
            $table->index('is_public');
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datas');
    }
};
