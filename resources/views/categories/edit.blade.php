@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Edit Category') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('categories.update', $category->id) }}">
                            @csrf
                            @method('PUT')
                            {{ __('Category Name') }}
                            <div class="form-group">
                                <div class="input-group input-group-alternative mt-3 mb-3">
                                    <input class="form-control" value={{ $category->name }} name="name" required>
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
