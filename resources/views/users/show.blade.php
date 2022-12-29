@extends('layouts.app', ['title' => __('User Profile')])
@section('content')
@include('users.header', [
    'title' => __('Hello') . ' '. auth()->user()->username,
    'description' => __('This is your profile page. You can see the quizzes you have taken as well as the quizzes you have created'),
    'class' => 'col-lg-7'
])   

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-6 order-xl-2 mb-5 mb-xl-0">
            <div class="card bg-secondary shadow">
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    <div class="row align-items-center">
                        <h3 class="mb-0">{{ __('Quiz Created') }}</h3>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('No') }}</th>
                                <th scope="col">{{ __('Title') }}</th>
                                <th scope="col">{{ __('Description') }}</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quizzes as $quiz)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $quiz->title }}
                                </td>
                                <td>
                                    {{ $quiz->description }}
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="{{ route('quizzes.edit', $quiz->id) }}">Edit</a>
                                            <a class="dropdown-item" href="{{ route('quizzes.destroy', $quiz->id) }}">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-6 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">{{ __('Quiz Taken') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
