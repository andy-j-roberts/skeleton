@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-5">
            <div class="col">
                <h1>{{ $project_space->name }}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <h2 class="card-title">Zones</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                @foreach($project_space->zones->chunk(4) as $row)
                <div class="card-deck mb-4">
                    @foreach($row as $zone)
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">{{ $zone->zoneable->name }}</h3>
                                <small class="text-muted">{{ $zone->zoneable->description }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>

    </div>
@stop