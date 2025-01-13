@extends('layouts.headerTeacher')
@section('content')
    <h3 class="text-center p-5">{{$student->name}}</h3>
    <table class="table table-striped w-50 m-auto">
        <thead>
        <tr>
            <th scope="col">quiz name</th>
            <th scope="col">note</th>
        </tr>
        </thead>
        <tbody>
        @foreach($student->quizzes as $quiz)
            <tr>
                <td>{{$quiz->title}}</td>
                <td>{{$quiz->pivot->note}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
