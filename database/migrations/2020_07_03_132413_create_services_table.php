<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name');
            $table->timestamps();
        });
        DB::table('services')
       ->insert(
           array(
               array('name' => 'Wifi'),
               array('name' => 'Parking'),
               array('name' => 'Pool'),
               array('name' => 'Concierge'),
               array('name' => 'Sauna'),
               array('name' => 'Seaview')
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
        Schema::dropIfExists('services');
    }
}
