<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProductVarientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product_varient', function (Blueprint $table) {
            $table->id('id');
            $table->integer('product_id')->nullable();
            $table->string('attribute_id')->nullable();
            $table->string('term_id')->nullable();
            $table->string('attribute_image')->nullable();
            $table->integer('attribute_quantity')->nullable();
            $table->string('sku')->nullable();
            $table->string('attrprice')->nullable();
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
        Schema::dropIfExists('tbl_product_varient');
    }
}
