@extends('layout/templateberanda')
@section('content')
    <div class="container">
        <div class="col-lg-12">
            <div class="card p-3 mt-4">
                <h2>Form Entri Padam</h2>
                <form action="/entripadam/insertentripadam" method="post">
                    @csrf
                    <div class="mb-3">
                        <div class="form-label">Penyulang</div>
                        <select class="form-select" id="penyulang" name="penyulang">
                            <option disabled selected>--- Pilih Penyulang ---</option>
                            <option value="KDS21">KDS21</option>
                            <option value="SYG14">SYG14</option>
                            <option value="SYG09">SYG09</option>
                        </select>
                    </div>
                    <div id="section-container" class="mb-3">
                        <div class="form-label">Section</div>
                        <label class="form-check">
                            <div id="section-list">

                            </div>
                        </label>
                    </div>
                    <div class="mb-3">
                        <div class="form-label">Penyebab Padam</div>
                        <select class="form-select" name="penyebab_padam" id="penyebab_padam">
                            <option disabled selected>--- Pilih Penyebab Padam ---</option>
                            <option value="Pemeliharaan">Pemeliharaan</option>
                            <option value="Gangguan">Gangguan</option>
                        </select>
                    </div>
                    <?php date_default_timezone_set('Asia/Jakarta'); ?>
                    <input type="hidden" name="jam_padam" id="jam_padam" value="{{date("d-m-Y h:i:sa")}}">
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
        var sectionKDS21 = ['52.KDS.F21.Z02.S06', '52.KDS.F03.Z02.S04', '52.KDS.F21.Z02.S03', '52.KDS.F21.Z02.S04'];
        var sectionSYG14 = ['52.SYG.F14.Z03.S04', '52.SYG.F14.Z03.S05'];

        document.getElementById('penyulang').addEventListener('change', function() {
            var selectedPenyulang = this.value;
            var sectionContainer = document.getElementById('section-container');
            var sectionChecklist = document.getElementById('section-list');

            sectionChecklist.innerHTML = "";

            if (selectedPenyulang === "KDS21") {
                sectionKDS21.forEach(function(section) {
                    var checkbox = document.createElement("input");
                    checkbox.type = "checkbox";
                    checkbox.name = "section[]";
                    checkbox.value = section;
                    checkbox.classList.add("form-check-input");
                    var label = document.createElement("span");
                    label.classList.add("form-check-label");
                    var checkboxContainer = document.createElement("label");
                    checkboxContainer.classList.add("form-check");
                    label.appendChild(checkbox);
                    label.appendChild(document.createTextNode(section));
                    sectionChecklist.appendChild(label);
                });
                sectionChecklist.appendChild(checkboxContainer);
            } else if (selectedPenyulang == 'SYG14') {
                sectionSYG14.forEach(function(section) {
                    var checkbox = document.createElement("input");
                    checkbox.type = "checkbox";
                    checkbox.name = "section[]";
                    checkbox.value = section;
                    checkbox.classList.add("form-check-input");
                    var label = document.createElement("span");
                    label.classList.add("form-check-label");
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
    <script>
        $("#simpan-button").click(function() {
            var selectedSections = [];

            // Mengambil semua checkbox yang dicentang
            $(".form-check-input:checked").each(function() {
                selectedSections.push($(this).val());
            });

            // Mengirim data menggunakan AJAX
            $.ajax({
                url: '/entripadam/insertentripadam',
                type: 'POST',
                data: {
                    section: selectedSections
                },
                success: function(response) {
                    console.log(response.message);
                    // Di sini Anda dapat menangani respons atau memberikan pesan sukses kepada pengguna
                },
                error: function() {
                    console.log('Terjadi kesalahan dalam pengiriman data.');
                    // Di sini Anda dapat menangani kesalahan jika terjadi
                }
            });
        });
    </script>
@endsection
