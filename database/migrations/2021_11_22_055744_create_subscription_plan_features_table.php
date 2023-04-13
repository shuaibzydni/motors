<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPlanFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("subscription_plan_features", function (
            Blueprint $table
        ) {
            $table->id();
            $table->unsignedBigInteger("subscription_plan_id");
            $table->string("features");
            $table->timestamps();

            $table
                ->foreign("subscription_plan_id")
                ->references("id")
                ->on("subscription_plans")
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("subscription_plan_features");
    }
}
