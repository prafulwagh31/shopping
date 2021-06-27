<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblAddnewleadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_addnewlead', function (Blueprint $table) {
            $table->id('id');
            $table->string('leadname')->nullable();
            $table->string('aliasname')->nullable();
            $table->string('prospect_customer')->nullable();
            $table->string('vendor')->nullable();
            $table->string('status')->nullable();
            $table->string('barcode')->nullable();
            $table->string('address')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('email')->nullable();
            $table->string('web')->nullable();
            $table->string('countrycode')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('salteax')->nullable();
            $table->string('vatid')->nullable();
            $table->string('thirdparty')->nullable();
            $table->string('employees')->nullable();
            $table->string('categories')->nullable();
            $table->string('vendorstags')->nullable();
            $table->string('salesgroup')->nullable();
            $table->string('salesuser')->nullable();
            $table->string('image')->nullable();
            $table->string('accountstatus')->nullable();
            $table->string('created_by')->nullable();
            $table->string('created_by_type')->nullable();
            $table->string('campaign')->nullable();
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
        Schema::dropIfExists('tbl_addnewlead');
    }
}
