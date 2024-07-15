<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACME Donations</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div id="app">
    <header class="text-black py-3">
        <div class="container d-flex justify-content-between align-items-center flex-wrap">
            <div class="d-flex align-items-center">
                <a href="/" class="navbar-brand text-black d-flex align-items-center">
                    <img src="{{ asset('images/acme-logo.png') }}" alt="ACME" class="logo mr-2">
                </a>
            </div>
            <nav class="d-flex align-items-center flex-wrap">
                <a href="{{ route('home') }}" class="nav-link text-black">Home</a>
                <a href="{{ route('about') }}" class="nav-link text-black">About</a>
                <a href="{{ route('donations') }}" class="nav-link text-black">Missions & Fundraisers</a>
                <a href="{{ route('profile') }}" class="nav-link text-black">Profile</a>
                @guest
                    <a href="{{ route('login') }}" class="btn btn-light ml-3">Login</a>
                @else
                    <a href="{{ route('logout') }}" class="btn btn-light ml-3"
                       onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
            </nav>
        </div>
    </header>

    <main class="container my-4">
        <div class="row">
            <section class="col-md-12">
                @yield('content')
            </section>
        </div>
    </main>

    <footer class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between flex-wrap">
            <div class="d-flex flex-column">
                <a href="{{ route('contact') }}" class="text-white mb-2">Contact</a>
                <a href="{{ route('privacy-policy') }}" class="text-white mb-2">Privacy Policy</a>
                <a href="{{ route('terms-of-service') }}" class="text-white mb-2">Terms of Service</a>
            </div>
            <div>
                &copy; {{ date('Y') }} ACME
            </div>
        </div>
    </footer>

    @stack('scripts')

    @yield('javascript')
</div>
</body>
</html>
