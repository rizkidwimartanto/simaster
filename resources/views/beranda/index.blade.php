@extends('layout/templateberanda')
@section('content')
    <div id="map"></div>
    <script>
        var map = L.map('map').setView([-6.90774243377773, 110.65198375582506], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var marker = L.marker([-6.90774243377773, 110.65198375582506]).addTo(map);
        var circle = L.circle([-6.90774243377773, 110.65198375582506], {
            color: 'red',
            fillColor: 'rgb(12, 247, 20)',
            fillOpacity: 0.5,
            radius: 300
        }).addTo(map);
        marker.bindPopup("<b>UP3 Demak</b>").openPopup();
    </script>
@endsection
