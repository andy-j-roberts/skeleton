@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Manage Roles</h1>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col">
                <div class="list-group">
                    @foreach($roles as $role)
                        <div class="list-group-item d-flex">
                            <div class="mr-auto">
                                <h4>{{ $role->name }}</h4>
                                <small>User Count: {{ $role->users_count }}</small>
                            </div>
                            <div class="ml-auto mr-0">
                                <a href="/admin/roles/{{ $role->id }}" class="btn btn-outline-primary">Manage Users</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endsection