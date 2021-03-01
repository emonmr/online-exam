<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exams')->insert([
            'title' => 'Examination 1',
            'exam_time' => 30,
            'is_time_extended' => false,
            'is_negative_marking' => false,
            'is_all_question_same_marks' => true,
            'total_marks' => 50,
            'total_questions' => 5,
            'user_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('exams')->insert([
            'title' => 'Examination 2',
            'exam_time' => 10,
            'is_time_extended' => false,
            'is_negative_marking' => false,
            'is_all_question_same_marks' => true,
            'total_marks' => 10,
            'total_questions' => 10,
            'user_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

    }
}
