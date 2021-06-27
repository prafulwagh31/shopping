<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->id('id');
            $table->string('product_name');
            $table->string('product_description')->nullable();
            $table->string('group_product_id')->nullable();
            $table->string('product_category');
            $table->string('product_brand')->nullable();
            $table->string('product_media')->nullable();
            $table->string('product_gallery')->nullable();
            $table->string('product_type')->nullable();
            $table->string('regular_price')->nullable();
            $table->string('sale_price')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('seo_url')->nullable();
            $table->string('seo_key')->nullable();
            $table->string('download_limit')->nullable();
            $table->string('download_file')->nullable();
            $table->string('download_url')->nullable();
            $table->string('sale_start_date')->nullable();
            $table->string('sale_end_date')->nullable();
            $table->string('download_expiary')->nullable();
            $table->string('up_sell')->nullable();
            $table->string('cross_sell')->nullable();
            $table->string('product_url')->nullable();
            $table->string('btn_txt')->nullable();
            $table->string('taxstatus')->nullable();
            $table->string('salestatus')->nullable();
            $table->string('purchasestatus')->nullable();
            $table->string('warehouse')->nullable();
            $table->string('deliveryflab')->nullable();
            $table->string('tax')->nullable();
            $table->string('taxwith')->nullable();
            $table->string('shippingclass')->nullable();
            $table->string('compositqty')->nullable();
            $table->string('unitheight')->nullable();
            $table->string('unitwidth')->nullable();
            $table->string('unitarea')->nullable();
            $table->string('unitquantity')->nullable();
            $table->string('unitdata')->nullable();
            $table->string('hsn')->nullable();
            $table->string('specification')->nullable();
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
        Schema::dropIfExists('tbl_product');
    }
}
