@extends('layout/templateberanda_user')
@section('content')
    <div class="container mt-4">
        <div class="mb-4">
            <div class="d-grid gap-2">
                <button type="button" class="btn btn-primary" id="getLocation">Klik Lokasi Saat Ini</button>
            </div>
        </div>
        <form action="/input_pelanggan_app" method="post">
            @csrf
            <h1>Data Pelanggan</h1>
            <div class="mb-4">
                <label class="form-label">ID Pelanggan</label>
                <div class="input-group input-group-flat">
                    <input required class="form-control" name="id_pelanggan" id="id_pelanggan" type="text" inputmode="numeric"
                        pattern="[0-9]*">
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Nama Pelanggan</label>
                <div class="input-group input-group-flat">
                    <input required class="form-control" name="nama_pelanggan" id="nama_pelanggan" type="text">
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Tarif</label>
                <div class="input-group input-group-flat">
                    <select required class="form-control" name="tarif" id="tarif">
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
                    <select required class="form-control" name="daya" id="daya">
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
                    <textarea required class="form-control" name="alamat" id="alamat" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Latitude</label>
                        <div class="input-group input-group-flat">
                            <input required class="form-control" name="latitude" id="latitude" type="text" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Longitude</label>
                        <div class="input-group input-group-flat">
                            <input required class="form-control" name="longitude" id="longitude" type="text" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <h1>Data APP</h1>
            <div class="mb-4">
                <label class="form-label">Jenis Meter</label>
                <div class="input-group input-group-flat">
                    <select required class="form-control" name="jenis_meter" id="jenis_meter">
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
                    <select required class="form-control" name="merk_meter" id="merk_meter">
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
                    <select required class="form-control" name="tahun_meter" id="tahun_meter">
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
                    <select required class="form-control" name="merk_mcb" id="merk_mcb">
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
                    <select required class="form-control" name="ukuran_mcb" id="ukuran_mcb">
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
                    <input required class="form-control" name="no_segel" id="no_segel" type="text">
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">NO Gardu</label>
                <div class="input-group input-group-flat">
                    <input required class="form-control" name="no_gardu" id="no_gardu" type="text">
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">SR Deret ke</label>
                <div class="input-group input-group-flat">
                    <select required class="form-control" name="sr_deret" id="sr_deret">
                        <option selected disabled>--- Pilih SR Deret ke ---</option>
                        <option value="52551">52551</option>
                        <option value="52552">52552</option>
                        <option value="52553">52553</option>
                        <option value="52554">52554</option>
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Catatan</label>
                <div class="input-group input-group-flat">
                    <textarea required class="form-control" name="catatan" id="catatan" cols="30" rows="10"></textarea>
                </div>
            </div>
                <button type="submit" class="btn btn-primary mb-4">Save changes</button>
        </form>
    </div>
    <script>
        document.getElementById('getLocation').addEventListener('click', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        });

        function showPosition(position) {
            document.getElementById('latitude').value = position.coords.latitude;
            document.getElementById('longitude').value = position.coords.longitude;
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
