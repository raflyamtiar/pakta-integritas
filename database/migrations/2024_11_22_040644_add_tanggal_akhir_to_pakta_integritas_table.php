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
    Schema::table('pakta_integritas', function (Blueprint $table) {
        $table->date('tanggal_akhir')->nullable()->after('role');
    });
}

public function down(): void
{
    Schema::table('pakta_integritas', function (Blueprint $table) {
        $table->dropColumn('tanggal_akhir');
    });
}

};
