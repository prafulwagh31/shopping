<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id('id');
            $table->string('transfer_id')->nullable();
            $table->string('itemtotal')->nullable();
            $table->string('itemtax')->nullable();
            $table->string('itemfinaltotal')->nullable();
            $table->string('transporttotal')->nullable();
            $table->string('overalldiscount')->nullable();
            $table->string('grand_total')->nullable();
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
        Schema::dropIfExists('purchase_details');
    }
}
