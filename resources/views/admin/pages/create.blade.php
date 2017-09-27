@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-border">
            <div class="card-body">
                <h1 class="card-title mb-5">Create Page</h1>
                <form action="/admin/pages" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <div class="col">
                            <h4>Page Title</h4>
                        </div>
                        <div class="col-10 ml-auto">
                            <input class="form-control form-control-lg" value="{{ old('title', $page->title) }}" name="title">
                        </div>

                    </div>
                    <div class="form-group">
                        <textarea class="form-control editor" rows="30" name="body">{{ old('body', $page->body) }}</textarea>
                    </div>
                    <div class="text-right">
                        <a href="/admin/pages" class="btn btn-link">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection