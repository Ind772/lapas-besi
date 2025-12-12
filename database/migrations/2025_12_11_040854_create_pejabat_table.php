<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pejabat', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip', 18)->unique();
            $table->string('pangkat_golongan');
            $table->string('jabatan');
            $table->enum('tipe_jabatan', ['kepala', 'struktural'])->default('struktural');
            $table->string('pendidikan')->nullable();
            $table->string('tahun_menjabat')->nullable();
            $table->string('foto')->nullable();
            $table->integer('urutan')->default(0);
            $table->string('warna_gradient')->default('from-lapas-navy to-lapas-blue');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Index untuk performa query
            $table->index(['tipe_jabatan', 'is_active']);
            $table->index('urutan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pejabat');
    }
};