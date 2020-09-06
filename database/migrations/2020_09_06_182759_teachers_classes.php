<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TeachersClasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers_classes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('classe');
            $table->unsignedBigInteger('teacher');

            $table->foreign('classe')->references('id')->on('classes');
            $table->foreign('teacher')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers_classes');
    }
}
