@extends('layout.templateberanda_koordinator')
@section('content')
    <div class="container-fluid mt-3">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="bulanRKAP">Pilih Bulan:</label>
                <input type="month" id="bulanRKAP" class="form-control" placeholder="YYYY-MM">
            </div>
            <div class="col-md-2">
                <label>&nbsp;</label>
                <button id="filterAset" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>

        <div style="overflow-y: auto;">
            <h2>Data Manajemen Usulan RKAP</h2>
            <table class="table-bordered tabel-app mt-2 display" id="tabel-usulan-rkap">
                <thead class="text-light" style="background:linear-gradient(#134E5E, #71B280)">
                    <tr>
                        <th>Nama Petugas</th>
                        <th style="display: none">Created At</th>
                        <th>Nomor HP</th>
                        <th>Foto</th>
                        <th>Lokasi</th>
                        <th>Keterangan</th>
                        <th>Rencana Usulan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_usulan_rkap as $usulan_rkap)
                        <tr>
                            <td>{{ $usulan_rkap->nama_petugas }}</td>
                            <td style="display: none">{{ $usulan_rkap->created_at }}</td>
                            <td>{{ $usulan_rkap->nomor_hp }}</td>
                            <td>
                                @if ($usulan_rkap->foto)
                                    <img src="{{ asset('storage/' . $usulan_rkap->foto) }}" alt="Foto Petugas"
                                        style="width: 100px; height: auto; cursor: pointer;" data-bs-toggle="modal"
                                        data-bs-target="#imageModal"
                                        onclick="showImage('{{ asset('storage/' . $usulan_rkap->foto) }}')">
                                @else
                                    <span class="text-muted">Tidak ada foto</span>
                                @endif
                                <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="imageModalLabel">Foto Petugas</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img id="modalImage" src="" alt="Foto Petugas" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a target="_blank"
                                    href="https://www.google.com/maps?q={{ $usulan_rkap->latitude }},{{ $usulan_rkap->longitude }}">
                                    <b>https://www.google.com/maps?q={{ $usulan_rkap->latitude }},{{ $usulan_rkap->longitude }}</b>
                                </a>
                            </td>
                            <td>{{ $usulan_rkap->keterangan }}</td>
                            <td>{{ $usulan_rkap->usulan_rkap }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables
            let table = $('#tabel-usulan-rkap').DataTable({
                'pageLength': 5,
                'lengthMenu': [10, 20, 50, 100, 200, 500],
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
                let bulanRKAP = $('#bulanRKAP').val();

                if (bulanRKAP) {
                    table.draw();
                } else {
                    alert("Silakan pilih bulan.");
                }
            });

            // Custom Filter untuk Tanggal
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                let createdAt = data[1]; // Index kolom created_at
                let bulanRKAP = $('#bulanRKAP').val();

                if (bulanRKAP) {
                    let date = new Date(createdAt);
                    let start = new Date(bulanRKAP + "-01"); // Awal bulan yang dipilih

                    return date.getFullYear() === start.getFullYear() && date.getMonth() === start
                        .getMonth();
                }
                return true;
            });
        });
    </script>
    <script>
        function showImage(imageUrl) {
            document.getElementById('modalImage').src = imageUrl;
        }
    </script>
@endsection
