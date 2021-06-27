<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_inventory', function (Blueprint $table) {
            $table->id('id');
            $table->integer('product_id')->nullable();
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->string('minqty')->nullable();
            $table->string('maxqty')->nullable();
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
        Schema::dropIfExists('tbl_inventory');
    }
}
