@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col" style="margin-top: 4rem;">
                <div class="text-center">
                    <h1>Verified Account required<br/>
                        <small class="text-muted">
                            You will need to verify your account before you can use your account.
                        </small>
                    </h1>

                    <small class="text-muted d-block mt-5 mb-3">Not had a verification email?</small>
                    <a href="/" class="btn btn-link">Return to homepage</a>
                    <a href="/verify-account/send" class="btn btn-success">
                        Resend Account Verification email
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection