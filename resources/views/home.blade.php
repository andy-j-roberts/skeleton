@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        <div class="col">
            <h1>Dashboard<br/><small class="text-muted">Welcome back {{ auth()->user()->name }}</small></h1>
        </div>
    </div>

</div>
@endsection
