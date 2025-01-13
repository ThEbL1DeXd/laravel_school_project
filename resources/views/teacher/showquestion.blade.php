@extends('layouts.headerTeacher')
@section('content')
    <div class="p-4"></div>
@foreach($quiz->question as $val)
    <div class="table-responsive mb-4 w-75 m-auto">
        <table class="table table-bordered table-striped">
            <thead>
            <tr class="table-primary">
                <th colspan="2" class="text-center">{{$val->quiz->title}}</th>
            </tr>
            <tr class="table-primary">
                <th>Question</th>
                <td>{{ $val['question_text'] }}</td>
            </tr>
            </thead>
            <tbody>
            @foreach($val->answer as $answer)
                <tr>
                    <th>Answer</th>
                    <td>{{ $answer['answer_text'] }}</td>
                </tr>
            @endforeach
            <tr class="table-success">
                <th>Correct Answer</th>
                <td>{{ $val['correct_answer'] }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endforeach
@endsection
