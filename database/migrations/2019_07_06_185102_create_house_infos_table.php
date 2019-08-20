<?php

use App\Models\HouseInfo;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('house_type_id');
            $table->string('title');
            $table->string('slug');
            $table->string('house_address');
            $table->boolean('status')->default(HouseInfo::STATUS['Deactive']);
            $table->boolean('is_approved')->default(HouseInfo::IS_APPROVED['Unapproved']);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('house_type_id')->references('id')->on('house_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('house_infos');
    }
}
