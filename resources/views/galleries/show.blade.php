@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="mb-5">{{ $gallery->name }}</h1>
            </div>
        </div>
        @foreach($gallery->media->chunk(4) as $row)
            <div class="row mb-5">
                @foreach($row as $image)
                    <div class="col-3">
                        <a href="{{ $image->getPath() }}" target="_blank">
                            <img src="{{ $image->getPresetPath('thumb') }}" class="rounded float-left" alt="sm" width="100%">
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@stop