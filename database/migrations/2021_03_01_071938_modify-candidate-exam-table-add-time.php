<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCandidateExamTableAddTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_exams', function (Blueprint $table) {
            $table->unsignedSmallInteger('answer_time')
                ->after('answer')
                ->comment('answer time in minutes');
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
