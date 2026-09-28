<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('datas')
            ->whereNull('published_at')
            ->update(['published_at' => DB::raw('created_at')]);
            
        // Jika created_at juga null (jarang terjadi), gunakan waktu sekarang
        DB::table('datas')
            ->whereNull('published_at')
            ->update(['published_at' => now()]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
