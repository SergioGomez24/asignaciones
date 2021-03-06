<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name')->unique();
            $table->integer('certification_id')->unsigned();
            $table->foreign('certification_id')->references('id')->on('certifications');
            $table->integer('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('areas');
            $table->integer('campus_id')->unsigned();
            $table->foreign('campus_id')->references('id')->on('campus');
            $table->integer('center_id')->unsigned();
            $table->foreign('center_id')->references('id')->on('centers');
            $table->decimal('cTheory',10,1)->nullable()->unsigned();
            $table->decimal('cSeminar',10,1)->nullable()->unsigned();
            $table->decimal('cPractice',10,1)->nullable()->unsigned();
            $table->integer('duration_id')->unsigned();
            $table->foreign('duration_id')->references('id')->on('durationsubjects');
            $table->integer('imparted_id')->unsigned();
            $table->foreign('imparted_id')->references('id')->on('coursesubjects');
            $table->integer('typeSubject_id')->unsigned();
            $table->foreign('typeSubject_id')->references('id')->on('typesubjects');
            $table->integer('coordinator_id')->unsigned();
            $table->foreign('coordinator_id')->references('id')->on('teachers');
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
        Schema::dropIfExists('subjects');
    }
}
