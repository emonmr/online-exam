<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_exams', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('candidate_id');
            $table->foreign('candidate_id')->references('id')->on('users');

            $table->foreignId('question_id')->constrained();

            $table->foreignId('mcq_answer_id')->nullable()->constrained();
            $table->unsignedSmallInteger('marks');
            $table->boolean('is_correct')->nullable()->comment('Boolean for mcq questions');
            $table->string('answer')->nullable()->comment('for narrative answer');

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
        Schema::dropIfExists('candidate_exams');
    }
}
