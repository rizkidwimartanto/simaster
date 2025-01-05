@extends('layout/templateberanda_user')
@section('content')
    <div class="container-fluid mt-4">
        <div class="card shadow-lg border-0 rounded">
            <div class="card-header bg-info text-white text-center rounded-top">
                <h3 class="mb-0 text-capitalize">{{ auth()->user()->unit_ulp }}</h3>
            </div>
            @error('latitude')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Anda belum klik lokasi saat ini</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
            <div class="card-body p-4">
                <div class="mb-4">
                    <label class="form-label">Nama Petugas</label>
                    <input class="form-control @error('nama_petugas') is-invalid @enderror" name="nama_petugas"
                        id="nama_petugas" type="text" value="{{ old('nama_petugas') }}" required>
                    @error('nama_petugas')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="form-label">Nomor HP</label>
                    <input class="form-control @error('nomor_hp') is-invalid @enderror" name="nomor_hp" id="nomor_hp"
                        type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                        value="{{ old('nomor_hp') }}" required>
                    @error('nomor_hp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="form-label">Foto</label>
                    <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto"
                        id="foto" value="{{ old('foto') }}" required>
                    @error('foto')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <div class="d-grid gap-2">
                        <label class="form-label">Lokasi</label>
                        <button type="button" class="btn btn-success" id="getLocation" style="font-size: 15px;"><i
                                class="fa-solid fa-location-crosshairs fa-lg" style="margin-right: 5px;"></i> Klik Lokasi
                            Saat
                            Ini</button>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label">Keterangan</label>
                    <textarea required class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan"
                        cols="30" rows="3">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-flat">
                                <input required class="form-control" name="latitude" id="latitude" type="hidden" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-flat">
                                <input required class="form-control" name="longitude" id="longitude" type="hidden"
                                    readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary mb-4" style="height: 40px">Save changes</button>
                    </div>
                </div>
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
