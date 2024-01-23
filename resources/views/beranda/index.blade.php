@extends('layout/templateberanda')
@section('content')
    <div class="container">
        <div class="mt-3 mb-3 search_customer">
            <div class="row g-2">
                <div class="col">
                    <input type="text" class="form-control" id="searchInput" placeholder="Cari customer..."
                        onkeypress="handleKeyPress(event)" oninput="showSuggestions()">
                    <div id="suggestionList" class="dropdown">
                        <ul class="list-group"></ul>
                    </div>
                </div>
                <div class="col-auto">
                    <button href="#" onclick="searchCustomer()" class="btn btn-icon" aria-label="Button">
                        <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                            <path d="M21 21l-6 -6" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="map"></div>
    @foreach ($data_peta as $data)
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
                            <a href="https://wa.me/{{ $data->nohp_stakeholder }}?text=Halo." target="_blank">
                                {{ $data->nohp_stakeholder }}
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

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 25,
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

        var data_peta = @json($data_peta);
        var data_padam = @json($data_padam);

        data_peta.forEach(function(customer) {
            var iconPadam = L.icon({
                iconUrl: 'assets/img/lokasi_merah.png',
                iconSize: [40, 40],
                iconAnchor: [40, 40],
            });
            var iconMenyala = L.icon({
                iconUrl: 'assets/img/lokasi_hijau.png',
                iconSize: [40, 40],
                iconAnchor: [40, 40],
            });
            if (data_padam.some(padam => padam.section === customer.nama_section && padam.status === 'Padam')) {
                var marker = L.marker([customer.latitude, customer.longtitude], {
                    icon: iconPadam
                }).addTo(map);
            } else {
                var marker = L.marker([customer.latitude, customer.longtitude], {
                    icon: iconMenyala
                }).addTo(map);
            }

            marker.bindTooltip(customer.nama).openTooltip();

            marker.on('click', function() {
                $('#' + customer.id).modal('show');
                $('#customerName').text(customer.nama);
                $('#customerDetails').text('Alamat: ' + customer.alamat);
            });
        });

        function handleKeyPress(event) {
            if (event.keyCode === 13) {
                searchCustomer();
            }
        }

        function searchCustomer() {
            var searchTerm = document.getElementById('searchInput').value.toLowerCase();
            data_peta.forEach(function(customer) {
                if (customer.nama.toLowerCase() === searchTerm) {
                    showMarker(customer);
                    return;
                }
            });
        }

        function showSuggestions() {
            var searchTerm = document.getElementById('searchInput').value.toLowerCase();
            var suggestionList = document.getElementById('suggestionList');
            var listGroup = suggestionList.querySelector('ul');
            listGroup.innerHTML = ''; // Kosongkan daftar setiap kali ada perubahan input

            data_peta.forEach(function(customer) {
                if (customer.nama.toLowerCase().includes(searchTerm)) {
                    var listItem = document.createElement('li');
                    listItem.className = 'list-group-item';
                    listItem.textContent = customer.nama;
                    listItem.onclick = function() {
                        document.getElementById('searchInput').value = customer.nama;
                        listGroup.innerHTML = ''; // Sembunyikan daftar setelah memilih
                        showMarker(customer);
                    };
                    listGroup.appendChild(listItem);
                }
            });

            if (listGroup.childElementCount > 0) {
                suggestionList.style.display = 'block'; // Tampilkan daftar jika ada pilihan
            } else {
                suggestionList.style.display = 'none'; // Sembunyikan daftar jika tidak ada pilihan
            }
        }

        function showMarker(customer) {
            if (currentMarker) {
                map.removeLayer(currentMarker);
            }
            map.setView([customer.latitude, customer.longtitude], 19);
            currentMarker.bindTooltip(customer.nama).openTooltip();
            currentMarker.on('click', function() {
                $('#' + customer.id).modal('show');
                $('#customerName').text(customer.nama);
                $('#customerDetails').text('Alamat: ' + customer.alamat);
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
