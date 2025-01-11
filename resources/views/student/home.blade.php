@extends('layouts.headerStudent')
@section('content')
    <div class="row m-auto w-75 p-2">
        @foreach($quizes as $val)
            <div class=" col-12 col-sm-6">
                <div class="card m-2 w-75" style="width: 18rem;">
                    <img class="card-img-top" src="{{ asset('storage/' . $val->img) }}" alt="Quiz Image">
                    <div class="card-body">
                        <h5 class="card-title"> {{$val['title']}}</h5>
                        <p class="card-text">{{$val['description']}}.</p>
                        <a href="/quiz/take/{{$val['id']}}" class="btn btn-primary">Take quiz</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection



