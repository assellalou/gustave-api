<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('subject');
            $table->string('chapter');
            $table->string('link');
            $table->unsignedBigInteger('teacher');
            $table->unsignedBigInteger('classe');
            $table->timestamp('start_time')->default(Carbon::today()->toDateString());
            $table->timestamp('end_time')->default(Carbon::today()->toDateString());
            $table->timestamps();

            $table->foreign('subject')->references('id')->on('subjects');
            $table->foreign('teacher')->references('id')->on('users');
            $table->foreign('classe')->references('id')->on('classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
