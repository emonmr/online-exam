@extends('welcome')
@section('content')
    <h3 class="mb-3">Examinations</h3>
    <exam-component :examinations='@json($exams)'></exam-component>
@stop
