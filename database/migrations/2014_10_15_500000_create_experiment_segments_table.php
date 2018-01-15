<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperimentSegmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiment_segments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('experiment_id')->unsigned();
            $table->integer('segment_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('experiment_segments', function (Blueprint $table) {
            $table->foreign('experiment_id')->references('id')->on('experiments');
            $table->foreign('segment_id')->references('id')->on('segments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experiment_segments');
    }
}
