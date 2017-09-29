@extends('layouts.app')
@section('content')
    <subscription-plans inline-template :plans="{{ $plans->collection }}">
        <div class="container">
            <div class="row">
                <div class="col text-center my-5">
                    <h1>Choose your plan</h1>
                    <h3 class="text-muted">Try free for 30 days. No credit card required.</h3>
                </div>
            </div>
            <ul class="nav nav-pills justify-content-center mb-3">
                <li class="nav-item nav-link active" data-toggle="tab" href="#monthly" @click.prevent="switchInterval('month')">Monthly</li>
                <li class="nav-item nav-link" data-toggle="tab" href="#annual" @click.prevent="switchInterval('year')">Annual</li>
            </ul>
            <div class="row" v-if="ui.plan_selected == false">
                <div class="col-4" v-for="plan in filtered_plans">
                    <div class="card card-border">
                        <div class="card-body">
                            <h2>@{{ plan.name }}</h2>
                            <p class="text-muted">@{{ plan.description }}</p>
                            <h1>@{{ plan.amount }} <small style="font-size: 16px;">/ per @{{ plan.interval }}</small></h1>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary btn-block" @click.prevent="selectPlan(plan)">Select Plan</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" v-show="ui.plan_selected">
                <div class="col">
                    <subscribe></subscribe>
                </div>
            </div>
        </div>
    </subscription-plans>
@endsection