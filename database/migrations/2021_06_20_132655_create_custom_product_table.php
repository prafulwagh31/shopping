<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_product', function (Blueprint $table) {
            $table->id('id');
            $table->string('productname')->nullable();
            $table->string('unit')->nullable();
            $table->string('height')->nullable();
            $table->string('width')->nullable();
            $table->string('area')->nullable();
            $table->string('qty')->nullable();
            $table->string('price')->nullable();
            $table->string('total')->nullable();
            $table->string('taxtype')->nullable();
            $table->string('tax')->nullable();
            $table->string('hsn')->nullable();
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
        Schema::dropIfExists('custom_product');
    }
}
