<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("products", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("seller_id");
            $table->string("advertisement_id")->unique();
            $table->unsignedBigInteger("product_brand_id");
            $table->unsignedBigInteger("product_make_id");
            $table->unsignedBigInteger("body_type_id");
            $table->unsignedBigInteger("drive_type_id");
            $table->unsignedBigInteger("fuel_type_id");
            $table->unsignedBigInteger("transmission_id");
            $table->integer("model_year");
            $table->string("name")->nullable();
            $table->text("model_description");
            $table->string("odometer_mileage");
            $table->string("vehicle_registration_number");
            $table->string("vehicle_vin");
            $table->decimal("vehicle_price", 13);
            $table->string("service_log_book")->nullable();
            $table->string("front_image")->nullable();
            $table->string("rear_image")->nullable();
            $table->string("left_side_image")->nullable();
            $table->string("interior_image")->nullable();
            $table->string("cargo_area_image")->nullable();
            $table->string("engine_bay_image")->nullable();
            $table->string("roof_image")->nullable();
            $table->string("wheels_image")->nullable();
            $table->string("keys_image")->nullable();
            $table->string("owners_manual")->nullable();
            $table->enum("vehicle_status", \App\Models\Product::VEHICLE_STATUS)->default(\App\Models\Product::VEHICLE_STATUS['AVAILABLE']);
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
        Schema::dropIfExists("products");
    }
}
