<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrioritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('priorities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('priority')->unsigned();
            $table->foreign('priority')->references('rank')->on('categories');
            $table->string('teacher');
            $table->foreign('teacher')->references('name')->on('teachers')->onDelete('cascade');
            $table->string('course');
            $table->foreign('course')->references('course')->on('courses');
            $table->decimal('cAvailable',4,1)->unsigned();
            $table->date('dateCategory');
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
        Schema::dropIfExists('priorities');
    }
}
