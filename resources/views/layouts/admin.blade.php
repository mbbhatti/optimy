<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap-3.3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
</head>
<body>
    @include('layouts.partials.header')

    <div class="container-fluid main-container">
        @if(auth()->check())
            @include('layouts.partials.sidebar')

            <div class="col-md-10 content">
                <div class="panel panel-default">
                    @yield('content')
                </div>
            </div>
        @else
            <div class="col-md-offset-4 col-md-4 content">
                <div class="panel panel-default">
                    @yield('content')
                </div>
            </div>
        @endif

        <footer class="pull-left footer">
            <p class="col-md-12">
            <hr class="divider">
            &copy; {{ date('Y') }} ACME
            </p>
        </footer>
    </div>

    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-3.3.min.js') }}"></script>

    @yield('javascript')
</body>
</html>

