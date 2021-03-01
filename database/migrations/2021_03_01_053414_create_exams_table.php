<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedSmallInteger('exam_time')->comment('exam time in minutes');
            $table->boolean('is_time_extended')->comment('if time is extended then user can continue');
            $table->boolean('is_negative_marking');
            $table->boolean('is_all_question_same_marks');
            $table->unsignedSmallInteger('total_marks');
            $table->unsignedSmallInteger('total_questions');
            $table->unsignedBigInteger('user_id')->comment('Teacher Id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('exams');
    }
}
