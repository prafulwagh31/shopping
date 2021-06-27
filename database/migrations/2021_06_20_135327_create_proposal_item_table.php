<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposal_item', function (Blueprint $table) {
            $table->id('id');
            $table->string('proposal_id')->nullable();
            $table->string('product_type')->nullable();
            $table->string('price')->nullable();
            $table->string('discount')->nullable();
            $table->string('qty')->nullable();
            $table->string('total')->nullable();
            $table->string('totaltax')->nullable();
            $table->string('product_id')->nullable();
            $table->string('taxtype')->nullable();
            $table->string('tax')->nullable();
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
        Schema::dropIfExists('proposal_item');
    }
}
