<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('houses', function (Blueprint $table) {
            $table->foreign('user_id', 'user')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('views', function (Blueprint $table) {
            $table->foreign('house_id', 'house_views')->references('id')->on('houses')->onDelete('cascade');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->foreign('house_id', 'house_messages')->references('id')->on('houses')->onDelete('cascade');
        });

        Schema::table('ad_house', function (Blueprint $table) {
            $table->foreign('ad_id', 'ad_to_house')->references('id')->on('ads')->onDelete('cascade');
            $table->foreign('house_id', 'house_to_ad')->references('id')->on('houses')->onDelete('cascade');
        });

        Schema::table('house_service', function (Blueprint $table) {
            $table->foreign('house_id', 'house_to_service')->references('id')->on('houses')->onDelete('cascade');
            $table->foreign('service_id', 'service_to_house')->references('id')->on('services')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('houses', function (Blueprint $table) {
            $table->dropForeign('user');
        });

        Schema::table('views', function (Blueprint $table) {
            $table->dropForeign('house_views');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign('house_messages');
        });

        Schema::table('ad_house', function (Blueprint $table) {
            $table->dropForeign('ad_to_house');
            $table->dropForeign('house_to_ad');
        });

        Schema::table('house_service', function (Blueprint $table) {
            $table->dropForeign('house_to_service');
            $table->dropForeign('service_to_house');
        });
    }
}
