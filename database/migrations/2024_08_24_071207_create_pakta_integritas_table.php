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
    Schema::create('pakta_integritas', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('jabatan');
        $table->string('instansi');
        $table->text('alamat');
        $table->string('email');
        $table->string('kota');
        $table->date('tanggal');
        $table->string('no_whatsapp');
        $table->string('role');
        $table->enum('status', ['pending', 'diterima', 'ditolak']);
        $table->date('tanggal_akhir')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakta_integritas');
    }
};
