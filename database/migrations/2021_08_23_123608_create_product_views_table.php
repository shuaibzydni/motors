<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement(
            "
            CREATE VIEW product_views
            AS
            SELECT
                products.*,
                product_brands.name as brand_name,
                product_makes.name as model_name,
                body_types.title as body_type,
                fuel_types.name as fuel_type,
                drive_types.title as drive_type,
                transmissions.title as transmission
            FROM
                products
                LEFT JOIN product_brands ON products.product_brand_id = product_brands.id
                LEFT JOIN product_makes ON products.product_make_id = product_makes.id
                LEFT JOIN body_types ON products.body_type_id = body_types.id
                LEFT JOIN fuel_types ON products.fuel_type_id = fuel_types.id
                LEFT JOIN drive_types ON products.drive_type_id = drive_types.id
                LEFT JOIN transmissions ON products.transmission_id = transmissions.id;
            "
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement("
            DROP VIEW IF EXISTS product_views;
        ");
    }
}
