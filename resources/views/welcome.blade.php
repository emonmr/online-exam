<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <title>{{ config('app.name', 'Online Test') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<main class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="app">
                <div class="d-flex align-items-center justify-content-center flex-column bg-white p-5 m-5"
                     style="height: 90vh">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</main><!-- /.container -->

</body>
@yield('javascript')

</html>
