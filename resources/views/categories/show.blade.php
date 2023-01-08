@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Join a quiz now!') }}</h3>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Entry Code') }}</th>
                                    <th scope="col">{{ __('Title') }}</th>
                                    <th scope="col">
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quizzes as $quiz)
                                    <tr>
                                        <td>
                                            {{$quiz->id}}
                                        </td>
                                        <td>
                                            {{$quiz->title}}
                                        </td>
                                        <td>
                                            <div class="col text-right">
                                                <a href="{{ route('quizzes.show', $quiz->id) }}" class="btn btn-sm btn-primary">{{__('Join now!')}}</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
