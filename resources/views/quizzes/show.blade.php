@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ $quiz->title }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        {{ $quiz->description }}
                        <div class="col text-center">
                            @if ($quiz->user_id === auth()->user()->id)
                                <a href="{{ route('quizzes.quizquestions.create', $quiz->id) }}" class="btn btn-sm btn-primary mt-3">{{ __('Add Question') }}</a>
                            @else 
                                <a class="btn btn-sm btn-primary mt-3" href="{{ route('quizzes.quizquestions.index', $quiz->id) }}">{{ __('Take Quiz') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
