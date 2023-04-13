<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFcmDeviceIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->string('fcm_device_id')->nullable();
        });

        Schema::table('buyers', function (Blueprint $table) {
            $table->string('fcm_device_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->dropColumn('fcm_device_id');
        });

        Schema::table('buyers', function (Blueprint $table) {
            $table->dropColumn('fcm_device_id');
        });
    }
}
