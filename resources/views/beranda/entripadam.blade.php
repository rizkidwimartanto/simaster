@extends('layout/templateberanda')
@section('content')
    <div class="container">
        <div class="col-lg-12">
            <div class="card p-3 mt-4">
                <h2>Form Entri Padam</h2>
                <form action="/entripadam/insertentripadam" method="post">
                    @csrf
                    <div class="mb-3">
                        <div class="form-label required">Penyulang</div>
                        <select class="form-select @error('penyulang') is-invalid @enderror" id="penyulang" name="penyulang">
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
                            id="penyebab_padam">
                            <option disabled selected>--- Pilih Penyebab Padam ---</option>
                            <option value="Pemeliharaan">Pemeliharaan</option>
                            <option value="Gangguan">Gangguan</option>
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
                            name="jam_padam" id="jam_padam">
                        @error('jam_padam')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" data-bs-toggle="autosize" rows="5" name="keterangan" id="keterangan"
                            placeholder="Masukkan Keterangan"></textarea>
                    </div>
                    <input type="hidden" name="status" id="status" value="1">
                    <div class="mb-3">
                        <button type="submit" class="btn btn-outline-success col-12">Entri Padam</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('penyulang').addEventListener('change', function() {
            var sectionMapping = @json($section);
            var selectedPenyulang = this.value;
            var selectedSections = sectionMapping[selectedPenyulang] || [];
            var sectionContainer = document.getElementById('section-container');
            var sectionChecklist = document.getElementById('section-list');

            sectionChecklist.innerHTML = "";

            if (selectedSections.length > 0) {
                selectedSections.forEach(function(section) {
                    var checkbox = document.createElement("input");
                    checkbox.type = "checkbox";
                    checkbox.name = "section[]";
                    checkbox.value = section;
                    checkbox.classList.add("form-check-input");
                    var label = document.createElement("span");
                    label.classList.add("form-check-label");
                    label.classList.add("mb-2");
                    var checkboxContainer = document.createElement("label");
                    checkboxContainer.classList.add("form-check");
                    label.appendChild(checkbox);
                    label.appendChild(document.createTextNode(section));
                    sectionChecklist.appendChild(label);
                });
                sectionChecklist.appendChild(checkboxContainer);
            } else {
                sectionContainer.style.display = "none";
            }
        })
    </script>
@endsection
