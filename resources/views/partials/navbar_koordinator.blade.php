<nav class="navbar navbar-expand-lg bg-body-tertiary p-2 sticky-top" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/beranda"> SIMPELTAS (Sistem Monitoring Pelanggan Prioritas)
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul style="font-size: 13px;" class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item {{ $title == 'Koordinator' ? 'active' : '' }}">
                    <a class="nav-link" href="/user">Koordinator</a>
                </li>
            </ul>
            <form class="d-flex" role="search" action="/logout" method="GET">
                @csrf
                <button class="btn btn-danger" type="submit" href="/">{{ auth()->user()->name }} |
                    Logout</button>
            </form>
        </div>
    </div>
</nav>
