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
                            <option value="A Penyulang">A</option>
                            <option value="B Penyulang">B</option>
                            <option value="C Penyulang">C</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="form-label">Section</div>
                        <select class="form-select" id="section" name="section">
                            <option disabled selected value="">--- Pilih Section ---</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jam Padam</label>
                        <input type="time" class="form-control" name="jam_padam"
                            placeholder="Input placeholder">
                    </div>
                    <div class="mb-3">
                        <div class="form-label">Penyebab Padam</div>
                        <select class="form-select" name="jam_padam" id="jam_padam">
                            <option disabled selected>--- Pilih Penyebab Padam ---</option>
                            <option value="1">Pemeliharaan</option>
                            <option value="2">Gangguan</option>
                        </select>
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
        var sectionA = ['A1 Penyulang', 'A2 Penyulang', 'A3 Penyulang'];

        document.getElementById('penyulang').addEventListener('change', function(){
            var selectedPenyulang = this.value;
            var sectionDropdown = document.getElementById('section'); 

            sectionDropdown.innerHTML = "<option value='' disabled>--- Pilih Section ---</option>";

            if(selectedPenyulang === 'A Penyulang'){
                sectionA.forEach(function(section){
                    var option = document.createElement('option');
                    option.value = section;
                    option.textContent = section;
                    sectionDropdown.appendChild(option);
                })
            }
        })
    </script>
@endsection
