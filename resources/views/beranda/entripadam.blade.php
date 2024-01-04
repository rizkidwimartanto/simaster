@extends('layout/templateberanda')
@section('content')
    <div class="container-fluid mt-3">
        @if (session('success_import'))
            <div class="alert alert-success">
                {{ session('success_import') }}
            </div>
        @endif
        @if (session('error_import'))
            <div class="alert alert-danger">
                {{ session('error_import') }}
            </div>
        @endif
        <div class="col-lg-12">
            <div class="card p-3 mt-4">
                <form method="post" action="/entripadam/import_excel_penyulangsection" enctype="multipart/form-data">
                    @csrf
                    <div class="form-label"><b>Upload File Penyulang</b></div>
                    <input type="file" name="file_penyulang" class="form-control" required />
                    <div class="form-label mt-2"><b>Upload File Section</b></div>
                    <input type="file" name="file_section" class="form-control" required />
                    <button type="submit" class="btn btn-primary mt-3 mb-3 col-lg-2"><i class="fa-solid fa-upload fa-lg"
                            style="margin-right: 5px"></i>Import Excel</button>
                </form>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card p-3 mt-4">
                <h2>Form Entri Padam</h2>
                <form action="/entripadam/insertentripadam" method="post" id="entriPadamForm">
                    @csrf
                    <div class="mb-3">
                        <div class="form-label required">Penyulang</div>
                        <select class="form-select @error('penyulang') is-invalid @enderror" id="penyulang"
                            name="penyulang">
                            <option disabled selected>--- Pilih Penyulang ---</option>
                            @foreach ($data_penyulang->unique() as $penyulang)
                                <option value="{{ $penyulang }}">{{ $penyulang }}</option>
                            @endforeach
                        </select>
                        @error('penyulang')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div id="section-container" class="mb-3">
                        <div class="form-label required">Section</div>
                        <label class="form-check">
                            <div id="section-list">
                            </div>
                        </label>
                    </div>
                    <div class="mb-3">
                        <div class="form-label required">Penyebab Padam</div>
                        <select class="form-select @error('penyebab_padam') is-invalid @enderror" name="penyebab_padam"
                            id="penyebab_padam" style="display: none;">
                            <!-- Opsi akan ditambahkan melalui JavaScript -->
                        </select>
                        @error('penyebab_padam')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">Jam Padam</label>
                        <input type="datetime-local" class="form-control @error('jam_padam') is-invalid @enderror"
                            name="jam_padam" id="jam_padam" style="display: none;">
                        @error('jam_padam')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" data-bs-toggle="autosize" rows="5" name="keterangan" id="keterangan"
                            placeholder="Masukkan Keterangan" style="display: none;"></textarea>
                    </div>
                    <input type="hidden" name="status" id="status" value="Padam">
                    <div class="mb-3">
                        <a href="www.facebook.com" target="_blank">
                            <button type="submit" class="btn btn-success col-12"><i class="fa-solid fa-plus fa-lg"
                                    style="margin-right: 5px;"></i>Entri Padam</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Variabel untuk menyimpan state pilihan penyulang, penyebab padam, jam padam, dan keterangan
        var checkedSectionsState = {};
        var selectedPenyulangState = {};
        var penyebabPadamState = {};
        var jamPadamState = {};
        var keteranganState = {};

        document.getElementById('penyulang').addEventListener('change', function() {
            var sectionMapping = @json($section);
            var selectedPenyulang = this.value;
            var selectedSections = sectionMapping[selectedPenyulang] || [];
            var sectionContainer = document.getElementById('section-container');
            var sectionChecklist = document.getElementById('section-list');
            var penyebabPadamSelect = document.getElementById('penyebab_padam');
            var jamPadamInput = document.getElementById('jam_padam');
            var keteranganTextarea = document.getElementById('keterangan');

            // Membersihkan daftar section yang sebelumnya ditampilkan
            sectionChecklist.innerHTML = "";

            if (selectedSections.length > 0) {
                selectedSections.forEach(function(section) {
                    var checkbox = document.createElement("input");
                    checkbox.type = "checkbox";
                    checkbox.name = "section[]";
                    checkbox.value = section;
                    checkbox.classList.add("form-check-input");
                    // Memeriksa apakah section sebelumnya telah dicentang
                    if (checkedSectionsState[section]) {
                        checkbox.checked = true;
                    }

                    var label = document.createElement("span");
                    label.classList.add("form-check-label");
                    label.classList.add("mb-2");

                    var checkboxContainer = document.createElement("label");
                    checkboxContainer.classList.add("form-check");

                    label.appendChild(checkbox);
                    label.appendChild(document.createTextNode(section));
                    checkboxContainer.appendChild(label);
                    sectionChecklist.appendChild(checkboxContainer);
                });

                // Menampilkan daftar section
                sectionContainer.style.display = "block";
            } else {
                // Menyembunyikan daftar section jika tidak ada yang dipilih
                sectionContainer.style.display = "none";
            }

            // Memperbarui opsi "penyebab padam" tanpa menyembunyikan elemen
            updatePenyebabPadamOptions();
            // Mengembalikan nilai "penyebab padam", "jam padam", dan "keterangan" yang telah dipilih sebelumnya
            restoreFormState(selectedPenyulang);

            // Menampilkan atau menyembunyikan elemen formulir berdasarkan pilihan penyulang
            updateFormElementsVisibility(selectedPenyulang);
        });
        // Listener untuk menyimpan state checklist saat checkbox berubah
        document.addEventListener('change', function(event) {
            var checkbox = event.target;
            if (checkbox.type === 'checkbox' && checkbox.name === 'section[]') {
                var sectionName = checkbox.value;
                checkedSectionsState[sectionName] = checkbox.checked;
            }
        });
        document.getElementById('penyebab_padam').addEventListener('change', function() {
            // Menyimpan nilai "penyebab padam" yang dipilih
            penyebabPadamState[getCurrentPenyulang()] = this.value;
        });

        document.getElementById('jam_padam').addEventListener('change', function() {
            // Menyimpan nilai "jam padam" yang dipilih
            jamPadamState[getCurrentPenyulang()] = this.value;
        });

        document.getElementById('keterangan').addEventListener('input', function() {
            // Menyimpan nilai "keterangan" yang dimasukkan
            keteranganState[getCurrentPenyulang()] = this.value;
        });

        function updatePenyebabPadamOptions() {
            var penyebabPadamSelect = document.getElementById('penyebab_padam');
            penyebabPadamSelect.innerHTML = "";

            // Menambahkan opsi "penyebab padam"
            var options = ['Pemeliharaan', 'Gangguan'];
            options.forEach(function(option) {
                var optionElement = document.createElement("option");
                optionElement.value = option;
                optionElement.text = option;
                penyebabPadamSelect.appendChild(optionElement);
            });
        }

        function restoreFormState(selectedPenyulang) {
            // Mengembalikan nilai "penyebab padam", "jam padam", dan "keterangan" yang telah dipilih sebelumnya
            document.getElementById('penyebab_padam').value = penyebabPadamState[selectedPenyulang] || '';
            document.getElementById('jam_padam').value = jamPadamState[selectedPenyulang] || '';
            document.getElementById('keterangan').value = keteranganState[selectedPenyulang] || '';
        }

        function getCurrentPenyulang() {
            // Mendapatkan nilai penyulang yang saat ini dipilih
            return document.getElementById('penyulang').value;
        }

        function updateFormElementsVisibility(selectedPenyulang) {
            var penyebabPadam = document.getElementById('penyebab_padam');
            var jamPadam = document.getElementById('jam_padam');
            var keterangan = document.getElementById('keterangan');

            // Menampilkan elemen formulir jika penyulang dipilih
            penyebabPadam.style.display = "block";
            jamPadam.style.display = "block";
            keterangan.style.display = "block";
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    {{-- <script>
        $(document).ready(function() {
            $("#entriPadamForm").submit(function(event) {
                // Prevent the default form submission
                event.preventDefault();

                // Perform any necessary form validation here

                // Open Facebook link in a new tab
                window.open("https://app.whacenter.com/blast", "_blank");

                // Continue with form submission after a delay
                setTimeout(function() {
                    // Submit the form
                    $("#entriPadamForm").unbind('submit').submit();
                }, 1000); // Delay for 1 second (adjust as needed)
            });
        });
    </script> --}}
@endsection
