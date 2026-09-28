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
        Schema::create('pelaku_ekrafs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bidang_ekraf_id')->constrained('bidang_ekrafs')->cascadeOnDelete();
            
            $table->unsignedBigInteger('user_id')->nullable();
            
            // Kolom Sesuai PDF
            $table->string('nama_pelaku', 200)->comment('Nama usaha / pelaku ekraf');
            $table->string('slug', 200)->unique();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('kategori_usaha')->nullable()->comment('Contoh: Randai, Logo, dll');
            $table->string('no_haki')->nullable();
            $table->date('tanggal_haki')->nullable();
            $table->string('no_izin_usaha')->nullable()->comment('Akta Pendirian/ P-IRT/ NIB/ HALAL');
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->integer('jumlah_pekerja_pria')->default(0);
            $table->integer('jumlah_pekerja_wanita')->default(0);
            $table->string('agama')->nullable();
            $table->decimal('jumlah_investasi', 20, 2)->default(0);
            $table->string('status_akte_pendirian')->nullable()->comment('Ada/Tidak Ada');
            $table->string('no_hp')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('nagari')->nullable();
            
            // Kolom Lainnya
            $table->text('alamat')->nullable();
            $table->string('gambar')->nullable()->comment('Foto utama');
            $table->json('gallery')->nullable()->comment('Gallery foto');
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['bidang_ekraf_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelaku_ekrafs');
    }
};
