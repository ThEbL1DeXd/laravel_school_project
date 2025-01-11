<div class="p-3"></div>
<form method="get" action="/quiz/take/{{$quiz->id}}}" class="w-75 m-auto p-5 bg-light rounded shadow-sm">
    <h3 class="text-center p-5 text-decoration-underline">Correct answer</h3>
    @foreach($quiz->question as $i => $ques)
        <div class="mb-4">
            <input type="hidden" value="{{$ques["id"]}}">
            <h4 class="mb-3 font-weight-bold">{{++$i.". ".$ques["question_text"]}}</h4>

            @foreach($ques->answer as $an)
                <div class="form-check mb-2">
                    <input
                        class="form-check-input"
                        type="radio"
                        value="{{ $an['answer_text'] }}"
                        readonly
                        {{ $ques['correct_answer'] == $an['answer_text'] ? 'checked' : '' }}>
                    <label class="form-check-label">
                        {{$an["answer_text"]}}
                    </label>
                </div>
            @endforeach
        </div>
    @endforeach

    <div class="text-center">
        <button class="btn btn-success btn-lg px-4">Retake</button>
        <a class="text-decoration-none" href="/quizes"><button class="btn btn-danger btn-lg px-4" type="button">Go back</button></a>
    </div>
</form>

