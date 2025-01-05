@extends('layout/templateberanda_koordinator')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-around">
            <div class="mt-3 mb-3 search_customer">
                <div class="row g-2">
                    <div class="col">
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari pasangan..."
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
    <div class="container-fluid">
        <div id="noticeContainer"></div>
    </div>
    @foreach ($data_pelanggan_app as $data)
        <div class="modal modal-blur fade" id="{{ $data->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $data->nama_pelanggan }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-lg-12">
                                <label class="form-label">Tanggal Pasang</label>
                                <div class="input-group input-group-flat">
                                    <input type="text" value="{{ $data->tanggal_pasang }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label class="form-label">ID Pelanggan</label>
                                <div class="input-group input-group-flat">
                                    <input type="text" value="{{ $data->id_pelanggan }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label class="form-label">Nama
                                    Pelanggan</label>
                                <div class="input-group input-group-flat">
                                    <input type="text" value="{{ $data->nama_pelanggan }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label class="form-label">Tarif</label>
                                <div class="input-group input-group-flat">
                                    <input type="text" value="{{ $data->tarif }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label class="form-label">Daya</label>
                                <div class="input-group input-group-flat">
                                    <input type="text" value="{{ $data->daya }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label class="form-label">Alamat</label>
                                <div class="input-group input-group-flat">
                                    <input type="text" value="{{ $data->alamat }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label class="form-label">Latitude</label>
                                <div class="input-group input-group-flat">
                                    <input type="text" value="{{ $data->latitude }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label class="form-label">Longitude</label>
                                <div class="input-group input-group-flat">
                                    <input type="text" value="{{ $data->longitude }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label class="form-label">Jenis Meter</label>
                                <div class="input-group input-group-flat">
                                    <input type="text" value="{{ $data->jenis_meter }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label class="form-label">Merk Meter</label>
                                <div class="input-group input-group-flat">
                                    <input type="text" value="{{ $data->merk_meter }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label class="form-label">Tahun Meter</label>
                                <div class="input-group input-group-flat">
                                    <input type="text" value="{{ $data->tahun_meter }}" class="form-control"
                                        readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label class="form-label">Nomor Meter</label>
                                <div class="input-group input-group-flat">
                                    <input type="text" value="{{ $data->nomor_meter }}" class="form-control"
                                        readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label class="form-label">Merk MCB</label>
                                <div class="input-group input-group-flat">
                                    <input type="text" value="{{ $data->merk_mcb }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label class="form-label">Nomor Segel</label>
                                <div class="input-group input-group-flat">
                                    <input type="text" value="{{ $data->no_segel }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label class="form-label">Nomor Gardu</label>
                                <div class="input-group input-group-flat">
                                    <input type="text" value="{{ $data->no_gardu }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label class="form-label">Tarikan SR ke</label>
                                <div class="input-group input-group-flat">
                                    <input type="text" value="{{ $data->sr_deret }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label class="form-label">Catatan</label>
                                <div class="input-group input-group-flat">
                                    <input type="text" value="{{ $data->catatan }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label class="form-label">Nama Petugas</label>
                                <div class="input-group input-group-flat">
                                    <input type="text" value="{{ $data->nama_petugas }}" class="form-control"
                                        readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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
        var data_pelanggan_app = @json($data_pelanggan_app);
        // Buat grup cluster
        var markers = L.markerClusterGroup();

        data_pelanggan_app.forEach(pelangganapp => {
            if (pelangganapp.latitude && pelangganapp.longitude) {
                const iconpelangganapp = L.icon({
                    iconUrl: '{{ asset('public/assets/img/lokasi_hijau.png') }}',
                    iconSize: [20, 20],
                    iconAnchor: [10, 10],
                });

                const marker = L.marker([pelangganapp.latitude, pelangganapp.longitude], {
                    icon: iconpelangganapp
                });

                const tooltipContent = `
                    <b>Pelanggan:</b> ${pelangganapp.nama_pelanggan}<br>
                    <b>Petugas:</b> ${pelangganapp.nama_petugas}<br>
                    <b>Alamat:</b> ${pelangganapp.alamat}
                `;

                marker.bindTooltip(tooltipContent).openTooltip();
                marker.on('click', () => $('#' + pelangganapp.id).modal('show'));

                // Tambahkan marker ke grup cluster
                markers.addLayer(marker);
            }
        });

        // Tambahkan grup cluster ke peta
        map.addLayer(markers);

        var currentMarker;

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

        // Filter pelanggan berdasarkan input pencarian
        function showSuggestions() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase(); // Ambil nilai input
            const suggestionList = document.getElementById('suggestionList'); // Elemen dropdown untuk saran
            const listGroup = suggestionList.querySelector('ul');
            listGroup.innerHTML = ''; // Kosongkan daftar saran

            let matchCount = 0;

            // Loop data pelanggan
            data_pelanggan_app.forEach(function(pelanggan) {
                if (pelanggan.nama_pelanggan.toLowerCase().includes(searchTerm) && matchCount < 10) {
                    const listItem = document.createElement('li');
                    listItem.className = 'list-group-item'; // Kelas untuk styling
                    listItem.textContent = pelanggan.nama_pelanggan; // Nama pelanggan ditampilkan
                    listItem.onclick = function() {
                        document.getElementById('searchInput').value = pelanggan
                            .nama_pelanggan; // Pilih nama pelanggan
                        listGroup.innerHTML = ''; // Kosongkan daftar saran
                        suggestionList.style.display = 'none'; // Sembunyikan daftar
                        showMarker(pelanggan); // Tampilkan marker
                    };

                    listGroup.appendChild(listItem); // Tambahkan item ke daftar
                    matchCount++;
                }
            });

            // Tampilkan atau sembunyikan dropdown berdasarkan hasil pencarian
            if (listGroup.childElementCount > 0) {
                suggestionList.style.display = 'block';
            } else {
                suggestionList.style.display = 'none';
            }
        }

        // Tampilkan marker pelanggan di peta
        function showMarker(pelanggan) {
            // Hapus marker sebelumnya jika ada
            if (currentMarker) {
                map.removeLayer(currentMarker);
            }

            // Buat marker baru dengan ikon dan tooltip
            const iconpelanggan = L.icon({
                iconUrl: '{{ asset('public/assets/img/lokasi_hijau.png') }}',
                iconSize: [20, 20],
                iconAnchor: [10, 10],
            });

            currentMarker = L.marker([pelanggan.latitude, pelanggan.longitude], {
                icon: iconpelanggan
            }).addTo(map);
            const tooltipContent = `
                <b>Pelanggan:</b> ${pelanggan.nama_pelanggan}<br>
                <b>Petugas:</b> ${pelanggan.nama_petugas}<br>
                <b>Alamat:</b> ${pelanggan.alamat}
            `;

            currentMarker.bindTooltip(tooltipContent).openTooltip();

            map.setView([pelanggan.latitude, pelanggan.longitude], 19);

            // Event untuk menampilkan modal saat marker diklik
            currentMarker.on('click', function() {
                $('#' + pelanggan.id).modal('show');
            });
        }

        document.addEventListener('click', function(event) {
            const suggestionList = document.getElementById('suggestionList');
            if (event.target !== suggestionList && !suggestionList.contains(event.target)) {
                suggestionList.style.display = 'none';
            }
        });
    </script>
    <script>
        function calculateDistance(lat1, lon1, lat2, lon2) {
            const R = 6371e3; // Radius bumi dalam meter
            const toRadians = (degree) => (degree * Math.PI) / 180;

            const φ1 = toRadians(lat1);
            const φ2 = toRadians(lat2);
            const Δφ = toRadians(lat2 - lat1);
            const Δλ = toRadians(lon2 - lon1);

            const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
                Math.cos(φ1) * Math.cos(φ2) *
                Math.sin(Δλ / 2) * Math.sin(Δλ / 2);

            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

            return R * c; // Jarak dalam meter
        }

        function checkProximityLessThan5Meters(data_pelanggan_app) {
            for (let i = 0; i < data_pelanggan_app.length; i++) {
                for (let j = i + 1; j < data_pelanggan_app.length; j++) {
                    const pelanggan1 = data_pelanggan_app[i];
                    const pelanggan2 = data_pelanggan_app[j];

                    const distance = calculateDistance(
                        pelanggan1.latitude, pelanggan1.longitude,
                        pelanggan2.latitude, pelanggan2.longitude
                    );

                    if (distance < 5) {
                        console.warn(
                            `Warning: Pelanggan ${pelanggan1.nama_pelanggan} dan ${pelanggan2.nama_pelanggan} memiliki jarak kurang dari 5 meter (${distance.toFixed(2)} m).`
                        );
                    }
                }
            }
        }

        // Panggil fungsi
        checkProximityLessThan5Meters(data_pelanggan_app);

        function displayNotice(message, pelanggan1, pelanggan2) {
            const noticeContainer = document.getElementById('noticeContainer');
            if (noticeContainer) {
                const noticeElement = document.createElement('div');
                noticeElement.className = 'alert alert-danger alert-dismissible fade show';
                noticeElement.setAttribute('role', 'alert');

                // Konten notifikasi
                noticeElement.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;

                // Tambahkan event listener untuk klik notifikasi
                noticeElement.addEventListener('click', () => {
                    showMarker(pelanggan1);
                    showMarker(pelanggan2);

                    // Scroll ke map koordinator
                    const mapKoordinator = document.getElementById('map_koordinator');
                    if (mapKoordinator) {
                        mapKoordinator.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }
                });

                // Tambahkan notifikasi ke container
                noticeContainer.appendChild(noticeElement);
            }
        }

        function checkProximityWithUI(data_pelanggan_app) {
            for (let i = 0; i < data_pelanggan_app.length; i++) {
                for (let j = i + 1; j < data_pelanggan_app.length; j++) {
                    const pelanggan1 = data_pelanggan_app[i];
                    const pelanggan2 = data_pelanggan_app[j];

                    const distance = calculateDistance(
                        pelanggan1.latitude, pelanggan1.longitude,
                        pelanggan2.latitude, pelanggan2.longitude
                    );

                    if (distance < 10) {
                        const message =
                            `Warning: Pelanggan ${pelanggan1.nama_pelanggan} dan ${pelanggan2.nama_pelanggan} memiliki jarak kurang dari 10 meter (${distance.toFixed(2)} m).`;
                        displayNotice(message, pelanggan1, pelanggan2);
                    }
                }
            }
        }

        // Panggil fungsi
        checkProximityWithUI(data_pelanggan_app);
    </script>
@endsection
