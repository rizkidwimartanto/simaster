@extends('layout/templateberanda')
@section('content')
    <div class="container">
        <div class="col-lg-12">
            <div class="card p-3 mt-4">
                <h2>Form Entri Padam</h2>
                <form action="" method="post">
                    <div class="mb-3">
                        <div class="form-label">Penyulang</div>
                        <select class="form-select">
                            <option disabled selected>--- Pilih Penyulang ---</option>
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="form-label">Section</div>
                        <select class="form-select">
                            <option disabled selected>--- Pilih Section ---</option>
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jam Padam</label>
                        <input type="time" class="form-control" name="example-text-input"
                            placeholder="Input placeholder">
                    </div>
                    <div class="mb-3">
                        <div class="form-label">Penyebab Padam</div>
                        <select class="form-select">
                            <option disabled selected>--- Pilih Penyebab Padam ---</option>
                            <option value="1">Pemeliharaan</option>
                            <option value="2">Gangguan</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
