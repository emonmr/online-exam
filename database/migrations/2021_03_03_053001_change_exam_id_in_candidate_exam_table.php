<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeExamIdInCandidateExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_exams', function (Blueprint $table) {
            $table->dropForeign(['exam_id']);
            $table->dropColumn(['exam_id']);
            $table->unsignedBigInteger('candidate_session_id');
            $table->foreign('candidate_session_id')->references('id')->on('candidate_session');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidate_exams', function (Blueprint $table) {
            //
        });
    }
}
