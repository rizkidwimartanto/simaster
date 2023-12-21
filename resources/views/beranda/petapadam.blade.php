@extends('layout/templateberanda')
@section('content')
    <div id="map"></div>
    @foreach ($data_pelanggan as $data)
        <div class="modal modal-blur fade" id="{{ $data->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $data->nama }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="detail_pelanggan">Nama Pelanggan : {{ $data->nama }} </p>
                        <p class="detail_pelanggan">Alamat : {{ $data->alamat }}</p>
                        <p class="detail_pelanggan">No Telepon :
                            <a href="https://wa.me/6289668969721?text=Halo." target="_blank">
                                +62 896-6896-9721
                            </a>
                        </p>
                        <p class="detail_pelanggan">Maps : <a href="{{ $data->maps }}"
                                target="_blank">{{ $data->maps }}</a></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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

        var customers = @json($data_pelanggan);
        var padams = @json($data_padam);
        customers.forEach(function(customer) {
            padams.forEach(function(padam) {
                if (padam.section == customer.nama_section && padam.status == 'Padam') {
                    var marker = L.marker([customer.latitude, customer.longtitude], {
                        title: customer.nama
                    }).addTo(map);
                    var circle = L.circle([customer.latitude, customer.longtitude], {
                        color: 'red',
                        fillColor: 'red',
                        fillOpacity: 0.5,
                        radius: 100
                    }).addTo(map);
                    marker.bindTooltip(customer.nama).openTooltip();
                    marker.on('click', function() {
                        $('#' + customer.id).modal('show');

                        $('#customerName').text(customer.nama);
                        $('#customerDetails').text('Alamat: ' + customer.alamat);
                    });
                }
            })
        });
    </script>
@endsection
