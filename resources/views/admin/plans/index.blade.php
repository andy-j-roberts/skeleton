@extends('layouts.app')

@section('page-title')
    <div class="row">
        <div class="col mr-auto">
            <h1>Manage Plans</h1>
        </div>
        <div class="text-right">
            <a href="/admin/stripe/sync-plans" class="btn btn-link text-secondary">Sync Plans</a>
            <a href="/admin/plans/create" class="btn btn-success">Create Plan</a>
        </div>
    </div>
@stop
@section('content')
    <div class="container">


        <div class="row">
            <div class="col">
                <ul class="nav nav-pills justify-content-center mb-3">
                    <li class="nav-item nav-link active" data-toggle="tab" href="#monthly">Monthly</li>
                    <li class="nav-item nav-link" data-toggle="tab" href="#annual">Annual</li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="monthly" role="tabpanel">
                        <table class="admin-table">
                            <thead>
                            <th>Stripe ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th class="text-right">Amount</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @forelse($monthly as $plan)
                                <tr>
                                    <td>{{ $plan->stripe_id }}</td>
                                    <td>{{ $plan->name }}</td>
                                    <td>{{ $plan->getMetadata('description') }}</td>
                                    <td class="text-right">{{ $plan->getAmountAsCurrency() }}</td>
                                    <td class="text-right">
                                        <div class="btn-group controls">
                                            <a href="/admin/plans/{{ $plan->id }}" class="btn btn-link">View</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No plans have been created</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="annual" role="tabpanel">
                        <table class="admin-table">
                            <thead>
                            <th>Stripe ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th class="text-right">Amount</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @forelse($annual as $plan)
                                <tr>
                                    <td>{{ $plan->stripe_id }}</td>
                                    <td>{{ $plan->name }}</td>
                                    <td>{{ $plan->getMetadata('description') }}</td>
                                    <td class="text-right">{{ $plan->getAmountAsCurrency() }}</td>
                                    <td class="text-right">
                                        <div class="btn-group controls">
                                            <a href="#" class="btn btn-link">View</a>
                                            <a href="#" class="btn btn-link">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No plans have been created</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection