@extends('layout/templateberanda_koordinator')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-around">
            <div class="mt-3 mb-3 search_customer">
                <div class="row g-2">
                    <div class="col">
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari customer..."
                            onkeypress="handleKeyPress(event)" oninput="showSuggestions()" onclick="click_customer()">
                        <div id="suggestionList" class="dropdown">
                            <ul class="list-group"></ul>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button href="#" onclick="hapusPencarian()" class="btn btn-icon button_hapus_pencarian"
                            aria-label="Button">
                            <i class="fa-solid fa-x fa-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="map_koordinator" onclick="click_map()"></div>
    @foreach ($data_pelanggan_app as $data)
        <div class="modal modal-blur fade" id="{{ $data->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $data->nama_pelanggan }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="detail_pelanggan">Nama Pelanggan : {{ $data->nama_pelanggan }} </p>
                        <p class="detail_pelanggan">Alamat : {{ $data->alamat }}</p>
                        <p class="detail_pelanggan">Maps : <a
                                href="https://www.google.com/maps/place/{{ $data->latitude }},{{ $data->longitude }}"
                                target="_blank">Klik Lokasi</a></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="container-fluid display-pelanggan-app">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="row rentang-tanggal-map filter-tanggal">
                    <h2>Filter Map</h2>
                    <div class="col-6">
                        <label for="startDate" class="form-label">Tanggal Awal</label>
                        <input type="date" class="form-control" id="startDate">
                    </div>
                    <div class="col-6">
                        <label for="endDate" class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="endDate">
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary mt-2 mb-2" id="filterButton">Filter Map</button>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="row rentang-tanggal-excel filter-tanggal">
                    <h2>Filter Excel</h2>
                    <div class="col-6">
                        <label for="startDateExcel" class="form-label">Tanggal Awal</label>
                        <input type="date" class="form-control" id="startDateExcel">
                    </div>
                    <div class="col-6">
                        <label for="endDateExcel" class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="endDateExcel">
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-warning mt-2 mb-2" id="exportButton"><i class="fa-solid fa-file-export fa-lg" style="margin-right: 5px"></i>Export Excel</button>
                </div>
            </div>
        </div>
        <table class="table table-bordered tabel-app mt-2">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">ID Pelanggan</th>
                    <th scope="col">Nama Pelanggan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($data_pelanggan_app as $app)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ date('d/m/Y H:i', strtotime($app->created_at)) }}</td>
                        <td>{{ $app->id_pelanggan }}</td>
                        <td>{{ $app->nama_pelanggan }}</td>
                        <td>
                            <a href="#" data-bs-target="#detail-{{ $app->id }}" data-bs-toggle="modal">
                                <i class="fa-solid fa-circle-info fa-lg text-primary"></i>
                            </a>
                            <!-- Modal -->
                            <div class="modal fade" id="detail-{{ $app->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title" id="exampleModalLabel">{{ $app->nama_pelanggan }}
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="idPelanggan" class="form-label">Tanggal Dibuat</label>
                                                <input type="text" class="form-control" id="idPelanggan"
                                                    name="id_pelanggan" value="{{ date('d/m/Y H:i', strtotime($app->created_at)) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="idPelanggan" class="form-label">ID Pelanggan</label>
                                                <input type="text" class="form-control" id="idPelanggan"
                                                    name="id_pelanggan" value="{{ $app->id_pelanggan }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="namaPelanggan" class="form-label">Nama Pelanggan</label>
                                                <input type="text" class="form-control" id="namaPelanggan"
                                                    name="nama_pelanggan" value="{{ $app->nama_pelanggan }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tarif" class="form-label">Tarif</label>
                                                <input type="text" class="form-control" id="tarif" name="tarif"
                                                    required value="{{ $app->tarif }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="daya" class="form-label">Daya</label>
                                                <input type="text" class="form-control" id="daya" name="daya"
                                                    required value="{{ $app->daya }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ $app->alamat }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jenis_meter" class="form-label">jenis_meter</label>
                                                <input type="text" class="form-control" id="jenis_meter"
                                                    name="jenis_meter" required value="{{ $app->jenis_meter }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="merk_meter" class="form-label">merk_meter</label>
                                                <input type="text" class="form-control" id="merk_meter"
                                                    name="merk_meter" required value="{{ $app->merk_meter }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="tahun_meter" class="form-label">tahun_meter</label>
                                                <input type="text" class="form-control" id="tahun_meter"
                                                    name="tahun_meter" required value="{{ $app->tahun_meter }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="merk_mcb" class="form-label">merk_mcb</label>
                                                <input type="text" class="form-control" id="merk_mcb"
                                                    name="merk_mcb" required value="{{ $app->merk_mcb }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="ukuran_mcb" class="form-label">ukuran_mcb</label>
                                                <input type="text" class="form-control" id="ukuran_mcb"
                                                    name="ukuran_mcb" required value="{{ $app->ukuran_mcb }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="no_segel" class="form-label">no_segel</label>
                                                <input type="text" class="form-control" id="no_segel"
                                                    name="no_segel" required value="{{ $app->no_segel }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="no_gardu" class="form-label">no_gardu</label>
                                                <input type="text" class="form-control" id="no_gardu"
                                                    name="no_gardu" required value="{{ $app->no_gardu }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="sr_deret" class="form-label">sr_deret</label>
                                                <input type="text" class="form-control" id="sr_deret"
                                                    name="sr_deret" required value="{{ $app->sr_deret }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="catatan" class="form-label">catatan</label>
                                                <input type="text" class="form-control" id="catatan" name="catatan"
                                                    required value="{{ $app->catatan }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/typeahead.js/dist/typeahead.bundle.min.js"></script>
    <script>
        // Menanggapi event klik pada modal untuk menyembunyikan elemen pencarian
        $('.modal').on('show.bs.modal', function() {
            // Sembunyikan elemen pencarian
            $('.search_customer').hide();
        });

        // Menanggapi event klik pada modal untuk menampilkan kembali elemen pencarian
        $('.modal').on('hidden.bs.modal', function() {
            // Tampilkan kembali elemen pencarian
            $('.search_customer').show();
        });
    </script>
    <script>
        var map = L.map('map_koordinator', {
            fullscreenControl: true,
            fullscreenControl: {
                pseudoFullscreen: false
            }
        }).setView([-6.90774243377773, 110.65198375582506], 10);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 25,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var data_pelanggan_app = @json($data_pelanggan_app);

        function addMarkers(data) {
            data.forEach(function(customer) {
                var iconMenyala = L.icon({
                    iconUrl: 'assets/img/lokasi_hijau.png',
                    iconSize: [20, 20],
                    iconAnchor: [20, 20],
                });
                var marker = L.marker([customer.latitude, customer.longitude], {
                    icon: iconMenyala
                }).addTo(map);

                marker.bindTooltip(customer.nama_pelanggan).openTooltip();

                marker.on('click', function() {
                    $('#' + customer.id).modal('show');
                    $('#customerName').text(customer.nama_pelanggan);
                    $('#customerDetails').text('Alamat: ' + customer.alamat);
                });
            });
        }

        addMarkers(data_pelanggan_app);

        document.getElementById('filterButton').addEventListener('click', function() {
            var startDate = document.getElementById('startDate').value;
            var endDate = document.getElementById('endDate').value;
            if (startDate && endDate) {
                var endDateObj = new Date(endDate);
                endDateObj.setDate(endDateObj.getDate() + 1);

                var filteredData = data_pelanggan_app.filter(function(customer) {
                    var createdAt = new Date(customer.created_at);
                    return createdAt >= new Date(startDate) && createdAt < endDateObj;
                });
                map.eachLayer(function(layer) {
                    if (layer instanceof L.Marker) {
                        map.removeLayer(layer);
                    }
                });
                addMarkers(filteredData);
            } 
        });

        document.getElementById('exportButton').addEventListener('click', function() {
            var startDateExcel = document.getElementById('startDateExcel').value;
            var endDateExcel = document.getElementById('endDateExcel').value;
            if (startDateExcel && endDateExcel) {
                var endDateExcelObj = new Date(endDateExcel);
                endDateExcelObj.setDate(endDateExcelObj.getDate() + 1);
                var formattedEndDateExcel = endDateExcelObj.toISOString().split('T')[0];

                var url = `/export_excel_app?start_date=${startDateExcel}&end_date=${formattedEndDateExcel}`;
                window.location.href = url;
            }
        });
    </script>
@endsection
