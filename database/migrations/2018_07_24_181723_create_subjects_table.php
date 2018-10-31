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
            $table->string('code');
            $table->string('name');
            $table->string('certification');
            $table->string('area');
            $table->string('campus');
            $table->string('center');
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
