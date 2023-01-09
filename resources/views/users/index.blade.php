@extends('layouts.app', ['title' => __('User Management')])  
@section('content')
@include('users.header', [
    'title' => __('Hello') . ' '. auth()->user()->username,
    'description' => __('This is your profile page. You can see the quizzes you have taken as well as the quizzes you have created'),
    'class' => 'col-lg-7'
])   

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Users') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">{{ __('Add user') }}</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('No') }}</th>
                                <th scope="col">{{ __('Username') }}</th>
                                <th scope="col">{{ __('Email') }}</th>
                                <th scope="col">{{ __('First Name') }}</th>
                                <th scope="col">{{ __('Last Name') }}</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    {{$user->username}}
                                </td>
                                <td>
                                    {{$user->email}}
                                </td>
                                <td>
                                    {{$user->first_name}}
                                </td>
                                <td>
                                    {{$user->last_name}}
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="{{route('users.edit', $user->id)}}">{{ __('Edit') }}</a>
                                            <a class="dropdown-item" href="{{route('users.destroy', $user->id)}}">{{ __('Delete') }}</a>
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
    </div>
</div>
@endsection
