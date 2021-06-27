<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_address', function (Blueprint $table) {
            $table->id('id');
            $table->string('user_id')->nullable();
            $table->string('shipping_name')->nullable();
            $table->string('shipping_flatno')->nullable();
            $table->string('shipping_landmark')->nullable();
            $table->string('shipping_pincode')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_country')->nullable();
            $table->string('billing_name')->nullable();
            $table->string('billing_mobile')->nullable();
            $table->string('billing_addressline')->nullable();
            $table->string('billing_pincode')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('biling_state')->nullable();
            $table->string('billing_country')->nullable();
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
        Schema::dropIfExists('tbl_address');
    }
}
