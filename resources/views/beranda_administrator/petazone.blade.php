@extends('layout/templateberanda')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="mt-3 mb-3 search_tiang">
                <div class="row g-2">
                    <div class="col">
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari keypoint..."
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
        <div class="d-flex justify-content-around">
            <!-- Button trigger modal -->
            <button class="btn btn-primary" type="button" id="tambah_garis" data-bs-toggle="modal"
                data-bs-target="#tambahGaris">Tambah Garis</button>
            <button class="btn btn-danger" type="button" id="hapus_garis" data-bs-toggle="modal"
                data-bs-target="#hapusGarisModal">Hapus Garis</button>
            <!-- Modal -->
            <div class="modal fade" style="z-index: 999999999" id="tambahGaris" tabindex="-1"
                aria-labelledby="tambahGarisLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title" id="tambahGarisLabel">Tambah Garis</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Point A</label>
                            <select name="pointA" id="pointA" class="mb-4">
                                @foreach ($data_zone as $zone)
                                    <option value="{{ $zone->latitude }},{{ $zone->longitude }}">{{ $zone->keypoint }}
                                    </option>
                                @endforeach
                            </select>
                            <label class="form-label">Point B</label>
                            <select name="pointB" id="pointB" class="">
                                @foreach ($data_zone as $zone)
                                    <option value="{{ $zone->latitude }},{{ $zone->longitude }}">{{ $zone->keypoint }}
                                    </option>
                                @endforeach
                            </select>
                            <label class="form-label mt-4">Warna Garis</label>
                            <input type="color" id="polylineColor" name="polylineColor" value="#0000ff"
                                class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" style="z-index: 999999999" id="hapusGarisModal" tabindex="-1"
                aria-labelledby="hapusGarisModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title" id="hapusGarisModalLabel">Hapus Garis</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Point A</label>
                            <select name="pointAHapus" id="pointAHapus" class="mb-4">
                                @foreach ($data_zone as $zone)
                                    <option value="{{ $zone->latitude }},{{ $zone->longitude }}">{{ $zone->keypoint }}
                                    </option>
                                @endforeach
                            </select>
                            <label class="form-label">Point B</label>
                            <select name="pointBHapus" id="pointBHapus" class="">
                                @foreach ($data_zone as $zone)
                                    <option value="{{ $zone->latitude }},{{ $zone->longitude }}">{{ $zone->keypoint }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger" id="deleteRoute">Hapus Garis</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="map" style="position: relative; top: 1px;" onclick="click_map()"></div>
    @foreach ($data_zone as $zone)
        <div class="modal modal-blur fade" id="{{ $zone->id }}" style="z-index: 99999999" tabindex="-1"
            role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $zone->keypoint }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="detail_pelanggan">Feeder : {{ $zone->feeder }} </p>
                        <p class="detail_pelanggan">Keypoint : {{ $zone->keypoint }} </p>
                        <p class="detail_pelanggan">Jarak : {{ $zone->jarak }} </p>
                        <p class="detail_pelanggan">Google Maps : <a target="_blank"
                                href="{{ $zone->google_maps }}">{{ $zone->google_maps }} </a></p>
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
        $(document).ready(function() {
            $('#pointA').selectize({
                sortField: 'text'
            });
        });
        $(document).ready(function() {
            $('#pointB').selectize({
                sortField: 'text'
            });
        });
        $(document).ready(function() {
            $('#pointAHapus').selectize({
                sortField: 'text'
            });
        });
        $(document).ready(function() {
            $('#pointBHapus').selectize({
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
        const colorInput = document.getElementById('polylineColor');
        let routes = [];
        let selectedRouteIndex = null; // Untuk menyimpan indeks rute yang ingin dihapus
        var map = L.map('map', {
            fullscreenControl: true,
            fullscreenControl: {
                pseudoFullscreen: false
            }
        }).setView([-6.90774243377773, 110.65198375582506], 10);
        // Fungsi untuk memuat ulang rute dari localStorage
        function loadSavedRoute() {
            const savedRoute = JSON.parse(localStorage.getItem('savedRoute'));
            if (savedRoute) {
                createRoute(savedRoute.pointA, savedRoute.pointB, savedRoute.color);
            }
        }

        function saveRoutes() {
            const savedRoutes = routes.map(route => {
                const waypoints = route.getWaypoints();
                return {
                    pointA: [waypoints[0].latLng.lat, waypoints[0].latLng.lng],
                    pointB: [waypoints[1].latLng.lat, waypoints[1].latLng.lng],
                    color: route.options.lineOptions.styles[0].color
                };
            });
            localStorage.setItem('savedRoutes', JSON.stringify(savedRoutes));
        }
        // Fungsi untuk membuat rute
        function createRoute(pointA, pointB, color) {
            const newRoute = L.Routing.control({
                show: false,
                addWaypoints: false,
                draggableWaypoints: false,
                fitSelectedRoutes: false,
                waypoints: [
                    L.latLng(pointA[0], pointA[1]),
                    L.latLng(pointB[0], pointB[1])
                ],
                lineOptions: {
                    styles: [{
                        color: color,
                        opacity: 0.6,
                        weight: 4
                    }]
                },
                createMarker: function() {
                    return null;
                } // Tidak membuat marker untuk waypoints
            }).addTo(map);

            routes.push(newRoute); // Tambahkan rute baru ke array routes
            saveRoutes(); // Simpan rute ke localStorage
            map.setView([pointA[0], pointA[1]], 15); // 15 untuk level zoom
        }

        function loadSavedRoutes() {
            const savedRoutes = JSON.parse(localStorage.getItem('savedRoutes'));
            if (savedRoutes) {
                savedRoutes.forEach(route => {
                    createRoute(route.pointA, route.pointB, route.color);
                });
            }
        }
        // Event untuk menyimpan rute baru
        document.getElementById('saveChanges').addEventListener('click', function() {
            var pointA = document.getElementById('pointA').value.split(',');
            var pointB = document.getElementById('pointB').value.split(',');
            var color = colorInput.value;

            createRoute(
                [parseFloat(pointA[0]), parseFloat(pointA[1])],
                [parseFloat(pointB[0]), parseFloat(pointB[1])],
                color
            );

            // Simpan rute ke localStorage
            saveRoutes();
            $('#tambahGaris').modal('hide');
        });
        document.getElementById('deleteRoute').addEventListener('click', function() {
            var pointA = document.getElementById('hapusGarisModal').querySelector('#pointAHapus').value.split(',');
            var pointB = document.getElementById('hapusGarisModal').querySelector('#pointBHapus').value.split(',');
            pointA = [parseFloat(pointA[0]), parseFloat(pointA[1])];
            pointB = [parseFloat(pointB[0]), parseFloat(pointB[1])];

            const routeIndex = routes.findIndex(route => {
                const waypoints = route.getWaypoints();
                return (
                    waypoints[0].latLng.lat === pointA[0] && waypoints[0].latLng.lng === pointA[1] &&
                    waypoints[1].latLng.lat === pointB[0] && waypoints[1].latLng.lng === pointB[1]
                );
            });

            if (routeIndex !== -1) {
                const route = routes[routeIndex];
                map.removeControl(route);
                routes.splice(routeIndex, 1);

                // Perbarui penyimpanan di localStorage
                saveRoutes();

                $('#hapusGarisModal').modal('hide');
            } else {
                alert('Rute tidak ditemukan berdasarkan Point A dan Point B yang dipilih.');
            }
        });
        // Panggil fungsi loadSavedRoute saat halaman dimuat
        document.addEventListener('DOMContentLoaded', loadSavedRoutes);
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

        var zones = @json($data_zone);

        $('#pilih_peta').change(function() {
            // Menghapus semua marker yang ada pada peta
            map.eachLayer(function(layer) {
                if (layer instanceof L.Marker) {
                    map.removeLayer(layer);
                }
            });

            var selectedunit_layanan = $(this).val();

            var filteredDataPeta = zones.filter(function(customer) {
                return customer.unit_layanan === selectedunit_layanan || customer.kategori ===
                    selectedunit_layanan;
            });

            filteredDataPeta.forEach(function(customer) {
                var iconPadam = L.icon({
                    iconUrl: '{{ asset('assets/img/lokasi_merah.png') }}',
                    iconSize: [20, 20],
                    iconAnchor: [20, 20],
                });
                var iconMenyala = L.icon({
                    iconUrl: '{{ asset('assets/img/lokasi_hijau.png') }}',
                    iconSize: [20, 20],
                    iconAnchor: [20, 20],
                });
                var marker = L.marker([customer.latitude, customer.longitude], {
                    icon: iconMenyala
                }).addTo(map);
                marker.bindTooltip(customer.keypoint).openTooltip();
                marker.on('click', function() {
                    $('#' + customer.id).modal('show');
                    $('#customerName').text(customer.keypoint);
                });
            });
        });

        zones.forEach(function(padam) {
            var iconPadam = L.icon({
                iconUrl: '{{ asset('assets/img/lokasi_merah.png') }}',
                iconSize: [20, 20],
                iconAnchor: [20, 20],
            });
            var iconMenyala = L.icon({
                iconUrl: '{{ asset('assets/img/lokasi_hijau.png') }}',
                iconSize: [20, 20],
                iconAnchor: [20, 20],
            });
            if (padam.kategori === 'Trafo Trip') {
                var marker = L.marker([padam.latitude, padam.longitude], {
                    icon: iconPadam
                }).addTo(map);
            } else {
                var marker = L.marker([padam.latitude, padam.longitude], {
                    icon: iconMenyala
                }).addTo(map);
            }
            marker.bindTooltip(padam.keypoint).openTooltip();
            marker.on('click', function() {
                $('#' + padam.id).modal('show');
                $('#customerName').text(padam.keypoint);
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
            zones.forEach(function(customer) {
                if (customer.keypoint.toLowerCase().includes(searchTerm) && matchCount < 10) {
                    var listItem = document.createElement('li');
                    listItem.className = 'list-group-item';
                    listItem.textContent = customer.keypoint;
                    listItem.onclick = function() {
                        document.getElementById('searchInput').value = customer.keypoint;
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
            map.setView([customer.latitude, customer.longitude], 19);
            currentMarker.bindTooltip(customer.keypoint).openTooltip();
            currentMarker.on('click', function() {
                $('#' + customer.id).modal('show');
                $('#customerName').text(customer.keypoint);
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
