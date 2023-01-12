@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('temp.newqz') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('quizzes.store') }}">
                            @csrf
                            {{ __('temp.qztit') }}
                            <div class="form-group">
                                <div class="input-group input-group-alternative mt-3 mb-3">
                                    <input class="form-control" placeholder="{{ __('temp.tit') }}" name="title" required>
                                </div>
                            </div>
                            {{ __('temp.qzdes') }}
                            <div class="form-group">
                                <div class="input-group input-group-alternative mt-3 mb-3">
                                    <textarea class="form-control" placeholder="{{ __('temp.des') }}" name="description" required></textarea>
                                </div>
                            </div>
                            <select class="form-control mb-3 mt-3" name="category_id" id="category_id" required>
                                <option value="" disabled selected>{{ __('temp.chooseca') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                              </select>
                            <div class="col text-center">
                                <button type="submit" class="btn btn-sm btn-primary">{{ __('temp.sub') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
