@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col">
                    @if(auth()->user()->canAccess($video))
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0"
                                    allowfullscreen></iframe>
                        </div>
                    @else
                        <div class="text-center jumbotron">
                            <h1>You cannot access this resource</h1>
                            <p class="lead">Sign up to get full access or log in to your account and sit back.</p>
                            <div class="row my-5">
                                <div class="col-4 mx-auto">
                                    <a href="/plans" class="btn btn-primary btn-block btn-lg">Sign Up</a>
                                </div>
                                @guest
                                    <div class="col-4 mx-auto">
                                        <a href="/login" class="btn btn-outline-secondary btn-block btn-lg">Log In to
                                            your Account</a>
                                    </div>
                                @endguest
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-6 mx-auto">
                <h1>{{ $video->name }}</h1>
                <p>{!! $video->description !!}</p>
            </div>
            @if(auth()->user()->cannotAccess($video))
                <div class="col-3 mr-auto">
                    <div class="card">
                        <div class="card-body">
                            <h4>{{ $video->product->name }}</h4>
                            <p>{!! $video->product->description !!}</p>
                            <h1>{{ $video->product->formatted_amount }}</h1>
                            <button class="btn btn-success btn-lg btn-block mt-5">Buy Video</button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop