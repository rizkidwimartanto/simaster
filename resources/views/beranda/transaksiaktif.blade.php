@extends('layout/templateberanda')
@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 mt-2">
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
            <div class="card p-3">
                <h2>Data Jaringan Padam Saat Ini</h2>
                <form action="/transaksipadam/edit_status_padam" method="post">
                    @csrf
                    <input type="hidden" value="Menyala" name="status" id="status">
                    <a href="#" class="btn btn-success col-12 mb-3" data-bs-toggle="modal"
                        data-bs-target="#modal-report"><i class="fa-solid fa-power-off fa-lg"
                            style="margin-right: 5px;"></i>
                        Hidupkan
                    </a>
                    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Update</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Jam Nyala</label>
                                                <input type="datetime-local"
                                                    class="form-control @error('jam_nyala') is-invalid @enderror"
                                                    name="jam_nyala" id="jam_nyala" value="{{ old('jam_nyala') }}">
                                                @error('jam_nyala')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Penyebab Fix</label>
                                                <textarea class="form-control @error('penyebab_fix') is-invalid @enderror" rows="3" name="penyebab_fix"
                                                    id="penyebab_fix">{{ old('penyebab_fix') }}</textarea>
                                                @error('penyebab_fix')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancel</a>
                                    <button type="submit" class="btn btn-success ms-auto">
                                        <i class="fa-solid fa-power-off" style="margin-right: 5px;"></i> Hidupkan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-vcenter table-bordered table-hover table-warning" id="tabel_data_padam">
                        <thead>
                            <tr>
                                <th width="2%">
                                    <div class="d-flex justify-content-center">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" style="position:relative; left:10px;"
                                                type="checkbox" id="checklist-padam" onclick="checkAllPadam()">
                                        </div>
                                    </div>
                                </th>
                                <th width="6%">Penyebab Padam</th>
                                <th width="4%">Nama Pelanggan</th>
                                <th width="4%">Penyulang</th>
                                <th width="16%">Section</th>
                                <th width="20%">Nomor Tiang</th>
                                <th width="20%">Jam Padam</th>
                                <th width="10%">Keterangan</th>
                                <th width="8%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_padam as $s)
                                @if ($s->status == 'Padam')
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $s->id }}" id="flexCheckDefault"
                                                        name="checkPadam[]">
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $s->penyebab_padam }}</td>
                                        <td>{{ $s->nama_pelanggan }}</td>
                                        <td>{{ $s->penyulang }}</td>
                                        <td>{{ $s->section }}</td>
                                        <td>
                                            @if ($s->nomorTiang)
                                                {{ $s->nomorTiang->nama_section }}
                                            @else
                                                {{ null }}
                                            @endif
                                        </td>
                                        {{-- <td>{{ $s->penyebab_padam }}</td> --}}
                                        <td>{{ $s->jam_padam }}</td>
                                        <td>{{ $s->keterangan }}</td>
                                        <td>{{ $s->status }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="card p-3 mb-3 mt-3">
                <h2>Daftar Pelanggan Padam Saat Ini</h2>
                <table class="table table-vcenter table-bordered table-hover table-success" id="tabel_rekap_pelanggan"
                    style="width: 100%">
                    <thead>
                        <tr>
                            <th width="28%">Nomor Telepon</th>
                            <th width="30%">Nama Pelanggan</th>
                            <th width="40%">Alamat</th>
                            <th width="2%">Aksi</th>
                            <th width="0%" style="display:none;">Nomor HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekap_pelanggan as $item_rekap)
                            <tr>
                                <td>{{ $item_rekap->nohp_stakeholder }}</td>
                                <td>{{ $item_rekap->nama }}</td>
                                <td>{{ $item_rekap->alamat }}</td>
                                <td>
                                    @php
                                        $pesanWhatsapp = urlencode(
                                            "Halo, saya rizki. Untuk saat ini mengalami $item_rekap->penyebab_padam karena $item_rekap->keterangan",
                                        );
                                    @endphp
                                    <a href="https://wa.me/{{ $item_rekap->nohp_stakeholder }}?text={{ $pesanWhatsapp }}"
                                        target="_blank">
                                        <i class="fa-brands fa-whatsapp fa-lg text-success"></i>
                                    </a>
                                </td>
                                <td style="display:none;">{{ $item_rekap->nohp_stakeholder }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function checkAllPelanggan() {
            var checklistWhatsapp = document.getElementById('checklist-whatsapp');
            var checkboxes = document.getElementsByName('checkWhatsapp[]');

            checkboxes.forEach(function(checkbox) {
                checkbox.checked = checklistWhatsapp.checked;
            });
        }

        function checkAllPadam() {
            var checkPadam = document.getElementById('checklist-padam');
            var checkboxPadam = document.getElementsByName('checkPadam[]');

            checkboxPadam.forEach(function(check) {
                check.checked = checkPadam.checked;
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#tabel_data_padam').DataTable({
                scrollX: true,
                'pageLength': 500,
                'lengthMenu': [10, 25, 50, 100, 200, 500],
            });
        });
        $(document).ready(function() {
            $('#tabel_rekap_pelanggan').DataTable({
                scrollX: true,
                scrollCollapse: true,
                fixedColumns: true,
                'pageLength': 500,
                'lengthMenu': [10, 25, 50, 100, 200, 500],
            });
        });
    </script>
@endsection
