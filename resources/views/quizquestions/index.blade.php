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
                        @if ($quiz->user_id === auth()->user()->id || auth()->user()->role_id == App\Models\User::ROLE_ADMIN)
                            <table class="table table-borderless">
                                @forelse ($quiz->quizQuestions as $question)
                                    <tr>
                                        <td class="p-0 m-0">
                                            <p class="flow-text">
                                                {{ __('temp.que') }} {{ $loop->iteration }} - {{ $question->question }}
                                            </p>
                                        </td>
                                        <td class="p-0 m-0">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{ route('quizquestions.edit', $question->id) }}">{{ __('temp.edit') }}</a>
                                                    <form action="{{ route('quizquestions.destroy', $question->id ) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item js-btn-delete"> {{ __('temp.delete') }}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @if($question->type == App\Models\QuizQuestion::TYPE_TEXT)
                                        <tr>
                                            <td class="p-0 m-0">
                                                <div class="input-field col s12">
                                                    <input type="text" value="{{ $question->quizAnswers->first()->answer }}" disabled/>
                                                </div>
                                            </td>
                                            <td class="p-0 m-0">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" href="{{ route('quizanswers.edit', $question->quizAnswers->first()->id) }}">{{ __('temp.edit') }}</a>
                                                        <form action="{{ route('quizanswers.destroy', $question->quizAnswers->first()->id ) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item js-btn-delete"> {{ __('temp.delete') }}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @elseif($question->type == App\Models\QuizQuestion::TYPE_RADIO)
                                        @foreach($question->quizAnswers as $value)
                                        <tr>
                                            <td class="p-0 m-0">
                                                <p class="p-0 m-0">
                                                    @if ($value->correct)
                                                        <input type="radio" disabled checked/>
                                                    @else 
                                                        <input type="radio" disabled/>
                                                    @endif
                                                <label>{{ $value->answer }}</label>
                                                </p>
                                            </td>
                                            <td class="p-0 m-0">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" href="{{ route('quizanswers.edit', $value->id) }}">{{ __('temp.edit') }}</a>
                                                        <form action="{{ route('quizanswers.destroy', $value->id ) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item js-btn-delete"> {{ __('temp.delete') }}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @elseif($question->type == App\Models\QuizQuestion::TYPE_CHECKBOX)
                                        @foreach($question->quizAnswers as $value)
                                            <tr>
                                                <td class="p-0 m-0">
                                                    <p class="p-0 m-0">
                                                        @if($value->correct)
                                                            <input type="checkbox" disabled checked/>
                                                        @else
                                                            <input type="checkbox" disabled/>
                                                        @endif
                                                    <label>{{ $value->answer }}</label>
                                                    </p>
                                                </td>
                                                <td class="p-0 m-0">
                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                            <a class="dropdown-item" href="{{ route('quizanswers.edit', $value->id) }}">{{ __('temp.edit') }}</a>
                                                            <form action="{{ route('quizanswers.destroy', $value->id ) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item js-btn-delete"> {{ __('temp.delete') }}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    <div class="divider m-1"></div>
                                @empty
                                    <span class='flow-text center-align'>{{ __('temp.nothing') }}</span>
                                @endforelse
                            </table>
                            <div class="text-center">
                                <a href="{{ route('quizzes.quizquestions.create', $quiz->id) }}" class="btn btn-sm btn-primary mt-3">{{ __('temp.newque') }}</a>
                            </div>
                        @else
                            <form method="POST" action="{{ route('quizzes.takes.store', $quiz->id) }}">
                                @csrf
                                @forelse ($quiz->quizQuestions as $question)
                                    <p class="flow-text">{{ __('temp.que') }} {{ $loop->iteration }} - {{ $question->question }}</p>
                                        @if($question->type == App\Models\QuizQuestion::TYPE_TEXT)
                                            <div class="input-field col s12">
                                                <label for="answer">{{ __('temp.ans') }}</label>
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
                                    <span class='flow-text center-align'>{{ __('temp.nothing') }}</span>
                                @endforelse
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-sm btn-primary">{{ __('temp.sub') }}</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
