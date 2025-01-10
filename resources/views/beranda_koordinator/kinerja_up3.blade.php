@extends('layout/templateberanda_koordinator')
@section('content')
    <div class="container-fluid mt-2">
        <div class="row mb-3 mt-1">
            <div class="col-md-6">
                <label for="bulanAset">Pilih Bulan:</label>
                <input type="month" id="bulanAset" class="form-control" placeholder="YYYY-MM">
            </div>
            <div class="col-md-2">
                <label>&nbsp;</label>
                <button id="filterAset" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>

        <div style="overflow-y: auto;">
            <h2>Data Aset</h2>
            <a class="btn btn-outline-warning" href="https://linktr.ee/perencanaan.up3demak" target="_blank"
                style="position: relative; bottom:10px;">Map
                Data Aset Perencanaan</a>
            <table class="table-bordered tabel-app mt-2 display" id="tabel-aset">
                <thead class="text-light" style="background:linear-gradient(#134E5E, #71B280)">
                    <tr>
                        <th>ULP</th>
                        <th style="display: none">Created At</th>
                        <th>Bulan</th>
                        <th>KMS JTM</th>
                        <th>KMS JTR</th>
                        <th>Jumlah Trafo</th>
                        <th>Total Daya Trafo</th>
                        <th>SR</th>
                        <th>Jumlah Tiang TM</th>
                        <th>Jumlah Tiang TR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_aset as $aset)
                        <tr>
                            <td>{{ $aset->ulp }}</td>
                            <td style="display: none">{{ $aset->created_at }}</td>
                            <td>{{ \Carbon\Carbon::parse($aset->created_at)->format('F Y') }}</td>
                            <td>{{ $aset->kms_jtm }}</td>
                            <td>{{ $aset->kms_jtr }}</td>
                            <td>{{ $aset->jumlah_trafo }}</td>
                            <td>{{ $aset->total_daya_trafo }}</td>
                            <td>{{ $aset->sr }}</td>
                            <td>{{ $aset->jumlah_tiang_tm }}</td>
                            <td>{{ $aset->jumlah_tiang_tr }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-center" colspan="3">Total UP3 Grobogan</th>
                        <th id="total_kms_jtm"></th>
                        <th id="total_kms_jtr"></th>
                        <th id="total_jumlah_trafo"></th>
                        <th id="total_total_daya_trafo"></th>
                        <th id="total_sr"></th>
                        <th id="total_jumlah_tiang_tm"></th>
                        <th id="total_jumlah_tiang_tr"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
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
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables
            let table = $('#tabel-aset').DataTable({
                'pageLength': 5,
                'lengthMenu': [10, 20, 50, 100, 200, 500],
                "footerCallback": function(row, data, start, end, display) {
                    let api = this.api();

                    // Fungsi untuk menghitung total
                    let total = function(index) {
                        return api
                            .column(index, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0).toFixed(2);
                    };

                    $(api.column(3).footer()).html(total(3));
                    $(api.column(4).footer()).html(total(4));
                    $(api.column(5).footer()).html(total(5));
                    $(api.column(6).footer()).html(total(6));
                    $(api.column(7).footer()).html(total(7));
                    $(api.column(8).footer()).html(total(8));
                    $(api.column(9).footer()).html(total(9));
                },
                "order": [
                    [0, "asc"]
                ],
                "columnDefs": [{
                    "targets": 1,
                    "visible": false
                }]
            });

            // Event Filter
            $('#filterAset').on('click', function() {
                let bulanAset = $('#bulanAset').val();

                if (bulanAset) {
                    table.draw();
                } else {
                    alert("Silakan pilih bulan.");
                }
            });

            // Custom Filter untuk Tanggal
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                let createdAt = data[1]; // Index kolom created_at
                let bulanAset = $('#bulanAset').val();

                if (bulanAset) {
                    let date = new Date(createdAt);
                    let start = new Date(bulanAset + "-01"); // Awal bulan yang dipilih

                    return date.getFullYear() === start.getFullYear() && date.getMonth() === start
                        .getMonth();
                }
                return true;
            });
        });
    </script>
@endsection
