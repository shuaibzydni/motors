<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductBrandIdColumnToProductMakeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_makes', function (Blueprint $table) {
            $table->unsignedBigInteger('product_brand_id')->after('name')->nullable();

            $table->foreign('product_brand_id')->references('id')->on('product_brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_makes', function (Blueprint $table) {
            $table->removeColumn('product_brand_id');
        });
    }
}
