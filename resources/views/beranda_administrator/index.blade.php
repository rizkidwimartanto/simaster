@extends('layout/templateberanda')
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
            <select class="form-select pilih_peta" id="pilih_peta" name="pilih_peta">
                <option disabled selected>--- Pilih Area Unit ---</option>
                @foreach ($data_unitulp->unique() as $data)
                    <option value="{{ $data }}">
                        @if ($data == '52551')
                            {{ $data = 'Demak' }}
                        @endif
                        @if ($data == '52552')
                            {{ $data = 'Tegowanu' }}
                        @endif
                        @if ($data == '52553')
                            {{ $data = 'Purwodadi' }}
                        @endif
                        @if ($data == '52554')
                            {{ $data = 'Wirosari' }}
                        @endif
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div id="map" onclick="click_map()"></div>
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
        // Menangani perubahan pada elemen select
        $('#pilih_peta').change(function() {
            // Menghapus semua marker yang ada pada peta
            map.eachLayer(function(layer) {
                if (layer instanceof L.Marker) {
                    map.removeLayer(layer);
                }
            });

            var selectedUnitulp = $(this).val();

            var filteredDataPeta = data_peta.filter(function(customer) {
                return customer.unitulp === selectedUnitulp;
            });

            filteredDataPeta.forEach(function(customer) {
                var iconPadam = L.icon({
                    iconUrl: '{{ asset('public/assets/img/tree.png') }}',
                    iconSize: [20, 20],
                    iconAnchor: [20, 20],
                });
                var iconMenyala = L.icon({
                    iconUrl: '{{ asset('public/assets/img/lokasi_merah.png') }}',
                    iconSize: [20, 20],
                    iconAnchor: [20, 20],
                });
                if (data_padam.some(padam => padam.section === customer.nama_section && padam.status ===
                        'Padam')) {
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
        });

        data_peta.forEach(function(customer) {
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

        function hapusPencarian() {
            document.getElementById('searchInput').value = "";
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
            var matchCount = 0;
            listGroup.innerHTML = '';

            data_peta.forEach(function(customer) {
                if (customer.nama.toLowerCase().includes(searchTerm) && matchCount < 10) {
                    var listItem = document.createElement('li');
                    listItem.className = 'list-group-item';
                    listItem.textContent = customer.nama;
                    listItem.onclick = function() {
                        document.getElementById('searchInput').value = customer.nama;
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
