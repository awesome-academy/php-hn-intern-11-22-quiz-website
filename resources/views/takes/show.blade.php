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
                        <h3 class="mb-0">
                            {{ __('Score: ') . $take->score . "/" . $take->quiz->quizQuestions->count() }}
                        </h3>
                            @forelse ($quiz->quizQuestions as $question)
                                <p class="flow-text">{{ __('Question') }} {{ $loop->iteration }} - {{ $question->question }}</p>
                                @if($question->type == App\Models\QuizQuestion::TYPE_TEXT)
                                    @foreach($takeAnswers as $takeAnswer)
                                        @if($takeAnswer->quiz_question_id == $question->id)
                                            <div class="input-field col s12">
                                                <input type="text" value="{{ $takeAnswer->answer }}" disabled/>
                                            </div>
                                        @endif
                                    @endforeach
                                @elseif($question->type == App\Models\QuizQuestion::TYPE_RADIO)
                                    @foreach($question->quizAnswers as $value)
                                        <p class="p-0 m-0">
                                        @foreach($takeAnswers as $takeAnswer)
                                            @if($takeAnswer->answer == $value->id)
                                                <input type="radio" disabled checked/>
                                                @break
                                            @endif
                                            @if($takeAnswer == $takeAnswers->last())
                                                <input type="radio" disabled/>
                                            @endif
                                        @endforeach
                                        <label>{{ $value->answer }}</label>
                                        </p>
                                    @endforeach
                                @elseif($question->type == App\Models\QuizQuestion::TYPE_CHECKBOX)
                                    @foreach($question->quizAnswers as $value)
                                        <p class="p-0 m-0">
                                        @foreach($takeAnswers as $takeAnswer)
                                            @if($takeAnswer->answer == $value->id)
                                                <input type="checkbox" disabled checked/>
                                                @break
                                            @endif
                                            @if($takeAnswer == $takeAnswers->last())
                                                <input type="checkbox" disabled/>
                                            @endif
                                        @endforeach
                                        <label>{{ $value->answer }}</label>
                                        </p>
                                    @endforeach
                                @endif
                                <div class="divider m-1"></div>
                            @empty
                                <span class='flow-text center-align'>{{ __('Nothing to show') }}</span>
                            @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
