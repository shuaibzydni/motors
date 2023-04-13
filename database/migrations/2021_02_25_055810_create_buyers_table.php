<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("buyers", function (Blueprint $table) {
            $table->id();
            $table->string("first_name");
            $table->string("last_name")->nullable();
            $table->string("email")->unique();
            $table->timestamp("email_verified_at")->nullable();
            $table->string("password");
            $table->rememberToken();
            $table->text("avatar_path")->nullable();
            $table->string("business_name")->nullable();
            $table->string("business_phone")->nullable();
            $table->string("business_email")->nullable();
            $table->string("business_registration_document")->nullable();
            $table->string("abn")->nullable();
            $table->string("buyer_license_no")->nullable();
            $table->string("address_line")->nullable();
            $table->unsignedBigInteger("location_id")->nullable()->comment("state");
            $table->string("postal_code", 10)->nullable();
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
        Schema::dropIfExists("buyers");
    }
}
