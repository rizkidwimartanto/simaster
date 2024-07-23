@extends('layout/templateberanda_user')
@section('content')
    <div class="container mt-4">
        <form action="/updating/proses_tambah_wanotif" method="post">
            @csrf
            <div class="mb-4">
                <label class="form-label">ID Pelanggan</label>
                <div class="input-group input-group-flat">
                    <input class="form-control" name="idpel" id="idpel" type="text" inputmode="numeric"
                        pattern="[0-9]*">
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Nama Pelanggan</label>
                <div class="input-group input-group-flat">
                    <input class="form-control" name="idpel" id="idpel" type="text" inputmode="numeric"
                        pattern="[0-9]*">
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Tarif</label>
                <div class="input-group input-group-flat">
                    <select class="form-control" name="idunit" id="idunit">
                        <option selected disabled>--- Pilih Tarif ---</option>
                        <option value="52551">52551</option>
                        <option value="52552">52552</option>
                        <option value="52553">52553</option>
                        <option value="52554">52554</option>
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Daya</label>
                <div class="input-group input-group-flat">
                    <select class="form-control" name="idunit" id="idunit">
                        <option selected disabled>--- Pilih Daya ---</option>
                        <option value="52551">52551</option>
                        <option value="52552">52552</option>
                        <option value="52553">52553</option>
                        <option value="52554">52554</option>
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Alamat</label>
                <div class="input-group input-group-flat">
                    <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Titik Koordinat</label>
                <div class="input-group input-group-flat">
                    <input class="form-control" name="idpel" id="idpel" type="text">
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Jenis Meter</label>
                <div class="input-group input-group-flat">
                    <select class="form-control" name="idunit" id="idunit">
                        <option selected disabled>--- Pilih Jenis Meter ---</option>
                        <option value="52551">52551</option>
                        <option value="52552">52552</option>
                        <option value="52553">52553</option>
                        <option value="52554">52554</option>
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Merk Meter</label>
                <div class="input-group input-group-flat">
                    <select class="form-control" name="idunit" id="idunit">
                        <option selected disabled>--- Pilih Merk Meter ---</option>
                        <option value="52551">52551</option>
                        <option value="52552">52552</option>
                        <option value="52553">52553</option>
                        <option value="52554">52554</option>
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Tahun Meter</label>
                <div class="input-group input-group-flat">
                    <select class="form-control" name="idunit" id="idunit">
                        <option selected disabled>--- Pilih Tahun Meter ---</option>
                        <option value="52551">52551</option>
                        <option value="52552">52552</option>
                        <option value="52553">52553</option>
                        <option value="52554">52554</option>
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Merk MCB</label>
                <div class="input-group input-group-flat">
                    <select class="form-control" name="idunit" id="idunit">
                        <option selected disabled>--- Pilih Merk MCB ---</option>
                        <option value="52551">52551</option>
                        <option value="52552">52552</option>
                        <option value="52553">52553</option>
                        <option value="52554">52554</option>
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Ukuran MCB</label>
                <div class="input-group input-group-flat">
                    <select class="form-control" name="idunit" id="idunit">
                        <option selected disabled>--- Pilih Ukuran MCB ---</option>
                        <option value="52551">52551</option>
                        <option value="52552">52552</option>
                        <option value="52553">52553</option>
                        <option value="52554">52554</option>
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">NO Segel</label>
                <div class="input-group input-group-flat">
                    <input class="form-control" name="idpel" id="idpel" type="text">
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">NO Gardu</label>
                <div class="input-group input-group-flat">
                    <input class="form-control" name="idpel" id="idpel" type="text">
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">SR Deret ke</label>
                <div class="input-group input-group-flat">
                    <select class="form-control" name="idunit" id="idunit">
                        <option selected disabled>--- Pilih SR Deret ke ---</option>
                        <option value="52551">52551</option>
                        <option value="52552">52552</option>
                        <option value="52553">52553</option>
                        <option value="52554">52554</option>
                    </select>
                </div>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary mb-4">Save changes</button>
            </div>
        </form>
    </div>
@endsection
