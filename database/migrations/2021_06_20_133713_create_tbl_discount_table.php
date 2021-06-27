<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_discount', function (Blueprint $table) {
            $table->id('id');
            $table->string('discountcode');
            $table->string('types');
            $table->string('countries');
            $table->integer('shippingrate');
            $table->string('minrequire');
            $table->integer('limitdata');
            $table->date('startdate');
            $table->date('enddate');
            $table->string('seo_title');
            $table->string('seo_description');
            $table->string('seo_url')->nullable();
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
        Schema::dropIfExists('tbl_discount');
    }
}
