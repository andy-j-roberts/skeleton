@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <form action="/admin/plans" method="POST">
                <div class="card">
                    <div class="card-body">
                        <h1 class="mb-5">Create Plan</h1>
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <div class="col">
                                    <label class="form-control-label">ID</label>
                                    <small class="form-text text-muted">A unique identifier for this plan, which is used by Stripe</small>
                                </div>
                                <div class="col-8 ml-auto">
                                    <input type="text" name="stripe_id" class="form-control col-8" placeholder="basic">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label class="form-control-label">Name</label>
                                    <small class="form-text text-muted">A user-friendly name for this plan, which is displayed to the user</small>
                                </div>
                                <div class="col-8 ml-auto">
                                    <input type="text" name="name" class="form-control col-8" placeholder="Basic Plan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label class="form-control-label">Currency</label>
                                </div>
                                <div class="col-8 ml-auto">
                                    <select class="form-control col-8" name="currency">
                                        <option value="gbp">GBP - Great British Pound</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label class="form-control-label">Amount</label>
                                    <small class="form-text text-muted">The cost of this plan</small>
                                </div>
                                <div class="col-8 ml-auto">
                                    <input type="text" name="amount" class="form-control col-8" placeholder="9.99">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label class="form-control-label">Interval</label>
                                </div>
                                <div class="col-8 ml-auto">
                                    <select class="form-control col-8" name="interval">
                                        <option value="month">Monthly</option>
                                        <option value="year">Annual</option>
                                    </select>
                                </div>
                            </div>


                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col text-right">
                                <a href="/admin/plans" class="btn btn-link">Cancel</a>
                                <button type="submit" class="btn btn-primary btn-lg">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endsection