@extends('welcome')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    @endif
    <h1 class="mb-4">{{$exam->title}}</h1>
    <p class="mb-2"><b>Question {{$question->id}} :</b> {{$question->title}}</p>
    <countdown-component until="{{$examEndTime}}"></countdown-component>
    <form style="width: 500px" method="post" action="/exam/store/{{$question->id}}">
        @csrf
        @if ($question->options && count($question->options) > 0)
            <ul class="list-group">
                @foreach($question->options as $key=> $option)
                    <li class="list-group-item">
                        {{$option->header->title}}.
                        <input type="radio" name="option" id="{{$key}}" value="{{$option->id}}"/>
                        <label for="{{$key}}">{{$option->title}}</label>
                    </li>
                @endforeach
            </ul>
        @else
            <textarea rows="5" class="form-control" name="narration"></textarea>
        @endif
        <input type="hidden" name="question_type_id" value="{{$question->question_type_id}}">
        <input type="hidden" name="exam_id" value="{{$exam->id}}">
        <input type="hidden" name="candidate_session" value="{{$session}}">
        <br>
        <input type="submit" name="send" value="Submit" class="btn btn-dark" id="submitQuestion">
    </form>
    <a href="/" class="btn btn-link"  onclick="return confirm('Are you sure to exit from your exam.?')">Back to Home</a>
@stop
