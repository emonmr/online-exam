@extends('welcome')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">
                Your exam is complete. Our teacher will verify and let you know final answer.
            </h1>
            <p><b>Total Questions </b>: {{$totalQuestion}}</p>
            <p><b>Total MCQ Correct Answer </b>: {{$totalCorrectAnswer}}</p>
            <a href="/exam" class="btn btn-primary"> Back to exam homepage </a>
        </div>
    </div>
@stop
