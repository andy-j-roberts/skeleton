<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('app.name') }} {{ setting('app.version') }}</title>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'.editor',theme: 'modern',
            plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
            toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat' });</script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ url('/') }}">{{ setting('app.name') }} {{ setting('app.version') }}</a>
        @guest
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            </ul>
            @else
                <div class="btn-group">
                    <button class="dropdown-toggle btn btn-default" data-toggle="dropdown" role="button"
                            aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="/admin/users">Users</a>
                        <a class="dropdown-item" href="/admin/roles">Roles</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/admin/pages">Pages</a>
                            <a class="dropdown-item" href="/admin/settings">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                            Logout
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </a>
                    </div>
                </div>
                @endguest
    </nav>

    @if(session()->has('masquerade.is_masquerading') )
        <div class="alert alert-info">
            You are currently logged in as a different user.
            <form action="/admin/masquerade" method="POST" class="d-inline-block">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn-link alert-link"><i
                            class="fa fa-user-circle-o" aria-hidden="true"></i> Return to original user</button>
            </form>
        </div>
    @endif

    @if(session()->has('notifications'))
        <notification :messages="{{ session('notifications') }}"></notification>
    @endif

    <div class="my-5">
        @yield('content')
    </div>

</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
