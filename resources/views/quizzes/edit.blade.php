@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('temp.edqz') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('quizzes.update', $quiz->id) }}">
                            @csrf
                            @method('PUT')
                            {{ __('temp.qztit') }}
                            <div class="form-group">
                                <div class="input-group input-group-alternative mt-3 mb-3">
                                    <input class="form-control" value="{{ $quiz->title }}" name="title" required>
                                </div>
                            </div>
                            {{ __('temp.qzdes') }}
                            <div class="form-group">
                                <div class="input-group input-group-alternative mt-3 mb-3">
                                    <textarea class="form-control" name="description" required>{{ $quiz->description }}</textarea>
                                </div>
                            </div>
                            {{ __('temp.ca') }}
                            <select class="form-control mb-3 mt-3" name="category_id" id="category_id" required>
                                <option value="" disabled>{{ __('temp.chooseca') }}</option>
                                @foreach (App\Models\Category::all() as $category)
                                    @if ($category->id == $quiz->category_id)
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else 
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
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
