<nav>
    <div class="navbar">
        <div class="navbar__container">
            <button id="expand-button" class="btn btn-outline-light"><i class="fas fa-bars"></i></button>
            <div class="navbar__links"><a href="/">Beranda</a><a href="/about">Tentang Kami</a></div>
            <div class="navbar__logo"></div>
        </div>
        <div class="navbar__auth">
        @guest
            <a href="{{ route('register') }}">Daftar</a>
            <a href="{{ route('login') }}"><button class="btn btn-outline-light">Masuk</button></a>
        @else
            <div class="dropdown">
                <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <button class="btn btn-outline-light dropdown-toggle">
                        @inject('roleConstants', 'App\Constant\RoleConstant')
                        @if ( Auth::user()->roles()->count() == 0)
                            {{ Auth::user()->name }}
                        @elseif ( Auth::user()->roles()->first() == $roleConstants::CUSTOMER )
                            {{ Auth::user()->customer->company_name }}
                        @elseif ( Auth::user()->roles()->first() == $roleConstants::PARTNER )
                            {{ Auth::user()->partner->company_name }}
                        @else
                            {{ Auth::user()->name }}
                        @endif
                    </button>
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('home') }}">Proyek</a>
                    <a class="dropdown-item" href="{{ route('home.inbox') }}">Pesan</a>
                    @if ( Auth::user()->roles()->count() == 0)
                        <a class="dropdown-item" href="{{ route('home.transaction') }}">Transaksi</a>
                    @elseif ( Auth::user()->roles()->first()->name == $roleConstants::PARTNER )
                        <a class="dropdown-item" href="{{ route('home.transaction') }}">Bahan</a>
                    @else
                        <a class="dropdown-item" href="{{ route('home.transaction') }}">Transaksi</a>
                    @endif
                    @if ( Auth::user()->roles()->count() == 0)

                    @elseif ( Auth::user()->roles()->first()->name == $roleConstants::ADMINISTRATOR )
                        <a class="dropdown-item" href="{{ route('home.material') }}">Material</a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item dropdown-item-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Keluar
                    </a>
                </div>
            </div>
            <div class="bottom-navigation">
                <a href="{{ route('home') }}">
                    <i class="fa fa-hotel" aria-hidden="true"></i><p>Proyek</p>
                </a>
                <a href="{{ route('home.inbox') }}">
                    <i class="fas fa-envelope" aria-hidden="true"></i><p>Pesan</p>
                </a>
                <a href="{{ route('home.transaction') }}">
                @if ( Auth::user()->roles()->count() == 0)
                    <i class="fa fa-money-bill-wave-alt" aria-hidden="true"></i><p>Transaksi</p>
                @elseif ( Auth::user()->roles()->first()->name == $roleConstants::PARTNER )
                    <i class="fa fa-money-bill-wave-alt" aria-hidden="true"></i><p>Bahan</p>
                @else
                    <i class="fa fa-money-bill-wave-alt" aria-hidden="true"></i><p>Transaksi</p>
                @endif
                </a>
                @if ( Auth::user()->roles()->count() == 0)

                @elseif ( Auth::user()->roles()->first()->name == $roleConstants::ADMINISTRATOR )
                    <a href="{{ route('home.material') }}">
                        <i class="fa fa-tshirt" aria-hidden="true"></i><p>Bahan</p>
                    </a>
                @endif
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out-alt" aria-hidden="true"></i><p>Keluar</p>
                </a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endguest
        </div>
    </div>
    <div id="expand-content-nav"></div>
</nav>