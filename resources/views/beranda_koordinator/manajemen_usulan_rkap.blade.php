@extends('layout.templateberanda_koordinator')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
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
    <div id="map_koordinator" style="position: relative;bottom: 68px;height: 90%;z-index: 0;" onclick="click_map()"></div>
    <!-- Loop untuk membuat modal -->
    @foreach ($data_usulan_rkap as $usulan_rkap)
        <div class="modal modal-blur fade" id="{{ $usulan_rkap->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $usulan_rkap->nama_petugas }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="detail_pelanggan">Nama Petugas : {{ $usulan_rkap->nama_petugas }} </p>
                        <p class="detail_pelanggan">No Telepon :
                            <a href="https://wa.me/{{ $usulan_rkap->nomor_hp }}?text=Halo." target="_blank">
                                {{ $usulan_rkap->nomor_hp }}
                            </a>
                        </p>
                        <p class="detail_pelanggan">Maps :
                            <a target="_blank"
                                href="https://www.google.com/maps?q={{ $usulan_rkap->latitude }},{{ $usulan_rkap->longitude }}">
                                <b>https://www.google.com/maps?q={{ $usulan_rkap->latitude }},{{ $usulan_rkap->longitude }}</b>
                            </a>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Tabel Data -->
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="bulanRKAP">Pilih Bulan:</label>
                <input type="month" id="bulanRKAP" class="form-control" placeholder="YYYY-MM">
            </div>
            <div class="col-md-2">
                <label>&nbsp;</label>
                <button id="filterAset" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>

        <div style="overflow-y: auto;">
            <h2>Data Manajemen Usulan RKAP</h2>
            <table class="table-bordered tabel-app mt-2 display" id="tabel-usulan-rkap">
                <thead class="text-light" style="background:linear-gradient(#134E5E, #71B280)">
                    <tr>
                        <th>Nama Petugas</th>
                        <th style="display: none">Created At</th>
                        <th>Nomor HP</th>
                        <th>Foto</th>
                        <th>Lokasi</th>
                        <th>Keterangan</th>
                        <th>Rencana Usulan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_usulan_rkap as $usulan_rkap)
                        <tr>
                            <td>{{ $usulan_rkap->nama_petugas }}</td>
                            <td style="display: none">{{ $usulan_rkap->created_at }}</td>
                            <td>{{ $usulan_rkap->nomor_hp }}</td>
                            <td>
                                @if ($usulan_rkap->foto)
                                    <img src="{{ asset('storage/' . $usulan_rkap->foto) }}" alt="Foto Petugas"
                                        style="width: 100px; height: auto; cursor: pointer;" data-bs-toggle="modal"
                                        data-bs-target="#imageModal"
                                        onclick="showImage('{{ asset('storage/' . $usulan_rkap->foto) }}')">
                                @else
                                    <span class="text-muted">Tidak ada foto</span>
                                @endif
                                <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="imageModalLabel">Foto Petugas</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img id="modalImage" src="" alt="Foto Petugas" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a target="_blank"
                                    href="https://www.google.com/maps?q={{ $usulan_rkap->latitude }},{{ $usulan_rkap->longitude }}">
                                    <b>https://www.google.com/maps?q={{ $usulan_rkap->latitude }},{{ $usulan_rkap->longitude }}</b>
                                </a>
                            </td>
                            <td>{{ $usulan_rkap->keterangan }}</td>
                            <td>{{ $usulan_rkap->usulan_rkap }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
        var data_usulan_rkap = @json($data_usulan_rkap);
        // Buat grup cluster
        var markers = L.markerClusterGroup();

        data_usulan_rkap.forEach(usulan_rkap => {
            if (usulan_rkap.latitude && usulan_rkap.longitude) {
                const iconusulan_rkap = L.icon({
                    iconUrl: '{{ asset('assets/img/lokasi_hijau.png') }}',
                    iconSize: [20, 20],
                    iconAnchor: [10, 10],
                });

                const marker = L.marker([usulan_rkap.latitude, usulan_rkap.longitude], {
                    icon: iconusulan_rkap
                });

                const tooltipContent = `
                    <b>Petugas:</b> ${usulan_rkap.nama_petugas}<br>
                `;

                marker.bindTooltip(tooltipContent).openTooltip();
                marker.on('click', () => $('#' + usulan_rkap.id).modal('show'));

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
            data_usulan_rkap.forEach(function(usulan_rkap) {
                if (usulan_rkap.nama_petugas.toLowerCase().includes(searchTerm) && matchCount < 10) {
                    const listItem = document.createElement('li');
                    listItem.className = 'list-group-item'; // Kelas untuk styling
                    listItem.textContent = usulan_rkap.nama_petugas; // Nama usulan_rkap ditampilkan
                    listItem.onclick = function() {
                        document.getElementById('searchInput').value = usulan_rkap
                            .nama_petugas; // Pilih nama usulan_rkap
                        listGroup.innerHTML = ''; // Kosongkan daftar saran
                        suggestionList.style.display = 'none'; // Sembunyikan daftar
                        showMarker(usulan_rkap); // Tampilkan marker
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
        function showMarker(usulan_rkap) {
            // Hapus marker sebelumnya jika ada
            if (currentMarker) {
                map.removeLayer(currentMarker);
            }

            // Buat marker baru dengan ikon dan tooltip
            const iconusulan_rkap = L.icon({
                iconUrl: '{{ asset('assets/img/lokasi_hijau.png') }}',
                iconSize: [20, 20],
                iconAnchor: [10, 10],
            });

            currentMarker = L.marker([usulan_rkap.latitude, usulan_rkap.longitude], {
                icon: iconusulan_rkap
            }).addTo(map);
            const tooltipContent = `
                <b>Petugas:</b> ${usulan_rkap.nama_petugas}<br>
            `;

            currentMarker.bindTooltip(tooltipContent).openTooltip();

            map.setView([usulan_rkap.latitude, usulan_rkap.longitude], 19);

            // Event untuk menampilkan modal saat marker diklik
            currentMarker.on('click', function() {
                $('#' + usulan_rkap.id).modal('show');
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
        $(document).ready(function() {
            // Inisialisasi DataTables
            let table = $('#tabel-usulan-rkap').DataTable({
                'pageLength': 5,
                'lengthMenu': [10, 20, 50, 100, 200, 500],
                "order": [
                    [0, "asc"]
                ],
                "columnDefs": [{
                    "targets": 1,
                    "visible": false
                }]
            });

            // Event Filter
            $('#filterAset').on('click', function() {
                let bulanRKAP = $('#bulanRKAP').val();
                if (bulanRKAP) {
                    table.draw();
                } else {
                    alert("Silakan pilih bulan.");
                }
            });

            // Custom Filter untuk Tanggal
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                let createdAt = data[1]; // Index kolom created_at
                let bulanRKAP = $('#bulanRKAP').val();

                if (bulanRKAP) {
                    let date = new Date(createdAt);
                    let start = new Date(bulanRKAP + "-01"); // Awal bulan yang dipilih
                    return date.getFullYear() === start.getFullYear() && date.getMonth() === start
                        .getMonth();
                }
                return true;
            });
        });
    </script>
    <script>
        function showImage(imageUrl) {
            document.getElementById('modalImage').src = imageUrl;
        }
    </script>
@endsection
