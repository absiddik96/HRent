<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('house_id');
            $table->integer('bed_room');
            $table->integer('wash_room');
            $table->integer('porches');
            $table->integer('drawing_room');
            $table->integer('dining_room');
            $table->integer('store_room');
            $table->integer('rent_amount');
            $table->timestamps();

            $table->foreign('house_id')->references('id')->on('house_infos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('house_details');
    }
}
