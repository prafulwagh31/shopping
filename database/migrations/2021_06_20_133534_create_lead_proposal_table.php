<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadProposalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_proposal', function (Blueprint $table) {
            $table->id('id');
            $table->string('proposal_ref_id')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->date('proposal_date')->nullable();
            $table->string('duration')->nullable();
            $table->string('payment_term')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('source')->nullable();
            $table->string('delay')->nullable();
            $table->string('shipping_method')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('barcode')->nullable();
            $table->string('note')->nullable();
            $table->string('proposal_status')->nullable();
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
        Schema::dropIfExists('lead_proposal');
    }
}
