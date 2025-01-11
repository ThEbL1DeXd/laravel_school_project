@extends('layouts.headerTeacher')
@section('content')
<div class="container mt-5">
    <form method="post" action="/teacher/quiz/question" class="p-4 border rounded shadow bg-light form-question">
        @csrf
        <h2 class="mb-4 text-center">Insert Quiz Question</h2>
        <div class="mb-3">
            <label for="quiz_id" class="form-label">Quiz ID</label>
            <input type="text" name="quiz_id" id="quiz_id" class="form-control" readonly value="{{$id}}">
        </div>
        <div class="mb-3">
            <label for="question" class="form-label">Question</label>
            <input type="text" name="question" id="question" class="form-control" required>
        </div>
        @error('question')
        <div class="alert alert-danger mt-3 text-center">
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="correct_answer" class="form-label">Correct Answer</label>
            <input type="text" name="correct_answer" id="correct_answer" class="form-control" required>
        </div>
        @error('correct_answer')
        <div class="alert alert-danger mt-3 text-center">
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="answer" class="form-label">Answer</label>
            <div class="input-group">
                <input type="text" name="answer[]" id="answer" class="form-control" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="answer" class="form-label">Answer</label>
            <div class="input-group">
                <input type="text" name="answer[]" id="answer" class="form-control" required>
                <button type="button" id="add_answer" class="btn btn-success">+</button>
            </div>
        </div>
        @error('answer')
        <div class="alert alert-danger mt-3 text-center">
            {{ $message }}
        </div>
        @enderror
        <div class="text-center submit-button">
            <button type="submit" class="btn btn-primary">Insert</button>
        </div>
    </form>
</div>
<script src="/js.js"></script>
@endsection
