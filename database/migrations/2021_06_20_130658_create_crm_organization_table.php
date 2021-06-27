<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_organization', function (Blueprint $table) {
            $table->id('id');
            $table->string('organization_name')->nullable();
            $table->string('website')->nullable();
            $table->string('primary_phone')->nullable();
            $table->string('ticker_symbol')->nullable();
            $table->string('fax')->nullable();
            $table->string('member_of')->nullable();
            $table->string('secondary_phone')->nullable();
            $table->string('employees')->nullable();
            $table->string('primary_email')->nullable();
            $table->string('secondary_email')->nullable();
            $table->string('ownership')->nullable();
            $table->string('industry')->nullable();
            $table->string('rating')->nullable();
            $table->string('type')->nullable();
            $table->string('sic_code')->nullable();
            $table->string('annual_revenue')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('billing_pobox')->nullable();
            $table->string('shipping_pobox')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('billing_state')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('billing_postalcode')->nullable();
            $table->string('shipping_postalcode')->nullable();
            $table->string('billing_country')->nullable();
            $table->string('shipping_country')->nullable();
            $table->string('descriptionorg')->nullable();
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
        Schema::dropIfExists('crm_organization');
    }
}
