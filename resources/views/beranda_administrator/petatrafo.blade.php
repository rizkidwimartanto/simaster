@extends('layout/templateberanda')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-around">
            <div class="mt-3 mb-3 search_customer">
                <div class="row g-2">
                    <div class="col">
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari penyulang..."
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
            <select class="form-select pilih_peta" id="pilih_peta" name="pilih_peta">
                <option disabled selected>--- Pilih Area Unit ---</option>
                @foreach ($kategori->unique() as $k)
                    <option value="{{ $k }}">
                        {{ $k }}
                    </option>
                @endforeach
                @foreach ($unit_layanan->unique() as $data)
                    <option value="{{ $data }}">
                        {{ $data }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div id="map" onclick="click_map()"></div>
    @foreach ($data_trafo as $trafo)
        <div class="modal modal-blur fade" id="{{ $trafo->id }}" style="z-index: 99999999" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $trafo->penyulang }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="detail_pelanggan">Penyulang : {{ $trafo->penyulang }} </p>
                        <p class="detail_pelanggan">Unit Layanan : {{ $trafo->unit_layanan }}</p>
                        <p class="detail_pelanggan">Nomor Tiang : {{ $trafo->no_tiang }}</p>
                        <p class="detail_pelanggan">Daya : {{ $trafo->daya }} kVa</p>
                        <p class="detail_pelanggan">Alamat : {{ $trafo->lokasi }} </p>
                        <p class="detail_pelanggan">Beban : {{ $trafo->bebanA }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <script src="https://cdn.jsdelivr.net/npm/typeahead.js/dist/typeahead.bundle.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#pointA').selectize({
                sortField: 'text'
            });
        });
        $(document).ready(function(){
            $('#pointB').selectize({
                sortField: 'text'
            });
        });
    </script>
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

        var padams = @json($data_trafo);

        $('#pilih_peta').change(function() {
            // Menghapus semua marker yang ada pada peta
            map.eachLayer(function(layer) {
                if (layer instanceof L.Marker) {
                    map.removeLayer(layer);
                }
            });

            var selectedunit_layanan = $(this).val();

            var filteredDataPeta = padams.filter(function(customer) {
                return customer.unit_layanan === selectedunit_layanan || customer.kategori ===
                    selectedunit_layanan;
            });

            filteredDataPeta.forEach(function(customer) {
                var iconPadam = L.icon({
                    iconUrl: '{{ asset('public/assets/img/lokasi_merah.png') }}',
                    iconSize: [20, 20],
                    iconAnchor: [20, 20],
                });
                var iconMenyala = L.icon({
                    iconUrl: '{{ asset('public/assets/img/lokasi_hijau.png') }}',
                    iconSize: [20, 20],
                    iconAnchor: [20, 20],
                });
                if (customer.kategori === 'Trafo Trip') {
                    var marker = L.marker([customer.latitude, customer.longtitude], {
                        icon: iconPadam
                    }).addTo(map);
                } else {
                    var marker = L.marker([customer.latitude, customer.longtitude], {
                        icon: iconMenyala
                    }).addTo(map);
                }
                marker.bindTooltip(customer.penyulang).openTooltip();
                marker.on('click', function() {
                    $('#' + customer.id).modal('show');
                    $('#customerName').text(customer.penyulang);
                    $('#customerDetails').text('Alamat: ' + customer.no_tiang);
                });
            });
        });

        padams.forEach(function(padam) {
            var iconPadam = L.icon({
                iconUrl: '{{ asset('public/assets/img/lokasi_merah.png') }}',
                iconSize: [20, 20],
                iconAnchor: [20, 20],
            });
            var iconMenyala = L.icon({
                iconUrl: '{{ asset('public/{{ asset('public/assets/img/lokasi_merah.png') }}') }}',
                iconSize: [20, 20],
                iconAnchor: [20, 20],
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

        function handleKeyPress(event) {
            if (event.keyCode === 13) {
                searchCustomer();
            }
        }

        function hapusPencarian() {
            document.getElementById('searchInput').value = "";
            document.getElementById('suggestionList').style.display = 'none';
        }

        function click_map() {
            document.getElementById('suggestionList').style.display = "none";
        }

        function click_customer() {
            document.getElementById('suggestionList').style.display = "block";
        }

        function showSuggestions() {
            var searchTerm = document.getElementById('searchInput').value.toLowerCase();
            var suggestionList = document.getElementById('suggestionList');
            var listGroup = suggestionList.querySelector('ul');
            listGroup.innerHTML = '';

            var matchCount = 0;
            padams.forEach(function(customer) {
                if (customer.penyulang.toLowerCase().includes(searchTerm) && matchCount < 10) {
                    var listItem = document.createElement('li');
                    listItem.className = 'list-group-item';
                    listItem.textContent = customer.penyulang;
                    listItem.onclick = function() {
                        document.getElementById('searchInput').value = customer.penyulang;
                        listGroup.innerHTML = ''; // Sembunyikan daftar setelah memilih
                        showMarker(customer);
                    };
                    listGroup.appendChild(listItem);
                    matchCount++;
                }
            });

            if (listGroup.childElementCount > 0) {
                suggestionList.style.display = 'block';
            } else {
                suggestionList.style.display = 'none';
            }
        }

        function showMarker(customer) {
            if (currentMarker) {
                map.removeLayer(currentMarker);
            }
            map.setView([customer.latitude, customer.longtitude], 19);
            currentMarker.bindTooltip(customer.penyulang).openTooltip();
            currentMarker.on('click', function() {
                $('#' + customer.id).modal('show');
                $('#customerName').text(customer.penyulang);
                $('#customerDetails').text('Alamat: ' + customer.no_tiang);
            });
        }

        document.addEventListener('click', function(event) {
            var suggestionList = document.getElementById('suggestionList');
            if (event.target !== suggestionList && !suggestionList.contains(event.target)) {
                suggestionList.style.display = 'none';
            }
        });
        var currentMarker;
    </script>
@endsection
