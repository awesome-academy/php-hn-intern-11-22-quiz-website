@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('temp.edque') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('quizquestions.update', $question->id) }}" id="boolean">
                            @csrf
                            @method("PUT")
                            <div class="row mb-3 mt-3">
                              <div class="input-field col s12">
                                <label for="title">{{ __('temp.que') }}</label>
                                <input class="form-control" name="question" id="question" type="text" value="{{ $question->question }}">
                              </div>  
                            </div>
                            <div class="row mb-3 mt-3">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-sm btn-primary">{{ __('temp.sub') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
