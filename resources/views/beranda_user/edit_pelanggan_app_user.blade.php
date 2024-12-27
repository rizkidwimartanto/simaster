@extends('layout/templateberanda_user')
@section('content')
    <div class="container-fluid" style="margin-top: 80px;" id="container-pelanggan-app">
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
        <div class="card shadow-lg border-0 rounded">
            <div class="card-header bg-info text-white text-center rounded-top">
                <h3 class="mb-0">Entri Pelanggan APP</h3>
            </div>
            <div class="card-body p-4">
                <form action="/simaster/proses_edit_pelanggan_app_user/{{ $pelanggan->id }}" method="post">
                    @csrf
                    <div class="col-md-6">
                        {{-- <label class="form-label">Latitude</label> --}}
                        <input class="form-control" name="latitude" id="latitude" type="hidden"
                            value="{{ $pelanggan->latitude }}" readonly>
                    </div>
                    <div class="col-md-6">
                        {{-- <label class="form-label">Longitude</label> --}}
                        <input class="form-control" name="longitude" id="longitude" type="hidden"
                            value="{{ $pelanggan->longitude }}" readonly>
                    </div>
                    <h1>Data APP</h1>
                    <div class="mb-4">
                        <label class="form-label">Jenis Meter</label>
                        <select class="form-control @error('jenis_meter') is-invalid @enderror" name="jenis_meter"
                            id="jenis_meter">
                            <option value="" disabled selected>--- Pilih Jenis Meter ---</option>
                            <option value="Prabayar"
                                {{ old('jenis_meter', $pelanggan->jenis_meter) == 'Prabayar' ? 'selected' : '' }}>
                                Prabayar
                            </option>
                            <option value="Pascabayar"
                                {{ old('jenis_meter', $pelanggan->jenis_meter) == 'Pascabayar' ? 'selected' : '' }}>
                                Pascabayar
                            </option>
                        </select>
                        @error('jenis_meter')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Merk Meter</label>
                        <select class="form-control @error('merk_meter') is-invalid @enderror" name="merk_meter"
                            id="merk_meter">
                            <option value="" disabled selected>--- Pilih Merk Meter ---</option>
                            <option value="Actaris"
                                {{ old('merk_meter', $pelanggan->merk_meter) == 'Actaris' ? 'selected' : '' }}>
                                Actaris</option>
                            <option value="Cannet"
                                {{ old('merk_meter', $pelanggan->merk_meter) == 'Cannet' ? 'selected' : '' }}>
                                Cannet</option>
                            <option value="Conlog"
                                {{ old('merk_meter', $pelanggan->merk_meter) == 'Conlog' ? 'selected' : '' }}>
                                Conlog</option>
                            <option value="Fuji"
                                {{ old('merk_meter', $pelanggan->merk_meter) == 'Fuji' ? 'selected' : '' }}>Fuji
                            </option>
                            <option value="Hexing"
                                {{ old('merk_meter', $pelanggan->merk_meter) == 'Hexing' ? 'selected' : '' }}>
                                Hexing</option>
                            <option value="Itron"
                                {{ old('merk_meter', $pelanggan->merk_meter) == 'Itron' ? 'selected' : '' }}>Itron
                            </option>
                            <option value="Landis"
                                {{ old('merk_meter', $pelanggan->merk_meter) == 'Landis' ? 'selected' : '' }}>
                                Landis</option>
                            <option value="Melcoinda"
                                {{ old('merk_meter', $pelanggan->merk_meter) == 'Melcoinda' ? 'selected' : '' }}>
                                Melcoinda</option>
                            <option value="Prima"
                                {{ old('merk_meter', $pelanggan->merk_meter) == 'Prima' ? 'selected' : '' }}>Prima
                            </option>
                            <option value="Sanxing"
                                {{ old('merk_meter', $pelanggan->merk_meter) == 'Sanxing' ? 'selected' : '' }}>
                                Sanxing</option>
                            <option value="SmartMeter"
                                {{ old('merk_meter', $pelanggan->merk_meter) == 'SmartMeter' ? 'selected' : '' }}>
                                SmartMeter</option>
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
                            id="tahun_meter" type="text" inputmode="numeric" pattern="[0-9]*"
                            value="{{ old('tahun_meter', $pelanggan->tahun_meter) }}">
                        @error('tahun_meter')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Nomor Meter</label>
                        <input class="form-control @error('nomor_meter') is-invalid @enderror" name="nomor_meter"
                            id="nomor_meter" type="text" inputmode="numeric" pattern="[0-9]*"
                            value="{{ old('nomor_meter', $pelanggan->nomor_meter) }}">
                        @error('nomor_meter')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Merk MCB</label>
                        <select class="form-control @error('merk_mcb') is-invalid @enderror" name="merk_mcb" id="merk_mcb">
                            <option value="" disabled selected>--- Pilih Merk MCB ---</option>
                            <option value="ABB" {{ old('merk_mcb', $pelanggan->merk_mcb) == 'ABB' ? 'selected' : '' }}>
                                ABB</option>
                            <option value="ABBA" {{ old('merk_mcb', $pelanggan->merk_mcb) == 'ABBA' ? 'selected' : '' }}>
                                ABBA
                            </option>
                            <option value="BROCO"
                                {{ old('merk_mcb', $pelanggan->merk_mcb) == 'BROCO' ? 'selected' : '' }}>BROCO
                            </option>
                            <option value="DAYA" {{ old('merk_mcb', $pelanggan->merk_mcb) == 'DAYA' ? 'selected' : '' }}>
                                DAYA
                            </option>
                            <option value="EMCO" {{ old('merk_mcb', $pelanggan->merk_mcb) == 'EMCO' ? 'selected' : '' }}>
                                EMCO
                            </option>
                            <option value="ELEKTRO"
                                {{ old('merk_mcb', $pelanggan->merk_mcb) == 'ELEKTRO' ? 'selected' : '' }}>ELEKTRO
                            </option>
                            <option value="HPL" {{ old('merk_mcb', $pelanggan->merk_mcb) == 'HPL' ? 'selected' : '' }}>
                                HPL</option>
                            <option value="LG" {{ old('merk_mcb', $pelanggan->merk_mcb) == 'LG' ? 'selected' : '' }}>LG
                            </option>
                            <option value="MCCB / HAGER"
                                {{ old('merk_mcb', $pelanggan->merk_mcb) == 'MCCB / HAGER' ? 'selected' : '' }}>MCCB
                                / HAGER</option>
                            <option value="MELCO"
                                {{ old('merk_mcb', $pelanggan->merk_mcb) == 'MELCO' ? 'selected' : '' }}>MELCO
                            </option>
                            <option value="MERLIN"
                                {{ old('merk_mcb', $pelanggan->merk_mcb) == 'MERLIN' ? 'selected' : '' }}>MERLIN
                            </option>
                            <option value="MERLIN GERIN"
                                {{ old('merk_mcb', $pelanggan->merk_mcb) == 'MERLIN GERIN' ? 'selected' : '' }}>
                                MERLIN GERIN</option>
                            <option value="OSAKI"
                                {{ old('merk_mcb', $pelanggan->merk_mcb) == 'OSAKI' ? 'selected' : '' }}>OSAKI
                            </option>
                            <option value="SCHNEIDER"
                                {{ old('merk_mcb', $pelanggan->merk_mcb) == 'SCHNEIDER' ? 'selected' : '' }}>
                                SCHNEIDER</option>
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
                            <option value="" disabled {{ old('ukuran_mcb') === null ? 'selected' : '' }}>--- Pilih
                                Ukuran MCB ---</option>
                            <option value="2"
                                {{ old('ukuran_mcb', $pelanggan->ukuran_mcb) == '2' ? 'selected' : '' }}>2</option>
                            <option value="4"
                                {{ old('ukuran_mcb', $pelanggan->ukuran_mcb) == '4' ? 'selected' : '' }}>4</option>
                            <option value="6"
                                {{ old('ukuran_mcb', $pelanggan->ukuran_mcb) == '6' ? 'selected' : '' }}>6</option>
                            <option value="10"
                                {{ old('ukuran_mcb', $pelanggan->ukuran_mcb) == '10' ? 'selected' : '' }}>10
                            </option>
                            <option value="16"
                                {{ old('ukuran_mcb', $pelanggan->ukuran_mcb) == '16' ? 'selected' : '' }}>16
                            </option>
                            <option value="20"
                                {{ old('ukuran_mcb', $pelanggan->ukuran_mcb) == '20' ? 'selected' : '' }}>20
                            </option>
                            <option value="25"
                                {{ old('ukuran_mcb', $pelanggan->ukuran_mcb) == '25' ? 'selected' : '' }}>25
                            </option>
                            <option value="35"
                                {{ old('ukuran_mcb', $pelanggan->ukuran_mcb) == '35' ? 'selected' : '' }}>35
                            </option>
                            <option value="50"
                                {{ old('ukuran_mcb', $pelanggan->ukuran_mcb) == '50' ? 'selected' : '' }}>50
                            </option>
                        </select>
                        @error('ukuran_mcb')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">NO Segel</label>
                        <input class="form-control @error('no_segel') is-invalid @enderror" name="no_segel"
                            id="no_segel" type="text" value="{{ old('no_segel', $pelanggan->no_segel) }}">
                        @error('no_segel')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">NO Gardu</label>
                        <input class="form-control @error('no_gardu') is-invalid @enderror" name="no_gardu"
                            id="no_gardu" type="text" value="{{ old('no_gardu', $pelanggan->no_gardu) }}">
                        @error('no_gardu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Tarikan ke ......</label>
                        <input class="form-control @error('sr_deret') is-invalid @enderror" name="sr_deret"
                            id="sr_deret" type="text" inputmode="numeric" pattern="[0-9]*"
                            value="{{ old('sr_deret', $pelanggan->sr_deret) }}">
                        @error('sr_deret')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Catatan</label>
                        <textarea class="form-control" name="catatan" id="catatan" cols="30" rows="10">{{ old('catatan', $pelanggan->catatan) }}</textarea>
                    </div>
                    <input type="hidden" name="unit_ulp" id="unit_ulp" value="{{ auth()->user()->unit_ulp }}">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success mb-4">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("getLocation").addEventListener("click", function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        });

        function showPosition(position) {
            document.getElementById("latitude").value = position.coords.latitude;
            document.getElementById("longitude").value = position.coords.longitude;
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("User denied the request for Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
        }
    </script>
@endsection
