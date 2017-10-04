@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto">
                <form>

                    <h1 class="mb-5">Register</h1>
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label class="form-control-label">Name</label>
                        <input type="text" name="name"
                               class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                               placeholder="John Smith">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">Email Address</label>
                        <input type="text" name="name"
                               class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                               placeholder="example@app.com">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">Password</label>
                        <input type="password" name="password"
                               class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                        >
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <password-meter></password-meter>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg btn-block">Register</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@stop