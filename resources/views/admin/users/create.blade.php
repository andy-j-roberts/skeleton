@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 ml-auto mr-auto">
                <form action="/admin/users" method="POST" class="mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">Create User</h1>
                        <hr/>
                        <p>Fill in the information below to create new users. We'll email the user instructions for logging in.</p>

                            {{ csrf_field() }}
                            <div class="form-group row">
                                <div class="col-4">
                                    <label class="form-control-label">Name</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" name="name" class="form-control" placeholder="John Smith">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">
                                    <label class="form-control-label">Email Address</label>
                                </div>
                                <div class="col-6">
                                    <input type="email" name="email" class="form-control" placeholder="example@app.com">
                                </div>
                            </div>

                    </div>
                    <div class="card-footer text-right">
                        <a href="/admin/users" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>

            </div>
            </form>
        </div>
    </div>
    @endsection