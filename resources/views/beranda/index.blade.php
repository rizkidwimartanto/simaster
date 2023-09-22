@extends('layout/templateberanda')
@section('content')
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/img/Logo_PLN.png" alt="Logo" width="40" height="40" class="d-inline-block">
                Inovasi <strong>UP3 Demak</strong>
              </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Peta Pelanggan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Peta Padam</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Peta Padam</a>
                    </li>
                </ul>
                <div class="navbar-extra">
                    <a href="#" class="nav-extra" id="search"><i class="fa-solid fa-message"></i> Pesan</a>
                    <a href="#" class="nav-extra" id="shopping-cart"><i class="fa-solid fa-bell"></i> Notifikasi</a>
                    <a href="/" class="nav-extra" id="shopping-cart"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </div>
            </div>
        </div>
    </nav>      
@endsection
