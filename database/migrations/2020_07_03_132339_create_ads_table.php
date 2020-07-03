<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name');
            $table->integer('price');
            $table->string('duration');
            $table->timestamps();
        });
        DB::table('ads')
       ->insert(
           array(
               array('name' => 'Basic','price' => 299,'duration'=>'24'),
               array('name' => 'Intermediate','price' => 599,'duration'=>'72'),
               array('name' => 'Advanced','price' => 999,'duration'=>'144')
           )
       );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
