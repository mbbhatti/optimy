<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">
        <li><a href="http://localhost:8000" target="_blank">Visit Site</a></li>
        <li>
            @guest
                <a href="{{ route('admin.login') }}">Login</a>
            @else
                <a href="{{ route('admin.logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endguest
        </li>
    </ul>
</div>
