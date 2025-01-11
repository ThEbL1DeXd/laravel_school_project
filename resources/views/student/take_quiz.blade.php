@extends('layouts.headerStudent')
@section('content')
    <div class="p-3"></div>
    <form method="post" action="/quiz/take" class="w-75 m-auto p-5 bg-light rounded shadow-sm">
        @csrf
        <input type="hidden" name="quiz_id" value="{{$quiz["id"]}}">

        @foreach($quiz->question as $i => $ques)
            <div class="mb-4">
                <input type="hidden" name="question_id[]" value="{{$ques["id"]}}">
                <h4 class="mb-3 font-weight-bold">{{++$i.". ".$ques["question_text"]}}</h4>

                @foreach($ques->answer as $an)
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="answer{{$ques["id"]}}" value="{{$an["answer_text"]}}" id="answer{{$ques["id"]}}_{{$loop->index}}">
                        <label class="form-check-label" for="answer{{$ques["id"]}}_{{$loop->index}}">
                            {{$an["answer_text"]}}
                        </label>
                    </div>
                @endforeach
            </div>
        @endforeach

        <div class="text-center">
            <button class="btn btn-success btn-lg px-4">Submit Answers</button>
        </div>
    </form>
@endsection
