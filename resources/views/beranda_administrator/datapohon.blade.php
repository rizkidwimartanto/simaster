@extends('layout/templateberanda')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-around">
            <div class="mt-3 mb-3 search_customer">
                <div class="row g-2">
                    <div class="col">
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari pohon rabas..."
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
                @foreach ($datarayon->unique() as $rayon)
                    <option value="{{ $rayon }}">
                        @if ($rayon == 'DEMAK')
                            {{ $rayon = 'DEMAK' }}
                        @endif
                        @if ($rayon == 'TEGOWANU')
                            {{ $rayon = 'TEGOWANU' }}
                        @endif
                        @if ($rayon == 'PURWODADI')
                            {{ $rayon = 'PURWODADI' }}
                        @endif
                        @if ($rayon == 'WIROSARI')
                            {{ $rayon = 'WIROSARI' }}
                        @endif
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div id="map" onclick="click_map()"></div>
    @foreach ($datapohon as $pohon)
        <div class="modal modal-blur fade" id="{{ $pohon->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $pohon->perlu_rabas }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="detail_pelanggan">No Tiang Section : <b>{{ $pohon->tiang_section }}</b> </p>
                        <p class="detail_pelanggan">Google Maps : <a target="_blank"
                            href="https://www.google.com/maps?q={{ $pohon->latitude }}{{ $pohon->longitude }}"><b>https://www.google.com/maps?q={{ $pohon->latitude }}{{ $pohon->longitude }}</b></a>
                        </p>
                        <p class="detail_pelanggan">Rayon : <b>{{ $pohon->rayon }}</b> </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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

        var datapohon = @json($datapohon);
        $('#pilih_peta').change(function() {
            // Menghapus semua marker yang ada pada peta
            map.eachLayer(function(layer) {
                if (layer instanceof L.Marker) {
                    map.removeLayer(layer);
                }
            });

            // Mendapatkan unitulp yang dipilih
            var selectedRayon = $(this).val();

            // Filter data_peta berdasarkan unitulp yang dipilih
            var filteredDataPeta = datapohon.filter(function(pohon) {
                return pohon.rayon === selectedRayon;
            });

            // Membuat marker berdasarkan data yang telah difilter
            filteredDataPeta.forEach(function(pohon) {
                var iconpohon = L.icon({
                    iconUrl: 'assets/img/tree.png',
                    iconSize: [20, 20],
                    iconAnchor: [20, 20],
                });
                var marker = L.marker([
                    parseFloat(pohon.latitude.replace(',', '.')),
                    parseFloat(pohon.longitude.replace(',', '.'))
                ], {
                    icon: iconpohon
                }).addTo(map);

                marker.bindTooltip(pohon.perlu_rabas).openTooltip();
                marker.on('click', function() {
                    $('#' + pohon.id).modal('show');

                });
            });
        });
        datapohon.forEach(function(pohon) {
            var iconpohon = L.icon({
                iconUrl: 'assets/img/tree.png',
                iconSize: [20, 20],
                iconAnchor: [20, 20],
            });
            var marker = L.marker([
                parseFloat(pohon.latitude.replace(',', '.')),
                parseFloat(pohon.longitude.replace(',', '.'))
            ], {
                icon: iconpohon
            }).addTo(map);
            marker.bindTooltip(pohon.perlu_rabas).openTooltip();
            marker.on('click', function() {
                $('#' + pohon.id).modal('show');
            });
        });

        function showSuggestions() {
            var searchTerm = document.getElementById('searchInput').value.toLowerCase();
            var suggestionList = document.getElementById('suggestionList');
            var listGroup = suggestionList.querySelector('ul');
            listGroup.innerHTML = ''; // Kosongkan daftar setiap kali ada perubahan input

            var matchCount = 0; // Inisialisasi match counter
            datapohon.forEach(function(pohon) {
                if (pohon.perlu_rabas.toLowerCase().includes(searchTerm) && matchCount < 10) {
                    var listItem = document.createElement('li');
                    listItem.className = 'list-group-item';
                    listItem.textContent = pohon.perlu_rabas;
                    listItem.onclick = function() {
                        document.getElementById('searchInput').value = pohon.perlu_rabas;
                        listGroup.innerHTML = ''; // Sembunyikan daftar setelah memilih
                        suggestionList.style.display = 'none';
                        showMarker(pohon);
                    };
                    listGroup.appendChild(listItem);
                    matchCount++;
                }
            });

            // Tampilkan atau sembunyikan dropdown berdasarkan hasil
            suggestionList.style.display = listGroup.childElementCount > 0 ? 'block' : 'none';
        }

        function showMarker(pohon) {
            if (currentMarker) {
                map.removeLayer(currentMarker); // Hapus marker sebelumnya jika ada
            }
            currentMarker = L.marker([
                parseFloat(pohon.latitude.replace(',', '.')),
                parseFloat(pohon.longitude.replace(',', '.'))
            ], {
                icon: L.icon({
                    iconUrl: 'assets/img/tree.png',
                    iconSize: [20, 20],
                    iconAnchor: [20, 20],
                })
            }).addTo(map);

            map.setView([
                parseFloat(pohon.latitude.replace(',', '.')),
                parseFloat(pohon.longitude.replace(',', '.'))
            ], 19);

            currentMarker.bindTooltip(pohon.perlu_rabas).openTooltip();
            currentMarker.on('click', function() {
                $('#' + pohon.id).modal('show');
            });
        }

        function handleKeyPress(event) {
            if (event.keyCode === 13) {
                // Enter key pressed
                event.preventDefault(); // Mencegah submit form jika ada
                showSuggestions();
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

        // Sembunyikan dropdown ketika klik di luar elemen
        document.addEventListener('click', function(event) {
            var suggestionList = document.getElementById('suggestionList');
            if (event.target !== suggestionList && !suggestionList.contains(event.target)) {
                suggestionList.style.display = 'none';
            }
        });

        var currentMarker;
    </script>
@endsection
