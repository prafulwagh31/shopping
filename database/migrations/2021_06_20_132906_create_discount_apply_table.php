<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountApplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_apply', function (Blueprint $table) {
            $table->id('id');
            $table->string('coupen_id')->nullable();
            $table->string('coupen')->nullable();
            $table->string('cart_ref_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('coupen_amount')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('user_id')->nullable();
            $table->string('order_id')->nullable();
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
        Schema::dropIfExists('discount_apply');
    }
}
