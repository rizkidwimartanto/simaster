<header class="navbar navbar-expand-md d-print-none" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h3 class="mt-3 d-none-navbar-horizontal">
            <a href="/beranda">
                SIMPELTAS (Sistem Monitoring Pelanggan Prioritas)
            </a>
        </h3>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                <ul class="navbar-nav">
                    <li
                        class="nav-item {{ $title == 'Peta Pelanggan' ? 'active' : ($title == 'Peta Padam' ? 'active' : '') }} dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link">
                                Peta
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item" href="/">
                                        Peta Pelanggan
                                    </a>
                                    <a class="dropdown-item" href="/petapadam">
                                        Peta Padam
                                    </a>
                                    <a class="dropdown-item" href="/petatrafo">
                                        Peta Trafo
                                    </a>
                                </div>
                            </div>
                        </div>
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
                                        Transaksi Histori
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
                    <li class="nav-item {{ $title == 'Updating' ? 'active' : '' }}">
                        <a class="nav-link" href="/inputpelanggan">
                            <span class="nav-link-title">
                                Updating
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        |
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link">
                                {{ auth()->user()->name }}
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <form action="/logout" method="get">
                                        @csrf
                                        <button type="submit" href="/" class="dropdown-item">Logout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
