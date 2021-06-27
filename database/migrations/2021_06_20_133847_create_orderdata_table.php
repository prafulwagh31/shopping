<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderdata', function (Blueprint $table) {
            $table->id('id');
            $table->string('order_id');
            $table->string('userid');
            $table->date('orderdate');
            $table->string('delivery_status');
            $table->string('billing_address');
            $table->string('shipping_address');
            $table->string('paymentmethod');
            $table->string('paymentstatus');
            $table->string('orderstatus');
            $table->string('shipping_charges')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
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
        Schema::dropIfExists('orderdata');
    }
}
