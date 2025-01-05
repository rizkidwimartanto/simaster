@extends('layout/templateberanda_koordinator')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="kinerjaUP3">Pilih Bulan:</label>
                        <input type="month" id="kinerjaUP3" class="form-control" placeholder="YYYY-MM">
                    </div>
                    <div class="col-md-2">
                        <label>&nbsp;</label>
                        <button id="filterKinerja" class="btn btn-primary w-100">Filter</button>
                    </div>
                </div>
                <div style="overflow-y: auto;">
                    <h2 class="mt-2">Data Kinerja UP3</h2>
                    <table class="table-bordered tabel-app mt-2 display" id="tabel-kinerja">
                        <thead class="text-light" style="background:linear-gradient(#780206, #061161)">
                            <tr>
                                <th>GI</th>
                                <th style="display: none">Created At</th>
                                <th>Daya Terpasang</th>
                                <th>Daya Terpakai</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_kinerja as $gi)
                                @php
                                    if (empty($gi) || empty($gi->gi)) {
                                        continue; // Lewati iterasi jika $gi kosong
                                    }
                                    $highlight = in_array($gi->gi, [
                                        'GI Kedung Ombo',
                                        'GI Sayung',
                                        'GI Purwodadi',
                                        'GI Kudus',
                                        'GI Semen Grobogan',
                                        'GI Mranggen',
                                    ]);
                                @endphp
                                <tr
                                    style="{{ $highlight ? 'background:linear-gradient(#0F2027, #203A43, #2C5364); color:white;' : '' }}">
                                    <td>{{ $gi->gi }}</td>
                                    <td style="display: none">{{ $gi->created_at }}</td>
                                    <td>{{ $gi->daya_terpasang }}</td>
                                    <td>{{ $gi->daya_terpakai }}</td>
                                    <td>{{ number_format($gi->daya_terpasang_terpakai_persen, 0) }}%</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- <div class="col-lg-3">
                <canvas id="giDayaChart" width="10" height="10"></canvas>
            </div> --}}
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables
            let table = $('#tabel-kinerja').DataTable({
                'pageLength': 19,
                'lengthMenu': [10, 20, 50, 100, 200, 500],
                "footerCallback": function(row, data, start, end, display) {
                    let api = this.api();
                },
                "order": [
                    [0, "desc"]
                ],
                "columnDefs": [{
                    "targets": 1,
                    "visible": false
                }]
            });

            // Event Filter
            $('#filterKinerja').on('click', function() {
                let bulanAset = $('#kinerjaUP3').val();

                if (kinerjaUP3) {
                    table.draw();
                } else {
                    alert("Silakan pilih bulan.");
                }
            });

            // Custom Filter untuk Tanggal
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                let createdAt = data[1]; // Index kolom created_at
                let kinerjaUP3 = $('#kinerjaUP3').val();

                if (kinerjaUP3) {
                    let date = new Date(createdAt);
                    let start = new Date(kinerjaUP3 + "-01"); // Awal bulan yang dipilih

                    return date.getFullYear() === start.getFullYear() && date.getMonth() === start
                        .getMonth();
                }
                return true;
            });
        });
    </script>
@endsection
