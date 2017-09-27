@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-border">
            <div class="card-body">
                <h1 class="card-title mb-5">Edit Page</h1>
                <form action="/admin/pages/{{ $page->id }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group row">
                        <div class="col">
                            <h4>Page Title</h4>

                        </div>
                        <div class="col-10 ml-auto">
                            <input class="form-control form-control-lg" value="{{ $page->title }}" name="title">
                            <span class="form-text text-muted">Permalink is currently {{ url($page->permalink) }}</span>
                        </div>

                    </div>
                    <div class="form-group">
                        <textarea class="form-control editor" rows="30" name="body">{{ $page->body }}</textarea>
                    </div>
                    <div class="text-right">
                        <a href="/admin/pages" class="btn btn-link">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection