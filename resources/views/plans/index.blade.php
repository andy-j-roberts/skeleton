@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col text-center my-5">
                <h1>Choose your plan</h1>
                <h3 class="text-muted">Try free for 30 days. No credit card required.</h3>
            </div>
        </div>
        <div class="row">
            @foreach($plans as $plan)
            <div class="col">
                <div class="card card-border">
                    <div class="card-body">
                        <h2>{{ $plan->name }}</h2>
                        <p class="text-muted">{{ $plan->description }}</p>
                        <h1>{{ $plan->amount }}</h1>
                        <button class="btn btn-primary mt-5">Select Plan</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection