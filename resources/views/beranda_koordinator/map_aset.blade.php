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

        // Tambahkan marker pelanggan seperti sebelumnya
        var data_aset = @json($data_aset);
        var currentMarker;
    </script>
@endsection
