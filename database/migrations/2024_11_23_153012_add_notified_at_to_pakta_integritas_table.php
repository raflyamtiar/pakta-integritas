<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pakta_integritas', function (Blueprint $table) {
            $table->timestamp('notified_at')->nullable(); // Null jika belum terkirim
        });
    }

    public function down()
    {
        Schema::table('pakta_integritas', function (Blueprint $table) {
            $table->dropColumn('notified_at');
        });
    }

};
