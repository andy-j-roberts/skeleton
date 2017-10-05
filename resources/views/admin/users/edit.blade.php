@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-5 align-items-center">
            <div class="col-auto mr-auto">
                <img src="{{ $user->avatar }}" alt="avatar" class="rounded-circle">
            </div>
            <div class="col"><h1>{{ $user->name }}</h1></div>
            <div class="col text-right">
                <a href="/admin/users" class="btn">Cancel</a>
                <form action="/admin/masquerade" method="POST" class="d-inline-block">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <button type="submit" class="btn btn-outline-secondary">Log As User</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <user-form inline-template :user="{{ $user }}">
                    <form action="/admin/users/{{ $user->id }}" method="POST">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">User Details</h3>
                                <hr class="mb-5"/>
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group row">
                                    <div class="col-4">
                                        <label class="form-control-label">Name</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="name" v-model="form.name"
                                               class="form-control" :class="{'is-invalid':form.errors.has('name')}"
                                               placeholder="John Smith">
                                        <span class="invalid-feedback">
                                            <strong>@{{ form.errors.get('name') }}</strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4">
                                        <label class="form-control-label">Email Address</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="email" name="email" v-model="form.email"
                                               class="form-control" :class="{'is-invalid':form.errors.has('email')}"
                                               placeholder="example@app.com">
                                        <span class="invalid-feedback">
                                            <strong>@{{ form.errors.get('email') }}</strong>
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button @click.prevent="submit" type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </form>
                </user-form>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title d-flex">
                            <span class="mr-auto">Roles</span>
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#exampleModal">
                                Add
                            </button>
                        </h4>
                        <small class="text-muted">Roles the user is currently assigned to</small>
                    </div>
                    <div class="list-group list-group-flush">
                        @forelse($user->roles as $role)
                            <li class="list-group-item d-flex align-items-center">
                                <span class="mr-auto">{{ ucfirst($role->name) }}</span>
                                <a href="#" class="btn text-danger">Remove</a>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted">
                                No roles have been assigned
                            </li>
                        @endforelse
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h4 class="card-title">Permissions</h4>
                        <small class="text-muted">The user can perform the following action</small>
                    </div>
                    <div class="list-group list-group-flush">
                        <li class="list-group-item">Admin</li>
                        <li class="list-group-item">Editor</li>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($roles as $role)
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="{{ $role->name }}"
                                       name="roles[]">
                                {{ $role->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection