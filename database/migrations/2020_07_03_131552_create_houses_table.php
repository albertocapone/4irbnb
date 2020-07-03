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
            $table->tinyInteger('sqm');
            $table->string('address');
            $table->string('lat');
            $table->string('long');
            $table->string('img_url');
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
