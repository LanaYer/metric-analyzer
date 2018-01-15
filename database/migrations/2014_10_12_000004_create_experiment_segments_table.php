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
        Schema::create('expsegments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('experiment_id');
            $table->integer('segment_id');
            $table->foreign('experiment_id')->references('id')->on('experiments');
            $table->foreign('segment_id')->references('id')->on('segments');
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
        Schema::dropIfExists('expsegments');
    }
}
