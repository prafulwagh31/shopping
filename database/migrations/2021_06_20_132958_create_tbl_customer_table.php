<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_customer', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->string('company');
            $table->string('address');
            $table->string('apartment');
            $table->string('city');
            $table->string('country');
            $table->string('postalcode');
            $table->string('notes');
            $table->string('tags');
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
        Schema::dropIfExists('tbl_customer');
    }
}
