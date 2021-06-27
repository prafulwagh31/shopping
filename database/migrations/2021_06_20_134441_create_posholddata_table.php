<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosholddataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posholddata', function (Blueprint $table) {
            $table->id('id');
            $table->string('product_id')->nullable();
            $table->string('qty')->nullable();
            $table->string('price')->nullable();
            $table->string('username')->nullable();
            $table->string('discount')->nullable();
            $table->string('total')->nullable();
            $table->string('changedue')->nullable();
            $table->string('paymethod')->nullable();
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
        Schema::dropIfExists('posholddata');
    }
}
