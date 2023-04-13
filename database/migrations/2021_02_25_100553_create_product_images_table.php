<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("product_images", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("product_id");
            $table->text("image_path");
            $table->enum("image_type", \App\Models\ProductImage::IMAGE_TYPE);
            $table->timestamps();

            $table
                ->foreign("product_id")
                ->references("id")
                ->on("products");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("product_images");
    }
}
