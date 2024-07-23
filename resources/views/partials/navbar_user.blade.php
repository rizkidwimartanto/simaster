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
                  <li
                      class="nav-item {{ $title == 'Peta Pelanggan' ? 'active' : ($title == 'Peta Padam' ? 'active' : '') }} dropdown">
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                          aria-expanded="false">
                          Peta
                      </a>
                      <ul class="dropdown-menu" style="font-size: 13px;">
                          <li><a class="dropdown-item" href="/">Peta Pelanggan</a></li>
                          <li><a class="dropdown-item" href="/petapadam">Peta Padam</a></li>
                          <li><a class="dropdown-item" href="/petatrafo">Peta Trafo</a></li>
                      </ul>
                  </li>
                  <li class="nav-item {{ $title == 'Entri Data' ? 'active' : '' }}">
                      <a class="nav-link" href="/entridata_user">Entri Data</a>
                  </li>
              </ul>
              <form class="d-flex" role="search" action="/logout" method="GET">
                  @csrf
                  <button class="btn btn-danger" type="submit" href="/">{{ auth()->user()->name }} | Logout</button>
              </form>
          </div>
      </div>
  </nav>
  