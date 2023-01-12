@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Create User') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf
                            {{ __('Username') }}
                            <div class="form-group">
                                <div class="input-group input-group-alternative mt-3 mb-3">
                                    <input class="form-control" placeholder="{{ __('Username') }}" name="username" required>
                                </div>
                            </div>
                            {{ __('First Name') }}
                            <div class="form-group">
                                <div class="input-group input-group-alternative mt-3 mb-3">
                                    <input class="form-control" placeholder="{{ __('First Name') }}" name="first_name" required>
                                </div>
                            </div>
                            {{ __('Last Name') }}
                            <div class="form-group">
                                <div class="input-group input-group-alternative mt-3 mb-3">
                                    <input class="form-control" placeholder="{{ __('Last Name') }}" name="last_name" required>
                                </div>
                            </div>
                            {{ __('Email') }}
                            <div class="form-group">
                                <div class="input-group input-group-alternative mt-3 mb-3">
                                    <input class="form-control" placeholder="{{ __('Email') }}" name="email" required>
                                </div>
                            </div>
                            {{ __('User Role') }}
                            <select class="form-control mb-3 mt-3" name="role_id" id="role_id" required>
                                <option value="" disabled selected>{{ __('Choose user role') }}</option>
                                @foreach (App\Models\Role::all() as $role)
                                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                                @endforeach
                            </select>
                            {{ __('Password') }}
                            <div class="form-group">
                                <div class="input-group input-group-alternative mt-3 mb-3">
                                    <input class="form-control" placeholder="{{ __('Password') }}" name="password" required>
                                </div>
                            </div>
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
