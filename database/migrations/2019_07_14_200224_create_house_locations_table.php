<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('house_id')->index();
            $table->unsignedBigInteger('country_id')->index();
            $table->unsignedBigInteger('division_id')->index();
            $table->unsignedBigInteger('city_id')->index();
            $table->unsignedBigInteger('police_station_id')->index();
            $table->unsignedBigInteger('word_id')->index();
            $table->unsignedBigInteger('village_id')->index();
            $table->timestamps();

            $table->foreign('house_id')->references('id')->on('house_infos')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('police_station_id')->references('id')->on('police_stations')->onDelete('cascade');
            $table->foreign('word_id')->references('id')->on('words')->onDelete('cascade');
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('house_locations');
    }
}
