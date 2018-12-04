<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->foreign('subject')->references('name')->on('subjects');
            $table->string('teacher');
            $table->foreign('teacher')->references('name')->on('teachers');
            $table->string('course');
            $table->integer('credT')->unsigned()->nullable();
            $table->integer('credP')->unsigned()->nullable();
            $table->integer('credS')->unsigned()->nullable();
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
        Schema::dropIfExists('applications');
    }
}
