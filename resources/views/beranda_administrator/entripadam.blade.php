@extends('layout/templateberanda')
@section('content')
    <div class="container-fluid mt-3">
        @if (session('success_tambah'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h3> {{ session('success_tambah') }} (jika sudah melakukan semua entri, silahkan ke menu transaksi aktif)
                </h3>
            </div>
        @endif
        <div class="col-lg-12">
            <div class="card border border-info p-3 mt-4">
                <h2>Form Entri Padam </h2>
                <form action="/simaster/entripadam/insertentripadam" method="post" id="entriPadamForm">
                    @csrf
                    <div class="mb-3">
                        <div class="mb-3">
                            <div class="form-label required">Penyebab Padam</div>
                            <select class="form-select @error('penyebab_padam') is-invalid @enderror" name="penyebab_padam"
                                id="penyebab_padam">
                                <option disabled selected>--- Pilih Penyebab Padam ---</option>
                                <option value="Instalasi" {{ old('penyebab_padam') == 'Instalasi' ? 'selected' : '' }}>
                                    Instalasi</option>
                                <option value="Gangguan" {{ old('penyebab_padam') == 'Gangguan' ? 'selected' : '' }}>
                                    Gangguan
                                </option>
                            </select>
                            @error('penyebab_padam')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div id="pelangganInput" style="display:none;">
                            <label class="form-label required" for="nama_pelanggan">Pelanggan</label>
                            <select name="nama_pelanggan" id="nama_pelanggan"
                                class="form-select selectNamaPelanggan @error('nama_pelanggan') is-invalid @enderror"
                                style="width: 100%;">
                                <option disabled selected>--- Pilih Nama Pelanggan ---</option>
                                @foreach ($nama_pelanggan as $pelanggan)
                                    <option value="{{ $pelanggan }}"
                                        {{ old('nama_pelanggan') == $pelanggan ? 'selected' : '' }}>
                                        {{ $pelanggan }}</option>
                                @endforeach
                            </select>
                            @error('nama_pelanggan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div id="penyulangInput" style="display:none;">
                            <div class="form-label required">Penyulang</div>
                            <select class="selectPenyulang @error('penyulang') is-invalid @enderror" id="penyulang"
                                name="penyulang" style="width: 100%;">
                                <option disabled selected>--- Pilih Penyulang ---</option>
                                @foreach ($data_penyulang->unique() as $penyulang)
                                    <option value="{{ $penyulang }}"
                                        {{ old('penyulang') == $penyulang ? 'selected' : '' }}>
                                        {{ $penyulang }}
                                    </option>
                                @endforeach
                            </select>
                            @error('penyulang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div id="sectionInput" style="display:none;">
                        <div id="section-container" class="mb-3">
                            <div class="form-label required">Section</div>
                            <label class="form-check">
                                <div id="section-list">

                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Jam Padam</label>
                        <input type="datetime-local" class="form-control @error('jam_padam') is-invalid @enderror"
                            name="jam_padam" id="jam_padam" value="{{ old('jam_padam') }}">
                        @error('jam_padam')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Keterangan Padam</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" data-bs-toggle="autosize" rows="5"
                            name="keterangan" id="keterangan" placeholder="Masukkan Keterangan" required>{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <input type="hidden" name="status" id="status" value="Padam">
                    <input type="hidden" name="status_wa" id="status_wa" value="Sedang Mengirim">
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success col-12"><i class="fa-solid fa-plus fa-lg"
                                style="margin-right: 5px;"></i>Entri Padam</button>
                        <a href="/simaster/transaksiaktif" class="btn btn-info col-12 mt-3"><i class="fa-solid fa-arrow-right fa-lg"
                                style="margin-right: 5px;"></i>Menu Transaksi Aktif</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#penyulang').selectize({
                sortField: 'text'
            });
        });
    </script>
    <script>
        document.getElementById('penyebab_padam').addEventListener('change', function() {
            var selectedValue = this.value;
            var pelangganInput = document.getElementById('pelangganInput');
            var penyulangInput = document.getElementById('penyulangInput');
            var sectionInput = document.getElementById('sectionInput');
            if (selectedValue === 'Instalasi') {
                pelangganInput.style.display = 'block';
                penyulangInput.style.display = 'none';
                sectionInput.style.display = 'none';
            } else if (selectedValue === 'Gangguan') {
                pelangganInput.style.display = 'none';
                penyulangInput.style.display = 'block';
                sectionInput.style.display = 'block';
            } else {
                pelangganInput.style.display = 'none';
                penyulangInput.style.display = 'none';
                sectionInput.style.display = 'none';
            }
        });
    </script>
    <script>
        function displaySections(selectedPenyulang) {
            var sectionMapping = @json($section);
            var selectedSections = sectionMapping[selectedPenyulang] || [];
            var sectionContainer = document.getElementById('sectionInput');

            if (selectedSections.length > 0) {
                var sectionChecklist = document.getElementById('section-list');
                sectionChecklist.innerHTML = "";

                selectedSections.forEach(function(section) {
                    var checkbox = document.createElement("input");
                    checkbox.type = "checkbox";
                    checkbox.name = "section[]";
                    checkbox.value = section;
                    checkbox.classList.add("form-check-input");

                    var label = document.createElement("label");
                    label.classList.add("form-check-label");
                    label.classList.add("mb-2");
                    label.appendChild(document.createTextNode(section));

                    var checkboxContainer = document.createElement("div");
                    checkboxContainer.classList.add("form-check");
                    checkboxContainer.appendChild(checkbox);
                    checkboxContainer.appendChild(label);

                    sectionChecklist.appendChild(checkboxContainer);
                });

                sectionContainer.style.display = "block";
            } else {
                sectionContainer.style.display = "none";
            }
        }
    </script>
@endsection
