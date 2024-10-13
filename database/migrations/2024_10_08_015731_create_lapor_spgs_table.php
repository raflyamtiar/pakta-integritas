<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporSpgsTable extends Migration
{
    public function up()
    {
        Schema::create('lapor_spgs', function (Blueprint $table) {
            $table->id();
            $table->string('reporter_name');
            $table->string('reporter_email');
            $table->string('relationship');
            $table->string('reported_name');
            $table->string('reported_position');
            $table->string('case_type');
            $table->string('incident_location');
            $table->text('incident_address');
            $table->date('incident_date');
            $table->time('incident_time');
            $table->text('incident_description');
            $table->string('evidence')->nullable();
            $table->string('declaration');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lapor_spgs');
    }
};
