<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCrminvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_crminvoice', function (Blueprint $table) {
            $table->id('id');
            $table->string('invoice_ref');
            $table->string('propoaslrefid')->nullable();
            $table->string('customername')->nullable();
            $table->string('type')->nullable();
            $table->date('invoicedate')->nullable();
            $table->string('paymentterms')->nullable();
            $table->string('paymenttype')->nullable();
            $table->string('note_public')->nullable();
            $table->string('note_private')->nullable();
            $table->string('barcode')->nullable();
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
        Schema::dropIfExists('tbl_crminvoice');
    }
}
