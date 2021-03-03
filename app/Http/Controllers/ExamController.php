<?php

namespace App\Http\Controllers;

use App\Models\CandidateExam;
use App\Models\CandidateSession;
use App\Models\Exam;
use App\Models\McqAnswer;
use App\Models\Question;
use Carbon\Carbon;
use DateTime;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::with('firstQuestion')->get();
        return view('exam.index', compact('exams'));
    }


    public function detail($session, $examId, $questionId, $userId)
    {
        $question = Question::with('options', 'options.header')->find($questionId);
        $exam = Exam::find($examId);
        $candidateSession = CandidateSession::where('candidate_id', $userId)
            ->where('exam_id', $examId)
            ->where('exam_session', $session)
            ->first();
        $examEndTime = $candidateSession->exam_end_time;

        return view('exam.detail', compact('question', 'exam', 'session', 'examEndTime'));
    }

    public function store($id, Request $request)
    {
        $candidateSession = CandidateSession::where('candidate_id', 1)
            ->where('exam_id', $request->exam_id)
            ->where('exam_session', $request->candidate_session)
            ->first();
        $examTime = new DateTime($candidateSession->exam_end_time);

        //dd($examTime);
        $currentTime = new DateTime(date('Y-m-d H:i:s'));

        if (Carbon::now()->greaterThan($examTime)) {
            return redirect('/');

        }

        $request->validate([
            'option' => 'exclude_unless:question_type_id,1|required',
            'narration' => 'exclude_unless:question_type_id,2|required',
            'exam_id' => 'required',
            'candidate_session' => 'required'
        ]);
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
        $candidateExam->answer_time = 0;
        if ($candidateSession) {
            $candidateExam->candidate_session_id = $candidateSession->id;
        }
        if ($candidateExam->save()) {
            $exam = Exam::with('questions')->find($request->exam_id);
            $questions = $exam->questions->pluck('id')->values()->toArray();
            // Search for next question
            $index = array_search($id, $questions);
            if ($index !== false && $index < count($questions) - 1) {
                $next = $questions[$index + 1];
                return redirect('/exam/' . $request->candidate_session . '/' . $request->exam_id . '/' . $next . '/1');
            } else {
                $candidateSession->is_completed = true;
                return redirect('/exam/result/' . $exam->id . '/1');
            }
        }
    }

    public function result($examId, $userId)
    {
        $totalQuestion = 10; // static
        $totalCorrectAnswer = 5; // static
        return view('exam.result', compact('totalQuestion', 'totalCorrectAnswer'));
    }

    public function createSession(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'exam_id' => 'required',
            'candidate_id' => 'required',
            'exam_session' => 'required',
            'exam_end_time' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'errors' => $validator->messages()
                ], Response::HTTP_BAD_REQUEST);
        }

        $session = new CandidateSession();
        $session->candidate_id = $request->candidate_id;
        $session->exam_id = $request->exam_id;
        $session->exam_session = $request->exam_session;
        $session->exam_end_time = $request->exam_end_time;
        $session->save();

        return response()->json([
            'message' => 'New session created',
            'data' => $session
        ]);
    }
}
