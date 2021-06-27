<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmMilestoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_milestone', function (Blueprint $table) {
            $table->id('id');
            $table->string('prjmilestone_name');
            $table->string('relatedto_mile');
            $table->date('milestonedate');
            $table->string('assignedto_mile');
            $table->string('type');
            $table->string('description_milestone');
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
        Schema::dropIfExists('crm_milestone');
    }
}
