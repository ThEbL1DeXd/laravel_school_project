@extends('layouts.headerTeacher')
@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Quiz List</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Duration</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($quizes as $val)
                <tr>
                    <td class="text-center">{{$val['id']}}</td>
                    <td>{{$val['title']}}</td>
                    <td class="text-center">{{$val['description']}}</td>
                    <td class="text-center">
                        <a href="/teacher/quiz/question/show/{{$val['id']}}" class="btn btn-primary btn-sm mb-2">Show
                            Question</a>
                        <a href="/teacher/quiz/question/{{$val['id']}}" class="btn btn-success btn-sm mb-2">Add Question</a>
                        <form method="post" action="/teacher/quiz/dell/{{$val['id']}}" class="d-inline">
                            @csrf
                            <button class="btn btn-danger btn-sm mb-2">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

