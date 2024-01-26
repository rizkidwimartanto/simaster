@extends('layout/templateberanda')
@section('content')
    <div class="container-fluid mt-3">
        @if (session('success_nyala'))
            <div class="alert alert-success">
                {{ session('success_nyala') }}
            </div>
        @endif
        @if (session('success_tambah'))
            <div class="alert alert-success">
                {{ session('success_tambah') }}
            </div>
        @endif
        @if (session('error_tambah'))
            <div class="alert alert-danger">
                {{ session('error_tambah') }}
            </div>
        @endif
        @if (session('error_nyala'))
            <div class="alert alert-danger">
                {{ session('error_nyala') }}
            </div>
        @endif
        <div class="card p-3 mb-3">
            <h2>Jumlah Kali Padam</h2>
            <a href="/transaksipadam/export_kali_padam" class="btn btn-warning mb-3 col-lg-2"><i
                    class="fa-solid fa-download fa-lg" style="margin-right: 5px"></i>Export Excel</a>
            <table class="table table-vcenter table-bordered table-hover" id="tabel_rekap_pelanggan" style="width: 100%">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="45%">Section</th>
                        <th width="45%">Nomor Tiang</th>
                        <th width="5%">Kali Padam</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($rekap_section as $item_section)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item_section->section }}</td>
                            <td>{{ $item_section->nama_section }}</td>
                            <td>{{ $item_section->jumlah_entri }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-12">
            <div class="card p-3 mt-4">
                <h2>Rekap Data Padam</h2>
                <table class="table table-vcenter table-bordered table-hover" id="tabel_data_menyala" style="width: 100%">
                    <thead>
                        <tr>
                            <th width="1%">No</th>
                            <th>Penyulang</th>
                            <th>Section</th>
                            <th>Penyebab Padam</th>
                            <th>Penyebab Fix</th>
                            <th>Jam Padam</th>
                            <th>Jam Nyala</th>
                            <th>Durasi Padam</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($data_padam as $s)
                            @if ($s->status == 'Menyala')
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $s->penyulang }}</td>
                                    <td>{{ $s->section }}</td>
                                    <td>{{ $s->penyebab_padam }}</td>
                                    <td>{{ $s->penyebab_fix }}</td>
                                    <td>{{ $s->jam_padam }}</td>
                                    <td>{{ $s->jam_nyala }}</td>
                                    <td>
                                        @php
                                            $waktuPadam = strtotime($s->jam_padam);
                                            $waktuNyala = strtotime($s->jam_nyala);
                                            $durasiDetik = $waktuNyala - $waktuPadam;

                                            $durasiJam = floor($durasiDetik / (60 * 60));
                                            $durasiMenit = floor(($durasiDetik % (60 * 60)) / 60);
                                            $durasiPadam = $durasiJam . ' jam ' . $durasiMenit . ' menit';
                                        @endphp
                                        {{ $durasiPadam }}</td>
                                    <td>{{ $s->keterangan }}</td>
                                    <td>{{ $s->status }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#tabel_rekap_pelanggan').DataTable({
                scrollX: true,
            })
        })
        $(document).ready(function() {
            $('#tabel_data_menyala').DataTable({
                scrollX: true,
            });
        });
    </script>
@endsection
