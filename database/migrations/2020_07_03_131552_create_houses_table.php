<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->string('title');
            $table->text('description');
            $table->tinyInteger('rooms');
            $table->tinyInteger('beds');
            $table->tinyInteger('bathrooms');
            $table->smallInteger('sqm');
            $table->string('address');
            $table->string('lat');
            $table->string('lng');
            $table->string('house_img');
            $table->boolean('visibility');
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
        Schema::dropIfExists('houses');
    }
}
