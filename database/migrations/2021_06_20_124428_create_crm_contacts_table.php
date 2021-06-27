<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_contacts', function (Blueprint $table) {
            $table->id('id');
            $table->string('name')->nullable();
            $table->string('office_phone')->nullable();
            $table->string('organization_name')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('lead_src')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('title')->nullable();
            $table->string('secondary_phone')->nullable();
            $table->string('department')->nullable();
            $table->string('fax')->nullable();
            $table->string('primary_email')->nullable();
            $table->date('dob')->nullable();
            $table->string('assitant')->nullable();
            $table->string('reports_to')->nullable();
            $table->string('assitant_phone')->nullable();
            $table->string('secondary_email')->nullable();
            $table->string('assigned_to')->nullable();
            $table->date('support_startdate')->nullable();
            $table->date('support_enddate')->nullable();
            $table->string('mailing_street')->nullable();
            $table->string('other_street')->nullable();
            $table->string('mailingpobox')->nullable();
            $table->string('otherpobox')->nullable();
            $table->string('mailing_city')->nullable();
            $table->string('other_city')->nullable();
            $table->string('mailing_state')->nullable();
            $table->string('other_state')->nullable();
            $table->string('mailing_zip')->nullable();
            $table->string('other_zip')->nullable();
            $table->string('mailing_country')->nullable();
            $table->string('other_country')->nullable();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('crm_contacts');
    }
}
