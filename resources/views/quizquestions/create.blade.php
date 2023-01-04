@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Add Question') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('quizzes.quizquestions.store', $quiz) }}" id="boolean">
                            @csrf
                            <div class="row mb-3 mt-3">
                                <div class="input-field col s12">
                                  <select class="form-control question_type" name="question_type" id="question_type">
                                    <option value="" disabled selected>{{ __('Choose question type') }}</option>
                                    <option value="text">{{ __('Fill-in-the-blank') }}</option>
                                    <option value="radio">{{ __('Multiple Choice') }}</option>
                                    <option value="checkbox">{{ __('Multiple Answer') }}</option>
                                  </select>
                                </div>                
                            </div>
                            <div class="row mb-3 mt-3">
                              <div class="input-field col s12">
                                <label for="title">{{ __('Question') }}</label>
                                <input class="form-control" name="question" id="question" type="text">
                              </div>  
                            </div>
                            <div class="form-g">
                            </div>
                            <div class="row mb-3 mt-3">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-sm btn-primary">{{ __('Submit') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
