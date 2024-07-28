@extends('layout/templateberanda_user')
@section('content')
    <div class="container mt-4">
        @error('latitude')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Anda belum klik lokasi saat ini</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        <div class="mb-4">
            <div class="d-grid gap-2">
                <button type="button" class="btn btn-primary" id="getLocation" style="height: 80px"><i
                        class="fa-solid fa-location-crosshairs fa-lg" style="margin-right: 5px;"></i> Klik Lokasi Saat
                    Ini</button>
            </div>
        </div>
        <form action="/input_pelanggan_app" method="post">
            @csrf
            <h1>Data Pelanggan</h1>
            <div class="mb-4">
                <label class="form-label">ID Pelanggan</label>
                <input class="form-control @error('id_pelanggan') is-invalid @enderror" name="id_pelanggan"
                    id="id_pelanggan" type="text" inputmode="numeric" pattern="[0-9]*">
                @error('id_pelanggan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Nama Pelanggan</label>
                <input class="form-control @error('nama_pelanggan') is-invalid @enderror" name="nama_pelanggan"
                    id="nama_pelanggan" type="text">
                @error('nama_pelanggan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Tarif</label>
                <select class="form-control @error('tarif') is-invalid @enderror" name="tarif" id="tarif">
                    <option selected disabled>--- Pilih Tarif ---</option>
                    <option value="R1">R1</option>
                    <option value="R1T">R1T</option>
                    <option value="R1M">R1M</option>
                    <option value="R1MT">R1MT</option>
                    <option value="R2">R2</option>
                    <option value="R2T">R2T</option>
                    <option value="R3">R3</option>
                    <option value="R3T">R3T</option>
                    <option value="B1">B1</option>
                    <option value="B1T">B1T</option>
                    <option value="S2">S2</option>
                    <option value="S2T">S2T</option>
                    <option value="P1">P1</option>
                    <option value="P1T">P1T</option>
                    <option value="P3">P3</option>
                    <option value="P3T">P3T</option>
                </select>
                @error('tarif')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Daya</label>
                <select class="form-control @error('daya') is-invalid @enderror" name="daya" id="daya">
                    <option selected disabled>--- Pilih Daya ---</option>
                </select>
                @error('daya')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Alamat</label>
                <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" cols="30"
                    rows="10"></textarea>
                @error('alamat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        {{-- <label class="form-label">Latitude</label> --}}
                        <input class="form-control" name="latitude" id="latitude"
                            type="hidden" readonly>
                    </div>
                    <div class="col-md-6">
                        {{-- <label class="form-label">Longitude</label> --}}
                        <input class="form-control" name="longitude"
                            id="longitude" type="hidden" readonly>
                    </div>
                </div>
            </div>
            <h1>Data APP</h1>
            <div class="mb-4">
                <label class="form-label">Jenis Meter</label>
                <select class="form-control @error('jenis_meter') is-invalid @enderror" name="jenis_meter" id="jenis_meter">
                    <option selected disabled>--- Pilih Jenis Meter ---</option>
                    <option value="Prabayar">Prabayar</option>
                    <option value="Pascabayar">Pascabayar</option>
                </select>
                @error('jenis_meter')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Merk Meter</label>
                <select class="form-control @error('merk_meter') is-invalid @enderror" name="merk_meter" id="merk_meter">
                    <option selected disabled>--- Pilih Merk Meter ---</option>
                    <option value="Actaris">Actaris</option>
                    <option value="Cannet">Cannet</option>
                    <option value="Conlog">Conlog</option>
                    <option value="Fuji">Fuji</option>
                    <option value="Hexing">Hexing</option>
                    <option value="Itron">Itron</option>
                    <option value="Landis">Landis</option>
                    <option value="Melcoinda">Melcoinda</option>
                    <option value="Prima">Prima</option>
                    <option value="Sanxing">Sanxing</option>
                    <option value="SmartMeter">SmartMeter</option>
                </select>
                @error('merk_meter')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Tahun Meter</label>
                <input class="form-control @error('tahun_meter') is-invalid @enderror" name="tahun_meter"
                    id="tahun_meter" type="text" inputmode="numeric" pattern="[0-9]*">
                @error('tahun_meter')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Nomor Meter</label>
                <input class="form-control @error('nomor_meter') is-invalid @enderror" name="nomor_meter"
                    id="nomor_meter" type="text" inputmode="numeric" pattern="[0-9]*">
                @error('nomor_meter')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Merk MCB</label>
                <select class="form-control @error('merk_mcb') is-invalid @enderror" name="merk_mcb" id="merk_mcb">
                    <option selected disabled>--- Pilih Merk MCB ---</option>
                    <option value="ABB ">ABB</option>
                    <option value="ABB ">ABBA</option>
                    <option value="ABB ">BROCO</option>
                    <option value="DAYA">DAYA</option>
                    <option value="ABB ">EMCO</option>
                    <option value="ELEKTRO">ELEKTRO</option>
                    <option value="HPL">HPL</option>
                    <option value="LG">LG</option>
                    <option value="MCCB / HAGER">MCCB / HAGER</option>
                    <option value="MELCO">MELCO</option>
                    <option value="MERLIN">MERLIN</option>
                    <option value="MERLIN GERIN">MERLIN GERIN</option>
                    <option value="OSAKI">OSAKI</option>
                    <option value="SCHNEIDER">SCHNEIDER</option>
                </select>
                @error('merk_mcb')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Ukuran MCB</label>
                <select class="form-control @error('ukuran_mcb') is-invalid @enderror" name="ukuran_mcb"
                    id="ukuran_mcb">
                    <option selected disabled>--- Pilih Ukuran MCB ---</option>
                    <option value="2">2</option>
                    <option value="4">4</option>
                    <option value="6">6</option>
                    <option value="10">10</option>
                    <option value="16">16</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                    <option value="35">35</option>
                    <option value="50">50</option>
                </select>
                @error('ukuran_mcb')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="form-label">NO Segel</label>
                <input class="form-control @error('no_segel') is-invalid @enderror" name="no_segel" id="no_segel"
                    type="text">
                @error('no_segel')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="form-label">NO Gardu</label>
                <input class="form-control @error('no_gardu') is-invalid @enderror" name="no_gardu" id="no_gardu"
                    type="text">
                @error('no_gardu')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Tarikan ke ......</label>
                <input class="form-control @error('sr_deret') is-invalid @enderror" name="sr_deret" id="sr_deret"
                    type="text" inputmode="numeric" pattern="[0-9]*">
                @error('sr_deret')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Catatan</label>
                <textarea class="form-control" name="catatan" id="catatan" cols="30" rows="10"></textarea>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success mb-4">Simpan</button>
            </div>
        </form>
    </div>
@endsection
