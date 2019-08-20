<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('country_id')->index();
            $table->unsignedBigInteger('division_id')->index();
            $table->unsignedBigInteger('city_id')->index();
            $table->unsignedBigInteger('police_station_id')->index();
            $table->unsignedBigInteger('word_id')->index();
            $table->string('village');
            $table->string('slug');
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('police_station_id')->references('id')->on('police_stations')->onDelete('cascade');
            $table->foreign('word_id')->references('id')->on('words')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('villages');
    }
}
