<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdHouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_house', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('ad_id')->unsigned()->index();
            $table->bigInteger('house_id')->unsigned()->index();
            $table->timestamp('ending_date');
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
        Schema::dropIfExists('ad_house');
    }
}
