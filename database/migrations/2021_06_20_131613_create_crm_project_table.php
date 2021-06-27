<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_project', function (Blueprint $table) {
            $table->id('id');
            $table->string('prj_name');
            $table->string('status');
            $table->string('related_to');
            $table->string('assignedto');
            $table->date('start_date');
            $table->date('target_enddate');
            $table->date('actual_enddate');
            $table->string('deal_name');
            $table->string('contact_name');
            $table->string('target_budget');
            $table->string('project_url');
            $table->string('priority');
            $table->string('progress');
            $table->string('description');
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
        Schema::dropIfExists('crm_project');
    }
}
