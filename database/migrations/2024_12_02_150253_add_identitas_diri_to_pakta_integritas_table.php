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
            $table->string('identitas_diri')->nullable()->after('no_whatsapp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pakta_integritas', function (Blueprint $table) {
            $table->dropColumn('identitas_diri');
        });
    }
};
