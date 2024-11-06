@extends('layout/templateberanda')
@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 mt-2">
            <div class="card border border-info p-3">
                <h2>Data Jaringan Padam Saat Ini</h2>
                <form action="/transaksipadam/edit_status_padam" method="post">
                    @csrf
                    <input type="hidden" value="Menyala" name="status" id="status">
                    <input type="hidden" value="Sedang Mengirim" name="status_wa" id="status_wa">
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
                    <div style="overflow-y: auto;">
                        <table class="table-bordered table-warning display" id="tabel_data_padam">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="d-flex justify-content-center">
                                            <div class="form-check">
                                                <input class="form-check-input mt-2" style="position:relative; left:10px;"
                                                    type="checkbox" id="checklist-padam" onclick="checkAllPadam()">
                                            </div>
                                        </div>
                                    </th>
                                    <th>Penyebab Padam</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Penyulang</th>
                                    <th>Section</th>
                                    <th>Nomor Tiang</th>
                                    <th>Jam Padam</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_padam as $s)
                                    @if ($s->status == 'Padam')
                                        <script>
                                            var audio = new Audio('{{ asset('assets/music/emergency-alarm.mp3') }}');
                                            audio.play();
                                        </script>
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
                    </div>
                </form>
            </div>
            <div class="card border border-info p-3 mb-3 mt-3">
                <h2>Daftar Pelanggan Padam Saat Ini</h2>
                <div style="overflow-y: auto;">
                    <table class="table-bordered table-hover table-success display" id="tabel_rekap_pelanggan">
                        <thead>
                            <tr>
                                <th>Penyebab Padam</th>
                                <th>Nomor Telepon</th>
                                <th>Nama Pelanggan</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $rekap_gabungan = $rekap_pelanggan->merge($rekap_instalasi);
                            @endphp
                            @foreach ($rekap_gabungan as $item_rekap)
                                @if ($item_rekap->nama !== null)
                                    <tr>
                                        <td>{{ $item_rekap->penyebab_padam }}</td>
                                        <td>{{ $item_rekap->nohp_stakeholder }}</td>
                                        <td>{{ $item_rekap->nama }}</td>
                                        <td><a href="{{ $item_rekap->maps }}" target="_blank">{{ $item_rekap->maps }}</a>
                                        </td>
                                        <td>
                                            <a href="https://wa.me/{{ $item_rekap->nohp_stakeholder }}" target="_blank">
                                                <i class="fa-brands fa-whatsapp fa-lg text-success"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function checkAllPadam() {
            var checkPadam = document.getElementById('checklist-padam');
            var checkboxPadam = document.getElementsByName('checkPadam[]');

            checkboxPadam.forEach(function(check) {
                check.checked = checkPadam.checked;
            });
        }
    </script>
    <script>
        function templateDataTable(namaTabel) {
            $(document).ready(function() {
                $(namaTabel).DataTable({
                    'pageLength': 500,
                    'lengthMenu': [10, 25, 50, 100, 200, 500],
                });
            });
        }
        templateDataTable('#tabel_data_padam');
        templateDataTable('#tabel_rekap_pelanggan');
    </script>
@endsection
