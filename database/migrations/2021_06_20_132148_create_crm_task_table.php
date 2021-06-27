<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_task', function (Blueprint $table) {
            $table->id('id');
            $table->string('projecttask_name');
            $table->string('priority');
            $table->string('type');
            $table->string('projecttask_number');
            $table->string('relatedto_task');
            $table->string('assignedto_task');
            $table->string('status');
            $table->string('progress');
            $table->string('workedhour');
            $table->date('startdate');
            $table->date('duedate');
            $table->string('description_task');
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
        Schema::dropIfExists('crm_task');
    }
}
