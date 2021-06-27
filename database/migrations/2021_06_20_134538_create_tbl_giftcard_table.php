<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblGiftcardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_giftcard', function (Blueprint $table) {
            $table->id('id');
            $table->string('title');
            $table->string('description');
            $table->string('denomiation');
            $table->string('seo_title');
            $table->string('seo_description');
            $table->string('seo_url')->nullable();
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
        Schema::dropIfExists('tbl_giftcard');
    }
}
