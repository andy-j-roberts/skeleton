@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="mb-5">Manage Settings</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
                    @foreach($settings_groups as $group => $settings)
                        <li class="nav-item">
                            <a class="nav-link @if($loop->first) active @endif" data-toggle="tab" href="#{{ $group }}-tab" role="tab"
                               aria-controls="home" aria-expanded="true">{{ ucfirst($group) }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col">
                <div class="tab-content" id="myTabContent">
                    @foreach($settings_groups as $group => $settings)
                        <div class="tab-pane fade @if($loop->first) show active @endif" id="{{ $group }}-tab" role="tabpanel" aria-labelledby="home-tab">
                            <div class="card mb-5 card-border">
                                <div class="card-body">
                                    <h3 class="card-title mb-5">{{ ucfirst($group) }} settings</h3>
                                    <form method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $group }}" name="namespace">
                                        @foreach($settings as $setting)
                                            <div class="form-group row">
                                                <div class="col-4">
                                                    <label class="form-control-label">{{ $setting->display_name }}</label>
                                                    <p class="form-text text-muted">{{ $setting->description }}</p>
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="{{ $setting->namespace }}[{{ $setting->key }}]" value="{{ $setting->value }}" class="form-control">
                                                    <code>setting({{ $setting->namespace }}.{{ $setting->key }})</code>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-8 ml-md-auto">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection