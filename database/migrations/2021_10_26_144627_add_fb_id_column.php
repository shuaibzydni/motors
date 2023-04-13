<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFbIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyers', function (Blueprint $table) {
            $table->text('fb_id')->nullable();
        });

        Schema::table('sellers', function (Blueprint $table) {
            $table->text('fb_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buyers', function (Blueprint $table) {
            $table->dropColumn('fb_id');
        });

        Schema::table('sellers', function (Blueprint $table) {
            $table->dropColumn('fb_id');
        });
    }
}
