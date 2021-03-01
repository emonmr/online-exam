@extends('welcome')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{$question->exam->title}}</h1>
            <h2><b>Question:</b> {{$question->title}}</h2>
            <form  method="post" action="/exam/store/{{$question->id}}">
                @csrf

            @if ($question->options && count($question->options) > 0)
                <ul class="list-group">
                    @foreach($question->options as $option)
                        <li class="list-group-item">
                            {{$option->header->title}}.
                            <input type="radio" name="option" value="{{$option->id}}"/>
                            {{$option->title}}
                        </li>
                    @endforeach
                </ul>
            @else
                <textarea rows="10" class="form-control" name="narration" >

                </textarea>
            @endif
            <br>
                <input type="submit" name="send" value="Submit" class="btn btn-dark">
            </form>
        </div>
    </div>
@stop
