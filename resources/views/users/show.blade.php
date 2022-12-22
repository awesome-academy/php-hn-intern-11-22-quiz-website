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
                <div class="card-body pt-0 pt-md-4">
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
