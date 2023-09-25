@extends('layout/templateberanda');
@section('content')
    <!-- Navbar Start -->
    <nav class="navbar">
        <div class="menu-navbar">
            <a href="#" class="navbar-logo">Inovasi UP3<strong>Demak</strong></a>
            <div class="navbar-nav">
                <a href="#home">Peta Pelanggan</a>
                <a href="#about">Peta Padam</a>
            </div>
        </div>
        <div class="navbar-extra">
            <a href="#" id="search"><i data-feather="inbox"></i></a>
            <a href="#" id="shopping-cart"><i data-feather="bell"></i></a>
            <button class="button-logout">Logout</button>
            <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->
    <div id="map"></div>
    <!-- footer start -->

    {{-- <footer>
        <div class="row">
            <div class="socials">
                <a href="#"><i data-feather="instagram"></i></a>
                <a href="#"><i data-feather="twitter"></i></a>
                <a href="#"><i data-feather="facebook"></i></a>
            </div>

            <div class="links">
                <a href="#home">Home</a>
                <a href="#about">Tentang Kami</a>
                <a href="#menu">Menu</a>
                <a href="#contact">Kontak Kami</a>
            </div>

            <div class="credit">
                <p>Created by <a href="">Rizki Dwi Martanto</a> | &copy; 2023.</p>
            </div>
        </div>
    </footer> --}}

    <!-- footer end -->

    <!-- Landing Page End -->
@endsection
