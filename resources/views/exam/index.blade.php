@extends('welcome')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Examinations</h3>
            @foreach($exams as $exam)
                <p>
                    @if($exam->firstQuestion)
                    <a href="/exam/{{$exam->firstQuestion->id}}">{{$exam->title}}</a>
                    @else
                        <a href="">{{$exam->title}}</a>
                    @endif
                </p>
            @endforeach

        </div>
    </div>
@stop
