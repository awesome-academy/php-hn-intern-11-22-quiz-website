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
                        <form method="POST" action="{{ route('quizzes.takes.store', $quiz->id) }}">
                            @csrf
                            @forelse ($quiz->quizQuestions as $question)
                                <p class="flow-text">{{ __('Question') }} {{ $loop->iteration }} - {{ $question->question }}</p>
                                    @if($question->type == App\Models\QuizQuestion::TYPE_TEXT)
                                        <div class="input-field col s12">
                                            <label for="answer">{{ __('Answer') }}</label>
                                            <input id="answer" type="text" name="answer{{ $question->id }}[]">
                                        </div>
                                    @elseif($question->type == App\Models\QuizQuestion::TYPE_RADIO)
                                        @foreach($question->quizAnswers as $value)
                                            <p class="p-0 m-0">
                                            <input name="answer{{ $question->id }}[]" value="{{ $value->id }}" type="radio" />
                                            <label>{{ $value->answer }}</label>
                                            </p>
                                        @endforeach
                                    @elseif($question->type == App\Models\QuizQuestion::TYPE_CHECKBOX)
                                        @foreach($question->quizAnswers as $value)
                                            <p class="p-0 m-0">
                                                <input name="answer{{ $question->id }}[]" value="{{ $value->id }}" type="checkbox" />
                                                <label>{{ $value->answer }}</label>
                                            </p>
                                        @endforeach
                                    @endif 
                                <div class="divider m-1"></div>
                            @empty
                                <span class='flow-text center-align'>{{ __('Nothing to show') }}</span>
                            @endforelse
                            <div class="col text-center">
                                <button type="submit" class="btn btn-sm btn-primary">{{ __('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
