@extends('layouts.headerTeacher')
@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Quiz List</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($students as $val)
                <tr>
                    <td class="text-center">{{$val['id']}}</td>
                    <td>{{$val['name']}}</td>
                    <td class="text-center">{{$val['email']}}</td>
                    <td class="text-center">
                        <a href="/teacher/students/show/{{$val['id']}}" class="btn btn-primary btn-sm mb-2">Show
                            Results</a>
                        <form method="post" action="/teacher/students/dell/{{$val['id']}}" class="d-inline">
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

