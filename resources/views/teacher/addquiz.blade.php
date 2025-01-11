@extends('layouts.headerTeacher')
@section('content')
    <div class="p-4"></div>
<form method="post" action="/teacher/quiz/add" class="p-4 border rounded shadow bg-light w-75 m-auto" enctype="multipart/form-data">
    @csrf
    <h2 class="mb-4 text-center">Add Quiz</h2>
    <table class="table table-bordered">
        <tr>
            <td><label for="username" class="form-label">Username</label></td>
            <td><input name="username" class="form-control" readonly value="{{ session('username') }}"></td>
        </tr>
        <tr>
            <td><label for="title" class="form-label">Title</label></td>
            <td><input name="title" class="form-control" required></td>
        </tr>
        <tr>
            <td><label for="description" class="form-label">Description</label></td>
            <td><input type="text" name="description" class="form-control" required></td>
        </tr>
        <tr>
            <td><label for="img" class="form-label">Img</label></td>
            <td><input type="file" name="img" class="form-control" required></td>
        </tr>
    </table>
    @error('title')
    <div class="alert alert-danger mt-3 text-center">
        {{ $message }}
    </div>
    @enderror
    @error('description')
    <div class="alert alert-danger mt-3 text-center">
        {{ $message }}
    </div>
    @enderror
    @error('img')
    <div class="alert alert-danger mt-3 text-center">
        {{ $message }}
    </div>
    @enderror
    <div class="text-center">
        <button type="submit" class="btn btn-primary">Insert</button>
    </div>

</form>
@endsection
