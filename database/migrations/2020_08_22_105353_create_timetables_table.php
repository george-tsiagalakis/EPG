<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->dateTimeTz('start_time', 0);
            $table->dateTimeTz('end_time', 0);
            $table->unsignedBigInteger('channel_id');
            $table->unsignedBigInteger('programme_id');
            $table->timestamps();

            $table->foreign('channel_id')->references('id')->on('channels');
            $table->foreign('programme_id')->references('id')->on('programmes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timetables');
    }
}
