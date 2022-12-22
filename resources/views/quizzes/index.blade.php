@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Entry Code</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">
                                        
                                    </th>
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
                                                <a href="{{ route('quizzes.show', $quiz->id) }}" class="btn btn-sm btn-primary">Join now!</a>
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
