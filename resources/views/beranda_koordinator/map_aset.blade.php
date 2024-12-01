@extends('layout/templateberanda_koordinator')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-around">
            <div class="mt-3 mb-3 search_customer">
                <div class="row g-2">
                    <div class="col">
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari pelanggan..."
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
    @foreach ($data_aset as $data)
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
    <div class="container-fluid display-pelanggan-app" style="margin-top: 60px;">
        <h1 class="text-center" style="font-weight: 700;">Semua Pelanggan APP</h1>
        <div class="card p-3 mb-3">
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
                        <button class="btn btn-primary mt-2 mb-2" id="filterButton"> <i class="fa-solid fa-filter fa-lg"
                                style="margin-right: 5px;"></i> Filter Map</button>
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
                        <button class="btn btn-warning mt-2 mb-2" id="exportButton"><i class="fa-solid fa-file-export fa-lg"
                                style="margin-right: 5px"></i>Export Excel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/typeahead.js/dist/typeahead.bundle.min.js"></script>
    <script>
        $('.modal').on('show.bs.modal', function() {
            $('.search_customer').hide();
        });
        $('.modal').on('hidden.bs.modal', function() {
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
        // Data GeoJSON untuk Kabupaten Demak
        const demakBoundary = {
            "type": "FeatureCollection",
            "features": [{
                "type": "Feature",
                "geometry": {
                    "type": "Polygon",
                    "coordinates": [
                        [
                            [110.6241, -6.8051],
                            [110.6315, -6.8163],
                            [110.6423, -6.8257],
                            [110.6558, -6.8349],
                            [110.6711, -6.8412],
                            [110.6892, -6.8456],
                            [110.7025, -6.8493],
                            [110.7159, -6.8602],
                            [110.7256, -6.8737],
                            [110.7358, -6.8859],
                            [110.7482, -6.8962],
                            [110.7621, -6.9051],
                            [110.7763, -6.9124],
                            [110.7897, -6.9173],
                            [110.8012, -6.9195],
                            [110.8108, -6.9221],
                            [110.8187, -6.9243],
                            [110.8264, -6.9301],
                            [110.8332, -6.9418],
                            [110.8369, -6.9567],
                            [110.8412, -6.9668],
                            [110.8465, -6.9753],
                            [110.8547, -6.9812],
                            [110.8608, -6.9883],
                            [110.8642, -6.9982],
                            [110.8651, -7.0112],
                            [110.8617, -7.0214],
                            [110.8542, -7.0303],
                            [110.8407, -7.0365],
                            [110.8234, -7.0421],
                            [110.8062, -7.0456],
                            [110.7856, -7.0465],
                            [110.7651, -7.0441],
                            [110.7456, -7.0387],
                            [110.7282, -7.0296],
                            [110.7123, -7.0184],
                            [110.6985, -7.0051],
                            [110.6876, -6.9902],
                            [110.6801, -6.9743],
                            [110.6715, -6.9582],
                            [110.6613, -6.9418],
                            [110.6482, -6.9271],
                            [110.6341, -6.9156],
                            [110.6241, -6.8051]
                        ]
                    ]
                },
                "properties": {
                    "name": "Kabupaten Demak",
                    "type": "Administrative Boundary",
                    "admin_level": 4,
                    "country": "Indonesia"
                }
            }]
        };
        const groboganBoundary = {
            "type": "FeatureCollection",
            "features": [{
                "type": "Feature",
                "geometry": {
                    "type": "Polygon",
                    "coordinates": [
                        [
                            [110.7000, -7.2500],
                            [110.8000, -7.2000],
                            [110.8500, -7.2500],
                            [110.8500, -7.3000],
                            [110.8000, -7.3500],
                            [110.7000, -7.3000],
                            [110.7000, -7.2500]
                        ]
                    ]
                },
                "properties": {
                    "name": "Kabupaten Grobogan",
                    "type": "Administrative Boundary",
                    "admin_level": 4,
                    "country": "Indonesia"
                }
            }]
        };

        // Tambahkan GeoJSON ke peta
        L.geoJSON(groboganBoundary, {
            style: {
                color: 'green',
                weight: 2,
                fillOpacity: 0.2
            }
        }).addTo(map);
        L.geoJSON(demakBoundary, {
            style: {
                color: 'blue',
                weight: 2,
                fillOpacity: 0.2
            }
        }).addTo(map);

        // Tambahkan marker pelanggan seperti sebelumnya
        var data_aset = @json($data_aset);
        var currentMarker;
    </script>
@endsection
