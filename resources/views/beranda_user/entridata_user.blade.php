@extends('layout/templateberanda_user')
@section('content')
    <div class="container-fluid mt-4">
        <div class="container-fluid mt-4">
            <label class="form-label">ID Pelanggan</label>
            <select id="select-pelanggan" placeholder="Ketik disini untuk mencari ID Pelanggan ........"></select>
        </div>
    </div>

    <script>
        // Data pelanggan dari backend (pastikan $data_pelanggan_app berisi data pelanggan)
        var data_pelanggan_app = @json($data_pelanggan_app);

        // Filter pelanggan yang tidak memiliki latitude dan longitude
        var filteredData = data_pelanggan_app.filter(function(customer) {
            return customer.latitude == null || customer.longitude == null; // Hanya pilih pelanggan tanpa latitude/longitude
        });

        // Inisialisasi Selectize hanya untuk pelanggan yang belum memiliki latitude dan longitude
        $(document).ready(function() {
            $('#select-pelanggan').selectize({
                valueField: 'id_pelanggan', // Nilai yang akan dipilih
                labelField: 'id_pelanggan', // Label yang ditampilkan
                searchField: ['id_pelanggan'], // Kolom yang akan dicari
                options: filteredData, // Data pelanggan yang difilter dari server
                placeholder: 'Ketik disini untuk mencari ID Pelanggan ........',
                maxItems: 1, // Hanya satu pilihan
                onChange: function(value) {
                    if (value) {
                        // Redirect ke halaman edit pelanggan berdasarkan ID pelanggan yang dipilih
                        window.location.href = '/edit_pelanggan_app_user/' + value;
                    }
                }
            });
        });
    </script>
@endsection
