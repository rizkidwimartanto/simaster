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
                        <p class="detail_pelanggan">No Telepon : {{ $data->no_telepon }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <script>
        var map = L.map('map').setView([-6.90774243377773, 110.65198375582506], 10);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var customers = @json($data_pelanggan);
        var padams = @json($data_padam);
        customers.forEach(function(customer) {
            padams.forEach(function(padam){
                var marker = L.marker([customer.latitude, customer.longtitude]).addTo(map);
                if(padam.penyulang === customer.penyulang && padam.status == '1'){
                    var circle = L.circle([customer.latitude, customer.longtitude], {
                        color: 'red',
                        fillColor: 'red',
                        fillOpacity: 0.5,
                        radius: 100
                    }).addTo(map);
                }else{
                    var circle = L.circle([customer.latitude, customer.longtitude], {
                        color: 'black',
                        fillColor: 'black',
                        fillOpacity: 0.5,
                        radius: 100
                    }).addTo(map);
                }
                marker.bindTooltip(customer.nama).openTooltip();
                marker.on('click', function() {
                    $('#' + customer.id).modal('show');
    
                    $('#customerName').text(customer.nama);
                    $('#customerDetails').text('Alamat: ' + customer.alamat);
                });
            })
        });
    </script>
@endsection
