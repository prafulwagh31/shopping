<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmCampaignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_campaign', function (Blueprint $table) {
            $table->id('id');
            $table->string('campaign_name')->nullable();
            $table->string('campaign_status')->nullable();
            $table->string('campaign_type')->nullable();
            $table->string('product')->nullable();
            $table->string('target_audience')->nullable();
            $table->date('closedate')->nullable();
            $table->string('sponsor')->nullable();
            $table->string('targetsize')->nullable();
            $table->string('num_sent')->nullable();
            $table->string('budget_cost')->nullable();
            $table->string('actual_cost')->nullable();
            $table->string('expeceted_response')->nullable();
            $table->string('expected_revenue')->nullable();
            $table->string('sales_count')->nullable();
            $table->string('actualsales_count')->nullable();
            $table->string('response_count')->nullable();
            $table->string('actualresponse_count')->nullable();
            $table->string('expecetd_roi')->nullable();
            $table->string('actual_roi')->nullable();
            $table->string('description_campaign')->nullable();
            $table->string('sales_group')->nullable();
            $table->string('sales_user')->nullable();
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
        Schema::dropIfExists('crm_campaign');
    }
}
