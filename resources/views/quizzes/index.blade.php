@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('temp.jquiz') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('quizzes.create') }}" class="btn btn-sm btn-primary">{{ __('temp.or') }}</a>
                            </div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('temp.enc') }}</th>
                                    <th scope="col">{{ __('temp.tit') }}</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
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
                                                <a href="{{ route('quizzes.show', $quiz->id) }}" class="btn btn-sm btn-primary">{{ __('temp.jnow') }}</a>
                                            </div>
                                        </td>
                                        @if ($quiz->user_id === auth()->user()->id || auth()->user()->role_id == App\Models\User::ROLE_ADMIN)
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" href="{{ route('quizzes.edit', $quiz->id) }}">{{ __('temp.edit') }}</a>
                                                        <form action="{{ route('quizzes.destroy', $quiz->id ) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item js-btn-delete"> {{ __('temp.delete') }}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
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
