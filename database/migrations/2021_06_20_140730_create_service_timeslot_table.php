<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceTimeslotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_timeslot', function (Blueprint $table) {
            $table->id('id');
            $table->string('service_id')->nullable();
            $table->string('staff_id')->nullable();
            $table->string('day')->nullable();
            $table->string('duration')->nullable();
            $table->string('timeslot')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_timeslot');
    }
}
