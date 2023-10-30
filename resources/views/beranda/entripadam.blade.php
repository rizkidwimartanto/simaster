@extends('layout/templateberanda')
@section('content')
    <div id="map"></div>
    <script>
        var map = L.map('map').setView([-6.90774243377773, 110.65198375582506], 10);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Tambahkan marker untuk setiap pelanggan
        var customers = @json($data_pelanggan); // Konversi data pelanggan dari PHP ke JavaScript
        customers.forEach(function(customer) {
            var marker = L.marker([customer.latitude, customer.longtitude]).addTo(map);
            var circle = L.circle([customer.latitude, customer.longtitude], {
                color: 'black',
                fillColor: '#353535',
                fillOpacity: 0.5,
                radius: 500
            }).addTo(map);
            marker.bindPopup(customer.nama).openPopup();
        });
    </script>
@endsection
