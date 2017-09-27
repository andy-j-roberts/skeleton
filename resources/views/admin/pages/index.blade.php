@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Manage Pages</h1>
            </div>
        </div>
        <div class="d-flex mt-5">
            <a href="/admin/pages/create" class="btn btn-lg btn-primary">Create Page</a>
            <form method="GET" role="search" class="w-100 ml-3">
                <input type="search" class="form-control form-control-lg" name="q" placeholder="Search for pages" value="{{ old('q') }}">
            </form>
        </div>
        <div class="row mt-5">
            <div class="col">
                <div class="list-group">
                    @foreach($pages as $page)
                        <div class="list-group-item d-flex">
                            <div class="mr-auto">
                                <h4>{{ $page->title }}</h4>
                                <h5 class="text-muted"><a href="{{ $page->path() }}" target="_blank">{{ $page->path() }}</a></h5>
                                {{--<small class="text-muted">Member since {{ $user->created_at->toFormattedDateString() }}</small>--}}
                            </div>
                            <div class="ml-auto mr-0 row align-items-center">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" role="button" data-toggle="dropdown">Manage</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="/admin/pages/{{ $page->id }}/edit">Edit</a>
                                        <form action="/admin/pages/{{ $page->id }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="dropdown-item text-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $pages->appends(['q'])->render() }}
            </div>
        </div>
    </div>
@endsection