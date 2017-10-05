@extends('layouts.guest')

@section('content')
    <div class="container-fluid loginContainer">
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-6 mx-auto">
                        <h4 class="pt-5"><i class="fa fa-cubes"
                               aria-hidden="true"></i> {{ setting('app.name') }} {{ setting('app.version') }}</h4>
                    </div>

                </div>
                <div class="full-bg">
                    <div class="align-self-center col-12">
                        <div class="col-6 mx-auto">
                            <h1>Login</h1>
                            <form method="POST" action="{{ route('login') }}" class="align-self-center">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input id="email" type="email" class="form-control form-control-lg" name="email"
                                           value="{{ old('email') }}" required autofocus placeholder="Email Address">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input id="password" type="password" class="form-control form-control-lg" name="password" required
                                           placeholder="Password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            Remember Me
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group text-right">
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Forgot Your Password?
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Login
                                    </button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-6 full-bg"
                 style="background-image: url(https://images.unsplash.com/photo-1469386220931-a05a3a71cbb5?dpr=1&auto=compress,format&fit=crop&w=1951&h=&q=80&cs=tinysrgb&crop=);">
                <div class="align-self-center col-6 mx-auto">

                </div>

            </div>
        </div>
    </div>
@stop