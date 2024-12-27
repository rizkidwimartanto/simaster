<nav class="navbar navbar-expand-lg bg-body-tertiary p-2" data-bs-theme="dark" style="z-index: 99999999999">
    <div class="container-fluid">
        <a class="navbar-brand" href="/simaster/beranda">SIMASTER (Sistem Informasi Aset Terintegrasi)
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" style="margin-right: 40px;" id="navbarSupportedContent">
            <ul style="font-size: 13px;" class="navbar-nav me-auto mb-2 mb-lg-0">
                <li
                    class="nav-item {{ in_array($title, ['Peta Pelanggan', 'Peta Padam', 'Peta Trafo']) ? 'active' : '' }} dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Peta
                    </a>
                    <ul class="dropdown-menu" style="font-size: 13px;">
                        <li><a class="dropdown-item" href="/simaster">Peta Pelanggan</a></li>
                        <li><a class="dropdown-item" href="/simaster/petapadam">Peta Padam</a></li>
                        <li><a class="dropdown-item" href="/simaster/petatrafo">Peta Trafo</a></li>
                        <li><a class="dropdown-item" href="/simaster/petazone">Peta Zone</a></li>
                        <li><a class="dropdown-item" href="/simaster/datapohon">Data Pohon</a></li>
                        <li><a class="dropdown-item" href="/simaster/datatrafo">Data Trafo</a></li>
                    </ul>
                </li>
                <li
                    class="nav-item {{ $title == 'Transaksi Padam' ? 'active' : ($title == 'Transaksi Aktif' ? 'active' : '') }} dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Transaksi
                    </a>
                    <ul class="dropdown-menu" style="font-size: 13px;">
                        <li><a class="dropdown-item" href="/simaster/transaksiaktif">Transaksi Aktif</a></li>
                        <li><a class="dropdown-item" href="/simaster/transaksihistori">Transaksi Histori</a></li>
                    </ul>
                </li>
                <li class="nav-item {{ $title == 'Entri Padam' ? 'active' : '' }}">
                    <a class="nav-link" href="/simaster/entripadam">Entri Padam</a>
                </li>
                <li class="nav-item {{ $title == 'Updating' ? 'active' : '' }}">
                    <a class="nav-link" href="/simaster/updating">Updating</a>
                </li>
            </ul>
            <div class="btn-group">
                <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    {{ auth()->user()->name }}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item " href="/simaster/edit_user_simaster/{{ auth()->user()->id }}">Edit</a></li>
                    <li><a class="dropdown-item" href="/simaster/logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
