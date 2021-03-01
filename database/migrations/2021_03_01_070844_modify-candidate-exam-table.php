<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCandidateExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_exams', function (Blueprint $table) {
            $table->dropForeign(['candidate_id']);

            $table->foreign('candidate_id')
                ->references('id')
                ->on('candidates');
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
