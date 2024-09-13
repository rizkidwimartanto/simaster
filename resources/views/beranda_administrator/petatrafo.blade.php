@extends('layout/templateberanda')
@section('content')
    <div class="container">
        {{-- <button id="deletePolylines" class="btn btn-danger">Hapus Semua Garis</button> --}}
        <div class="modal fade" id="deleteGarisModal" tabindex="-1" aria-labelledby="deleteGarisModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteGarisModalLabel">Hapus Garis</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus garis ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" id="deletePolylineBtn">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <!-- Button trigger modal -->
            <button class="btn btn-primary" type="button" id="tambah_garis" data-bs-toggle="modal"
                data-bs-target="#exampleModal">Tambah Garis</button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title" id="exampleModalLabel">Tambah Garis</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Point A</label>
                            <select name="pointA" id="pointA" class="form-select mb-4">
                                @foreach ($data_trafo as $trafo)
                                    <option value="{{ $trafo->latitude }},{{ $trafo->longtitude }}">{{ $trafo->no_tiang }}
                                    </option>
                                @endforeach
                            </select>
                            <label class="form-label">Point B</label>
                            <select name="pointB" id="pointB" class="form-select">
                                @foreach ($data_trafo as $trafo)
                                    <option value="{{ $trafo->latitude }},{{ $trafo->longtitude }}">{{ $trafo->no_tiang }}
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
        </div>
        <div class="d-flex justify-content-around" style="margin-top: 10px">
            <div class="mt-3 mb-3 search_customer">
                <div class="row g-2">
                    <div class="col">
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari pemyulang..."
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
        <div class="modal modal-blur fade" id="{{ $trafo->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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

        var polylines = []; // Array untuk menyimpan semua polyline yang ditambahkan
        var selectedPolyline = null; // Variabel untuk menyimpan polyline yang dipilih untuk dihapus

        // Fungsi untuk menggambar garis antara Point A dan Point B
        function drawLine(pointA, pointB, color) {
            // Gambar polyline baru antara point A dan point B dengan warna yang dipilih
            var polyline = L.polyline([pointA, pointB], {
                color: color
            }).addTo(map);
            var distance = calculateDistance(pointA, pointB);

            // Tampilkan jarak di tooltip pada polyline
            polyline.bindTooltip(distance.toFixed(2) + ' kilometer').openTooltip();

            // Tambahkan event listener untuk polyline
            polyline.on('click', function() {
                selectedPolyline = polyline; // Simpan polyline yang dipilih
                $('#deleteGarisModal').modal('show'); // Tampilkan modal saat polyline diklik
            });

            // Simpan polyline ke dalam array untuk referensi
            polylines.push(polyline);

            // Simpan polyline (koordinat dan warna) ke localStorage
            saveToLocalStorage(pointA, pointB, color);

            // Zoom agar peta menampilkan keseluruhan garis
            map.fitBounds(polyline.getBounds());
        }

        // Fungsi untuk menghitung jarak antara dua titik
        function calculateDistance(pointA, pointB) {
            // Buat LatLng untuk kedua titik
            var latlngA = L.latLng(pointA[0], pointA[1]);
            var latlngB = L.latLng(pointB[0], pointB[1]);

            // Gunakan distanceTo untuk menghitung jarak dalam meter
            var distanceInMeters = latlngA.distanceTo(latlngB);

            // Konversi ke kilometer
            var distanceInKilometers = distanceInMeters / 1000;

            // Kembalikan jarak dalam kilometer
            return distanceInKilometers; // Jarak dalam kilometer
        }
        // Fungsi untuk menyimpan polyline (koordinat dan warna) ke localStorage
        function saveToLocalStorage(pointA, pointB, color) {
            var storedPolylines = JSON.parse(localStorage.getItem('polylines')) || [];
            storedPolylines.push({
                pointA: pointA,
                pointB: pointB,
                color: color
            });
            localStorage.setItem('polylines', JSON.stringify(storedPolylines));
        }

        // Fungsi untuk menggambar ulang polyline dari localStorage ketika halaman dimuat
        function loadFromLocalStorage() {
            var storedPolylines = JSON.parse(localStorage.getItem('polylines')) || [];
            storedPolylines.forEach(function(line) {
                var pointA = line.pointA;
                var pointB = line.pointB;
                var color = line.color || 'blue';
                var polyline = L.polyline([pointA, pointB], {
                    color: color
                }).addTo(map);

                // Tambahkan event listener untuk polyline yang dimuat
                polyline.on('click', function() {
                    selectedPolyline = polyline; // Simpan polyline yang dipilih
                    $('#deleteGarisModal').modal('show'); // Tampilkan modal saat polyline diklik
                });
                var distance = calculateDistance(pointA, pointB);

                // Tampilkan jarak di tooltip
                polyline.bindTooltip(distance.toFixed(2) + ' kilometer').openTooltip();
                polylines.push(polyline);
            });
        }

        // Fungsi untuk menghapus polyline yang dipilih
        function deleteSelectedPolyline() {
            if (selectedPolyline) {
                map.removeLayer(selectedPolyline); // Hapus polyline dari peta

                // Hapus polyline dari array
                polylines = polylines.filter(function(polyline) {
                    return polyline !== selectedPolyline;
                });

                // Perbarui localStorage untuk menghapus polyline yang dipilih
                var storedPolylines = JSON.parse(localStorage.getItem('polylines')) || [];
                storedPolylines = storedPolylines.filter(function(line) {
                    return !(L.latLng(line.pointA).equals(selectedPolyline.getLatLngs()[0]) &&
                        L.latLng(line.pointB).equals(selectedPolyline.getLatLngs()[1]));
                });
                localStorage.setItem('polylines', JSON.stringify(storedPolylines));

                selectedPolyline = null; // Reset polyline yang dipilih
                $('#deleteGarisModal').modal('hide'); // Sembunyikan modal
            }
        }

        // Panggil loadFromLocalStorage saat halaman dimuat
        loadFromLocalStorage();

        // Event listener untuk tombol "Save changes"
        document.getElementById('saveChanges').addEventListener('click', function() {
            var pointA = document.getElementById('pointA').value.split(',');
            var pointB = document.getElementById('pointB').value.split(',');
            pointA = [parseFloat(pointA[0]), parseFloat(pointA[1])];
            pointB = [parseFloat(pointB[0]), parseFloat(pointB[1])];
            var color = document.getElementById('polylineColor').value;
            drawLine(pointA, pointB, color);
        });

        // Event listener untuk tombol "Hapus" di modal
        document.getElementById('deletePolylineBtn').addEventListener('click', function() {
            deleteSelectedPolyline(); // Hapus polyline yang dipilih
        });


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
                    iconUrl: 'assets/img/lokasi_merah.png',
                    iconSize: [20, 20],
                    iconAnchor: [20, 20],
                });
                var iconMenyala = L.icon({
                    iconUrl: 'assets/img/lokasi_hijau.png',
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
                iconUrl: 'assets/img/lokasi_merah.png',
                iconSize: [20, 20],
                iconAnchor: [20, 20],
            });
            var iconMenyala = L.icon({
                iconUrl: 'assets/img/lokasi_hijau.png',
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
                if (customer.penyulang.toLowerCase().includes(searchTerm) && matchCount < 6) {
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
