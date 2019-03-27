<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('teacher');
            $table->foreign('teacher')->references('name')->on('teachers')->onDelete('cascade');
            $table->string('course');
            $table->foreign('course')->references('name')->on('courses');
            $table->decimal('cAvailable',4,1)->unsigned();
            $table->boolean('dirPermission');
            $table->boolean('profPermission');
            $table->boolean('coorPermission');
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
        Schema::dropIfExists('elections');
    }
}
