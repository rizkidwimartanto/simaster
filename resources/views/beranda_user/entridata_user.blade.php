@extends('layout/templateberanda_user')
@section('content')
    <div class="container-fluid mt-4">
        <div class="container-fluid mt-4">
            <label class="form-label">Nama Pelanggan</label>
            <select name="nama_pelanggan" id="nama_pelanggan" class="mb-4 form-select">
                <option disabled selected>--- Pilih Nama Pelanggan ---</option>
                @foreach ($data_pelanggan_app->sortBy('nama_pelanggan') as $app)
                    <a href="edit_pelanggan_app_user/{{ $app->nama_pelanggan }}">
                        <option value="{{ $app->nama_pelanggan }}">{{ $app->nama_pelanggan }}</option>
                    </a>
                @endforeach
            </select>
        </div>
        <script>
            document.getElementById('nama_pelanggan').addEventListener('change', function() {
                var namaPelanggan = this.value;
                if (namaPelanggan) {
                    window.location.href = '/edit_pelanggan_app_user/' + namaPelanggan;
                }
            });
        </script>
    @endsection
