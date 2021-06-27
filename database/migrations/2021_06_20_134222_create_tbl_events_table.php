<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_events', function (Blueprint $table) {
            $table->id('id');
            $table->string('event_title')->nullable();
            $table->string('event_user')->nullable();
            $table->string('event_start')->nullable();
            $table->string('event_end')->nullable();
            $table->integer('lead_id')->nullable();
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
        Schema::dropIfExists('tbl_events');
    }
}
