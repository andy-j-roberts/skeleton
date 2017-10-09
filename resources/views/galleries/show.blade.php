@extends('layouts.app')

@section('content')

    @foreach($gallery->media as $image)
        <img src="{{ $image->getPresetPath('thumb') }}" class="rounded float-left" alt="sm">
    @endforeach

@stop