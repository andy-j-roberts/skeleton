@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="page">
            <div class="row">
                <div class="col"><h1>{{ $page->title }}</h1></div>
            </div>
            <div class="row">
                <div class="col page-body">
                    {!! $page->body !!}
                </div>
            </div>
        </div>
    </div>
@endsection
