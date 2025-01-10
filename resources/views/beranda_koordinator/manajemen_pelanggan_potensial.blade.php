@extends('layout/templateberanda_koordinator')
@section('content')
    <!-- Tabel Data -->
    <div class="container-fluid mt-2">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="bulanPotensial">Pilih Bulan:</label>
                <input type="month" id="bulanPotensial" class="form-control" placeholder="YYYY-MM">
            </div>
            <div class="col-md-2">
                <label>&nbsp;</label>
                <button id="filterAset" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>

        <div style="overflow-y: auto;">
            <h2>Data Manajemen Pelanggan Potensial</h2>
            <table class="table-bordered tabel-app mt-2 display" id="tabel-pelanggan-potensial">
                <thead class="text-light" style="background:linear-gradient(#134E5E, #71B280)">
                    <tr>
                        <th>Unit UP</th>
                        <th style="display: none">Created At</th>
                        <th>OD ID</th>
                        <th>Count Unit UP</th>
                        <th>SUM Daya</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_pelanggan_potensial as $pelanggan_potensial)
                        <tr>
                            <td>{{ $pelanggan_potensial->unit_ulp }}</td>
                            <td style="display: none">{{ $pelanggan_potensial->created_at }}</td>
                            <td>{{ $pelanggan_potensial->od_id }}</td>
                            <td>{{ $pelanggan_potensial->count_unitulp }}</td>
                            <td>{{ number_format($pelanggan_potensial->sum_daya, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script>
            $(document).ready(function() {
                // Inisialisasi DataTables tanpa sorting
                let table = $('#tabel-pelanggan-potensial').DataTable({
                    'pageLength': 13,
                    'lengthMenu': [10, 20, 50, 100, 200, 500],
                    'ordering': false, // Menonaktifkan sorting
                    "columnDefs": [{
                        "targets": 1,
                        "visible": false
                    }]
                });

                // Event Filter
                $('#filterAset').on('click', function() {
                    let bulanPotensial = $('#bulanPotensial').val();
                    if (bulanPotensial) {
                        table.draw();
                    } else {
                        alert("Silakan pilih bulan.");
                    }
                });

                // Custom Filter untuk Tanggal
                $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                    let createdAt = data[1]; // Index kolom created_at
                    let bulanPotensial = $('#bulanPotensial').val();

                    if (bulanPotensial) {
                        let date = new Date(createdAt);
                        let start = new Date(bulanPotensial + "-01"); // Awal bulan yang dipilih
                        return date.getFullYear() === start.getFullYear() && date.getMonth() === start
                            .getMonth();
                    }
                    return true;
                });
            });
        </script>
    @endsection
