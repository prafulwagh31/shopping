<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer', function (Blueprint $table) {
            $table->id('id');
            $table->string('transferid');
            $table->string('productid');
            $table->string('quantity');
            $table->string('supplierid');
            $table->date('expected_arrival');
            $table->string('tracking_number')->nullable();
            $table->string('shipping_carrier')->nullable();
            $table->string('referencenumber')->nullable();
            $table->string('tag')->nullable();
            $table->string('price');
            $table->string('tax');
            $table->string('taxtype');
            $table->string('tax_percentage')->nullable();
            $table->string('paurchase_price')->nullable();
            $table->integer('accept')->nullable();
            $table->integer('cancel')->nullable();
            $table->integer('reject')->nullable();
            $table->string('status');
            $table->string('product_type')->nullable();
            $table->string('proposal_id')->nullable();
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
        Schema::dropIfExists('transfer');
    }
}
