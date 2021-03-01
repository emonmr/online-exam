<?php

namespace App\Http\Controllers;

use App\Models\CandidateExam;
use App\Models\Exam;
use App\Models\McqAnswer;
use App\Models\Question;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::with('firstQuestion')->get();
        return view('exam.index', compact('exams'));
    }

    public function detail($id)
    {
        $question = Question::with('exam', 'options', 'options.header')->find($id);
        return view('exam.detail', compact('question'));
    }

    public function store($id, Request $request)
    {
        //dd($request->all());
        $candidateExam = new CandidateExam();
        $candidateExam->candidate_id = 1;
        $candidateExam->question_id = $id;
        if ($request->has('option')) {
            $questionAnswer = McqAnswer::where('question_id', $id)->first();
            if ($questionAnswer) {
                $candidateExam->mcq_answer_id = $questionAnswer->id;

                if ($questionAnswer->option_id == $request->option) {
                    $candidateExam->is_correct = 1;
                    // currently static
                    $candidateExam->marks = 10;
                } else {
                    $candidateExam->is_correct = 0;
                    $candidateExam->marks = 0;

                }
            }

        }
        if ($request->has('narration')) {
            $candidateExam->answer = $request->narration;
            $candidateExam->marks = 0;

        }
        // currently static
        $candidateExam->answer_time = 6;
        $question = Question::with('exam')->find($id);
         $candidateExam->exam_id = $question->exam->id;
        if ($candidateExam->save()) {
            $nexId = $id + 1;
            $nextQuestion = Question::with('exam')->find($nexId);
            if ($question && $nextQuestion && $question->exam_id == $nextQuestion->exam_id) {
                return redirect('/exam/' . $nexId);
            } else {
                // candidate id is now currently static
                return redirect('/exam/result/'.$question->exam->id.'/1');
            }
        }
    }

    public function result($examId, $userId)
    {
        $totalQuestion = CandidateExam::where('candidate_id', $userId)
            ->where('exam_id', $examId)->groupBy('candidate_id', 'candidate_id')->count();


        $totalCorrectAnswer = CandidateExam::where('candidate_id', $userId)
            ->where('is_correct', 1)
            ->where('exam_id', $examId)->groupBy('candidate_id', 'candidate_id')->count();

        return view('exam.result', compact('totalQuestion', 'totalCorrectAnswer'));
    }

}
