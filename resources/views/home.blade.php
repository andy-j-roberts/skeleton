@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        <div class="col-8">
            <h1 class="mb-5">Dashboard<br/><small class="text-muted">Welcome back {{ auth()->user()->name }}</small></h1>
            @admin
                <announcement></announcement>
            @endadmin
        </div>
        <div class="col">
            <card-details></card-details>
            <subscriptions></subscriptions>
            <announcements></announcements>
        </div>
    </div>

</div>
@endsection
