@extends('layouts.app', ['title' => __('temp.prof')])
@section('content')
@include('users.header', [
    'title' => __('temp.hello') . ' '. auth()->user()->username,
    'description' => __('temp.ctqz'),
    'class' => 'col-lg-7'
])   

<div class="container-fluid mt--7">
    <div class="row">
        @if (auth()->user()->role_id == App\Models\User::ROLE_ADMIN)
            <div class="col-xl-10 order-xl-1 mb-5">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('temp.numquizcre') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="barChart" chart-data="{{ $chartData }}" class="chart-canvas text-center"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-xl-10 order-xl-2 mb-5 mb-xl-0">
            <div class="card bg-secondary shadow">
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    <div class="row align-items-center">
                        <h3 class="mb-0">{{ __('temp.cqz') }}</h3>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('temp.num') }}</th>
                                <th scope="col">{{ __('temp.tit') }}</th>
                                <th scope="col">{{ __('temp.des') }}</th>
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
        <div class="col-xl-10 order-xl-1 mb-5">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">{{ __('temp.taken') }}</h3>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('temp.num') }}</th>
                                <th scope="col">{{ __('temp.score') }}</th>
                                <th scope="col">{{ __('temp.tit') }}</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($takes as $take)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $take->score }}/{{ $take->quiz->quizQuestions->count() }}
                                </td>
                                <td>
                                    {{ $take->quiz->title }}
                                </td>
                                <td>
                                    <div class="col text-right">
                                        <a href="{{ route('takes.show', $take->id) }}" class="btn btn-sm btn-primary">{{ __('temp.review') }}</a>
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
