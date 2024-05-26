@extends('layout/templateberanda')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm border-0 rounded">
            <div class="card-header bg-info text-white text-center rounded-top">
                <h3 class="mb-0">Tambah WA Notif</h3>
            </div>
            <div class="card-body p-4">
                <form action="/updating/proses_tambah_wanotif" method="post">
                    @csrf
                    <div class="mb-4">
                        <div class="input-group input-group-flat">
                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-id-card fa-lg"></i></span>
                            <input class="form-control" name="idserial" id="idserial" type="text"
                                placeholder="Masukkan ID Serial">
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="input-group input-group-flat">
                            <span class="input-group-text" id="basic-addon1"><i
                                    class="fa-solid fa-id-card-clip fa-lg"></i></span>
                            <input class="form-control" name="idpel" id="idpel" type="text"
                                placeholder="Masukkan ID Pelanggan">
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="input-group input-group-flat">
                            <span class="input-group-text" id="basic-addon1"><i
                                    class="fa-solid fa-square-caret-down fa-lg"></i></span>
                            <select class="form-control" name="id_unit" id="id_unit">
                                <option selected disabled>--- Pilih ID Unit ---</option>
                                <option value="52551">52551</option>
                                <option value="52552">52552</option>
                                <option value="52553">52553</option>
                                <option value="52554">52554</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-block" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection