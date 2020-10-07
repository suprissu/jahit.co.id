<nav>
    <div class="navbar">
        <div class="navbar__container">
            <div id="expand-trigger"></div>
            <div class="navbar__logo"></div>
        </div>
        <div class="navbar__auth">
        @guest
            <a href="{{ route('register') }}">Daftar</a>
            <a href="{{ route('login') }}"><button class="btn btn-outline-light">Masuk</button></a>
        @else
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        @endguest
        </div>
    </div>
    <div id="expand-content-nav"></div>
</nav>