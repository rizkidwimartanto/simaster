<header class="navbar navbar-expand-md d-print-none" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="/beranda">
                Inovasi UP3 Demak
            </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span>{{ auth()->user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <form action="/logout" method="get">
                        @csrf
                        <button type="submit" href="/" class="dropdown-item">Logout</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                <ul class="navbar-nav">
                    <li class="nav-item {{ $title == 'Peta Pelanggan' ? 'active' : '' }}">
                        <a class="nav-link" href="/beranda">
                            <span class="nav-link-title">
                                Peta Pelanggan
                            </span>
                        </a>
                    </li>
                    <li class="nav-item {{ $title == 'Peta Padam' ? 'active' : '' }}">
                        <a class="nav-link" href="/petapadam">
                            <span class="nav-link-title">
                                Peta Padam
                            </span>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ $title == 'Transaksi Padam' ? 'active' : ($title == 'Transaksi Aktif' ? 'active' : '') }} dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link">
                                Transaksi
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item" href="/transaksiaktif">
                                        Transaksi Aktif
                                    </a>
                                    <a class="dropdown-item" href="/transaksipadam">
                                        Transaksi Padam
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item {{ $title == 'Entri Padam' ? 'active' : '' }}">
                        <a class="nav-link" href="/entripadam">
                            <span class="nav-link-title">
                                Entri Padam
                            </span>
                        </a>
                    </li>
                    <li class="nav-item {{ $title == 'Input Pelanggan' ? 'active' : '' }}">
                        <a class="nav-link" href="/inputpelanggan">
                            <span class="nav-link-title">
                                Input Pelanggan
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
