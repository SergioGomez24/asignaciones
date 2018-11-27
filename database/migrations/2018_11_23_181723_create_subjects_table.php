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
            $table->string('name');
            $table->string('certification');
            $table->foreign('certification')->references('name')->on('certifications');
            $table->string('area');
            $table->foreign('area')->references('name')->on('areas');
            $table->string('campus');
            $table->foreign('campus')->references('name')->on('campus');
            $table->string('center');
            $table->foreign('center')->references('name')->on('centers');
            $table->tinyInteger('cTheory');
            $table->tinyInteger('cSeminar');
            $table->tinyInteger('cPractice');
            $table->string('duration');
            $table->string('imparted');
            $table->string('typeSubject');
            $table->string('coordinator');
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
