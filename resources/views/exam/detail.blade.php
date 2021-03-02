@extends('welcome')
@section('content')
    <h1 class="mb-4">{{$question->exam->title}}</h1>
    <p class="mb-2"><b>Question:</b> {{$question->title}}</p>
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
            <textarea rows="5" class="form-control" name="narration" >

                </textarea>
        @endif
        <br>
        <input type="submit" name="send" value="Submit" class="btn btn-dark">
    </form>
@stop
