<?php

namespace Database\Seeders;

use App\Models\McqAnswer;
use App\Models\Option;
use App\Models\OptionHeader;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $question = new Question();
            $question->title = $faker->sentence(6, 2) . '?';
            $question->marks = 10;
            $question->question_type_id = $faker->randomElement([1, 2]);
            $question->save();
            // exam is now static
            $question->exams()->attach(1);

            if ($question->question_type_id == 1) {
                $optionHeader = OptionHeader::all();

                foreach ($optionHeader as $header) {
                    $option = new Option();
                    $option->question_id = $question->id;
                    $option->option_header_id = $header->id;
                    $option->title = $faker->word;
                    $option->save();
                }
                $optionIds = Option::where('question_id', $question->id)->get()->pluck('id')->toArray();
                $mcqAnswers = new McqAnswer();
                $mcqAnswers->question_id = $question->id;
                $mcqAnswers->option_id = $faker->randomElement($optionIds);
                $mcqAnswers->save();
            }
        }
    }
}
