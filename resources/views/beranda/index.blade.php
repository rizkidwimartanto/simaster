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
                    <a href="/" class="nav-extra" id="shopping-cart"><i class="fa-solid fa-right-from-bracket"></i>
                        Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div id="map"></div>

    <script>
        var map = L.map('map').setView([-6.907731775903388, 110.65208031071367], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var marker = L.marker([51.5, -0.09]).addTo(map);
        var circle = L.circle([51.508, -0.11], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 500
        }).addTo(map);
        var polygon = L.polygon([
            [51.509, -0.08],
            [51.503, -0.06],
            [51.51, -0.047]
        ]).addTo(map);
        marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
        circle.bindPopup("I am a circle.");
        polygon.bindPopup("I am a polygon.");
        var popup = L.popup()
            .setLatLng([51.513, -0.09])
            .setContent("I am a standalone popup.")
            .openOn(map);

        function onMapClick(e) {
            alert("You clicked the map at " + e.latlng);
        }

        map.on('click', onMapClick);
        var popup = L.popup();

        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent("You clicked the map at " + e.latlng.toString())
                .openOn(map);
        }

        map.on('click', onMapClick);
    </script>
@endsection
