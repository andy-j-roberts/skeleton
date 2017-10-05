<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- GOOGLE ANALYTICS -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-107534085-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments)
        };
        gtag('js', new Date());

        gtag('config', 'UA-107534085-1', {
            'user_id': '{!! auth()->id() !!}'
        });
    </script>
    <!-- END -->
    <script>
        window.App = {
            user: {!! auth()->user() ? 'true' : 'null' !!}
        }
    </script>
    <title>{{ setting('app.name') }} {{ setting('app.version') }}</title>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({
            selector: '.editor', theme: 'modern',
            plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
            toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat'
        });</script>
    <!-- Styles -->
    <script src="https://use.fontawesome.com/c49e1f8139.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" v-cloak>

    @if(session()->has('masquerade.is_masquerading') )
        <div class="alert alert-info">
            You are currently logged in as a different user.
            <form action="/admin/masquerade" method="POST" class="d-inline-block">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn-link alert-link"><i
                            class="fa fa-user-circle-o" aria-hidden="true"></i> Return to original user
                </button>
            </form>
        </div>
    @endif

    <notification :messages="{{ session('notifications','[]') }}"></notification>

    <div class="">
        @yield('content')
    </div>
</div>

<!-- Scripts -->
<script src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
