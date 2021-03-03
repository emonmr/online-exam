@extends('welcome')
@section('content')
    <div class="jumbotron">
        <h1 class="display-4">Well Done!</h1>
        <p class="lead">Your exam is complete. Our teacher will verify and let you know final answer.</p>
        <hr class="my-4">
        <div class="mb-5">
            <p><b>Total Questions </b>: {{$totalQuestion}}</p>
            <p><b>Total MCQ Correct Answer </b>: {{$totalCorrectAnswer}}</p>
        </div>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="/" role="button">Back to exam homepage</a>
        </p>
    </div>
@stop
@section('javascript')
    <script type="text/javascript">
        window.localStorage.removeItem('exam_end_time')
    </script>
@stop
