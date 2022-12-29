@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Edit Quiz') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('quizzes.update', $quiz->id) }}">
                            @csrf
                            {{ __('Quiz Title') }}
                            <div class="form-group">
                                <div class="input-group input-group-alternative mt-3 mb-3">
                                    <input class="form-control" value="{{ $quiz->title }}" name="title" required>
                                </div>
                            </div>
                            {{ __('Quiz Description') }}
                            <div class="form-group">
                                <div class="input-group input-group-alternative mt-3 mb-3">
                                    <textarea class="form-control" name="description" required>{{ $quiz->description }}</textarea>
                                </div>
                            </div>
                            <div class="col text-center">
                                <a class="btn btn-sm btn-primary">{{ __('Add Question') }}</a>
                                <button type="submit" class="btn btn-sm btn-primary">{{ __('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
