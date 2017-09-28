@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col"><h1 class="mb-5">Manage Plans</h1></div>
        </div>
        <div class="row">
            <div class="col">
                <ul class="nav nav-pills justify-content-center mb-3">
                    <li class="nav-item nav-link active" data-toggle="tab">Monthly</li>
                    <li class="nav-item nav-link" data-toggle="tab">Annual</li>
                </ul>
                <table class="admin-table">
                    <thead>
                        <th>Stripe ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th class="text-right">Amount</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($plans as $plan)
                            <tr>
                                <td>{{ $plan->stripe_id }}</td>
                                <td>{{ $plan->name }}</td>
                                <td>{{ $plan->description }}</td>
                                <td class="text-right">£{{ $plan->getAmountAsCurrency() }}</td>
                                <td class="text-right">
                                    <div class="btn-group controls">
                                        <a href="#" class="btn btn-link">View</a>
                                        <a href="#" class="btn btn-link">Edit</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection