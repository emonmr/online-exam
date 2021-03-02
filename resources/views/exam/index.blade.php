@extends('welcome')
@section('content')
    <h3 class="mb-3">Examinations</h3>
    @foreach($exams as $exam)
        <ul class="list-group">
            @if($exam->firstQuestion)
                <li class="list-group-item" style="border: none;border-bottom: 1px solid #ddd">
                    <a href="/exam/{{$exam->firstQuestion->id}}">{{$exam->title}}</a>
                </li>
            @else
                <li class="list-group-item" style="border: none;border-bottom: 1px solid #ddd">
                    <a href="">{{$exam->title}}</a>
                </li>

            @endif
        </ul>
    @endforeach
@stop
