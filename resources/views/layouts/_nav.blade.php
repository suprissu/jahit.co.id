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
            <div class="dropdown">
                <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <button class="btn btn-outline-light dropdown-toggle">
                        {{ Auth::user()->name }}
                    </button>
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('warning', ['type' => App\Constant\WarningStatusConstant::WORK_IN_PROGRESS]) }}">Proyek</a>
                    <a class="dropdown-item" href="{{ route('warning', ['type' => App\Constant\WarningStatusConstant::WORK_IN_PROGRESS]) }}">Pesan</a>
                    <a class="dropdown-item" href="{{ route('warning', ['type' => App\Constant\WarningStatusConstant::WORK_IN_PROGRESS]) }}">Transaksi</a>
                    <div class="dropdown-divider"></div>
                    <a class="text-danger dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Keluar
                    </a>
                </div>
            </div>
            <div class="bottom-navigation">
                <a href="{{ route('warning', ['type' => App\Constant\WarningStatusConstant::WORK_IN_PROGRESS]) }}">
                    <i class="fa fa-hotel" aria-hidden="true"></i><p>Proyek</p>
                </a>
                <a href="{{ route('warning', ['type' => App\Constant\WarningStatusConstant::WORK_IN_PROGRESS]) }}">
                    <i class="fas fa-envelope" aria-hidden="true"></i><p>Pesan</p>
                </a>
                <a href="{{ route('warning', ['type' => App\Constant\WarningStatusConstant::WORK_IN_PROGRESS]) }}">
                    <i class="fa fa-money-bill-wave-alt" aria-hidden="true"></i><p>Transaksi</p>
                </a>
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