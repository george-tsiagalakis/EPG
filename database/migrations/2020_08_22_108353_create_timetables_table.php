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
            $table->uuid('id')->primary();
            $table->uuid('channel_id');
            $table->uuid('programme_id');
            $table->dateTimeTz('start_time', 0);
            $table->dateTimeTz('end_time', 0);
            $table->string('timezone', 30);
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
