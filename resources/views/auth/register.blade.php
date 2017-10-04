@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto">
                <register-form inline-template>
                    <form action="/register" method="POST">
                        <h1 class="mb-5">Register</h1>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="form-control-label">Name</label>
                            <input v-model="form.name" type="text" name="name"
                                   class="form-control" :class="{'is-invalid': form.errors.has('name')}"
                                   placeholder="John Smith">
                            <span class="invalid-feedback">
                                <strong>@{{ form.errors.get('name') }}</strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Email Address</label>
                            <input v-model="form.email" type="text" name="email"
                                   class="form-control" :class="{'is-invalid': form.errors.has('email')}"
                                   placeholder="example@app.com">
                            <span class="invalid-feedback">
                                <strong>@{{ form.errors.get('email') }}</strong>
                            </span>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input v-model="form.password" type="password" name="password"
                                           placeholder="Password"
                                           class="form-control" :class="{'is-invalid': form.errors.has('password')}">
                                    <span class="invalid-feedback">
                                        <strong>@{{ form.errors.get('password') }}</strong>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <input v-model="form.password_confirmation" type="password"
                                           name="password_confirmation" placeholder="Confirm Password"
                                           class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <password-meter></password-meter>
                            </div>
                        </div>


                        <div class="form-group my-5">
                            <button @click.prevent="submit" type="submit" class="btn btn-success btn-lg btn-block">
                                <i class="fa fa-spinner fa-spin" v-if="form.busy"></i>
                                Register
                            </button>
                        </div>

                    </form>
                </register-form>
            </div>
        </div>
    </div>
@stop