@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')
    
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('temp.cas') }}</h3>
                        </div>
                        @if (auth()->user()->role_id == App\Models\User::ROLE_ADMIN)
                            <div class="col-4 text-right">
                                <a href={{ route('categories.create') }} class="btn btn-sm btn-primary">{{ __('temp.newca') }}</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('temp.num') }}</th>
                                <th scope="col">{{ __('temp.ca') }}</th>
                                <th scope="col"></th>
                                @if (auth()->user()->role_id == App\Models\User::ROLE_ADMIN)
                                    <th scope="col"></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    {{$category->name}}
                                </td>
                                <td>
                                    <div class="col text-right">
                                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-primary">{{ __('temp.ent') }}</a>
                                    </div>
                                </td>
                                @if (auth()->user()->role_id == App\Models\User::ROLE_ADMIN)
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{route('categories.edit', $category->id)}}">{{ __('temp.edit') }}</a>
                                                <form action="{{ route('categories.destroy', $category->id ) }}" method="POST">
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
