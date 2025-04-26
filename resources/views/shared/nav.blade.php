<nav>
    <div class="nav-icons">
        <a href="{{ route('dashboard') }}" class="link-size"><span class="material-symbols-outlined" data-tooltip="Home"><img src="{{ asset('imgs/black/home.svg') }}" alt="Home icon" class="theme-icon"></span></a>
        @guest
            <a href="{{ route('login') }}" class="link-size"><span class="material-symbols-outlined" data-tooltip="Login"><img src="{{ asset('imgs/black/login.svg') }}" alt="Login icon" class="theme-icon"></span></a>
            <a href="{{ route('register') }}" class="link-size"><span class="material-symbols-outlined" data-tooltip="Register"><img src="{{ asset('imgs/black/register.svg') }}" alt="Register icon" class="theme-icon"></span></a>
        @endguest
        @auth
        <a href="{{ route('feed') }}" class="link-size"><span class="material-symbols-outlined" data-tooltip="Profile"><img src="{{ asset('imgs/black/feed.svg') }}" alt="Person icon" class="theme-icon"></span></a>
        <a href="{{ route('profile') }}" class="link-size"><span class="material-symbols-outlined" data-tooltip="Profile"><img src="{{ asset('imgs/black/person.svg') }}" alt="Person icon" class="theme-icon"></span></a>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <a class="link-size" onclick="if (confirm('Are you sure you want to logout?')) this.closest('form').submit();" data-tooltip="Logout"><span class="material-symbols-outlined"><img src="{{ asset('imgs/black/logout.svg') }}" alt="Logout icon" class="theme-icon"></span></a>
        </form>
        @endauth
        @if (auth()->user()->is_admin ?? false)
            <a href="{{ route('admin.dashboard') }}" class="link-size"><span class="material-symbols-outlined" data-tooltip="Admin"><img src="{{ asset('imgs/black/admin.svg') }}" alt="Admin icon" class="theme-icon"></span></a>
        @endif
    </div>
</nav>