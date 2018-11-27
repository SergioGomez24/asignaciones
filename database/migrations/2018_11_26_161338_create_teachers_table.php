<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('dni');
            $table->string('category');
            $table->foreign('category')->references('name')->on('categories');
            $table->string('area');
            $table->foreign('area')->references('name')->on('areas');
            $table->tinyInteger('cInitial');
            $table->date('dateCategory');
            $table->date('dateUCA');
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
        Schema::dropIfExists('teachers');
    }
}
