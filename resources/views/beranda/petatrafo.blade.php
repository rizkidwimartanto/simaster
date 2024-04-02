@extends('layout/templateberanda')
@section('content')
    <div id="map" style="position: relative; top: 0.5px;" onclick="click_map()"></div>
    <script>
        var map = L.map('map', {
            fullscreenControl: true,
            fullscreenControl: {
                pseudoFullscreen: false
            }
        }).setView([-6.90774243377773, 110.65198375582506], 10);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        L.control.locate({
            position: 'topleft',
            drawCircle: true,
            follow: true,
            setView: 'untilPan',
            keepCurrentZoomLevel: true,
            stopFollowingOnDrag: false,
            markerStyle: {
                weight: 1,
                opacity: 0.8,
                fillOpacity: 0.8
            },
            circleStyle: {
                weight: 1,
                clickable: false
            },
            icon: 'fa fa-location-arrow',
            metric: false,
            strings: {
                title: "Temukan Lokasi Anda",
                popup: "You are within {distance} {unit} from this point",
                outsideMapBoundsMsg: "You seem located outside the boundaries of the map"
            },
            locateOptions: {
                maxZoom: 16
            }
        }).addTo(map);

        var padams = @json($trafo);
        padams.forEach(function(padam) {
            var iconPadam = L.icon({
                iconUrl: 'assets/img/lokasi_merah.png',
                iconSize: [40, 40],
                iconAnchor: [40, 40],
            });
            var iconMenyala = L.icon({
                iconUrl: 'assets/img/lokasi_hijau.png',
                iconSize: [40, 40],
                iconAnchor: [40, 40],
            });
            if (padam.kategori === 'Trafo Trip') {
                var marker = L.marker([padam.latitude, padam.longtitude], {
                    icon: iconPadam
                }).addTo(map);
            } else {
                var marker = L.marker([padam.latitude, padam.longtitude], {
                    icon: iconMenyala
                }).addTo(map);
            }
            marker.bindTooltip(padam.penyulang).openTooltip();
            marker.on('click', function() {
                $('#' + padam.id).modal('show');
                $('#customerName').text(padam.penyulang);
                $('#customerDetails').text('Alamat: ' + padam.no_tiang);
            });
        });
    </script>
@endsection
