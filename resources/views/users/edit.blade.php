@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Edit User') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method("PUT")
                            {{ __('Username') }}
                            <div class="form-group">
                                <div class="input-group input-group-alternative mt-3 mb-3">
                                    <input class="form-control" value="{{ $user->username }}" name="username" required>
                                </div>
                            </div>
                            {{ __('First Name') }}
                            <div class="form-group">
                                <div class="input-group input-group-alternative mt-3 mb-3">
                                    <input class="form-control" value="{{ $user->first_name }}" name="first_name" required>
                                </div>
                            </div>
                            {{ __('Last Name') }}
                            <div class="form-group">
                                <div class="input-group input-group-alternative mt-3 mb-3">
                                    <input class="form-control" value="{{ $user->last_name }}" name="last_name" required>
                                </div>
                            </div>
                            {{ __('Email') }}
                            <div class="form-group">
                                <div class="input-group input-group-alternative mt-3 mb-3">
                                    <input class="form-control" value="{{ $user->email }}" name="email" required>
                                </div>
                            </div>
                            {{ __('User Role') }}
                            <select class="form-control mb-3 mt-3" name="role_id" id="role_id" required>
                                <option value="" disabled>{{ __('Choose user role') }}</option>
                                @foreach (App\Models\Role::all() as $role)
                                    @if ($role->id == $user->role_id)
                                        <option value="{{ $role->id }}" selected>{{ $role->role }}</option>
                                    @else 
                                        <option value="{{ $role->id }}">{{ $role->role }}</option>
                                    @endif
                                @endforeach
                            </select>
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
