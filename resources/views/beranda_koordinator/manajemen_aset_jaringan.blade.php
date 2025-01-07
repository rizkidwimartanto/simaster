@extends('layout/templateberanda_koordinator')
@section('content')
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-lg-12">
                {{-- <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="bulanGI">Pilih Bulan:</label>
                        <input type="month" id="bulanGI" class="form-control" placeholder="YYYY-MM">
                    </div>
                    <div class="col-md-2">
                        <label>&nbsp;</label>
                        <button id="filterGI" class="btn btn-primary w-100">Filter</button>
                    </div>
                </div> --}}
                <div style="overflow-y: auto;">
                    <h2 class="mt-2">Laporan Kelengkapan Data Aset dan Data Pelanggan</h2>
                    <form action="/hapusPelangganAPP" method="post">
                        @csrf
                        @method('delete')
                        <a href="#" class="btn btn-danger col-12 mb-2" data-bs-toggle="modal"
                            data-bs-target="#modal-delete-pelanggan">
                            <i class="fa-solid fa-trash fa-lg" style="margin-right: 5px;"></i> Hapus Pelanggan
                        </a>
                        <div class="modal modal-blur fade" id="modal-delete-pelanggan" tabindex="-1" role="dialog"
                            aria-hidden="true">
                            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                    <div class="modal-status bg-danger"></div>
                                    <div class="modal-body text-center py-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                                            <path d="M12 9v4" />
                                            <path d="M12 17h.01" />
                                        </svg>
                                        <h3>Apakah anda yakin?</h3>
                                        <div class="text-muted">Untuk menghapus pelanggan tersebut</div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="w-100">
                                            <div class="row">
                                                <div class="col"><a href="#" class="btn w-100"
                                                        data-bs-dismiss="modal">
                                                        Cancel
                                                    </a></div>
                                                <div class="col"><button type="submit" class="btn btn-danger w-100"
                                                        data-bs-dismiss="modal">
                                                        Delete
                                                    </button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table-bordered tabel-app mt-2 display" id="tabel-kelengkapan-data-asset">
                            <thead class="text-light" style="background:linear-gradient(#780206, #061161)">
                                <tr>
                                    {{-- <th>Tanggal Pasang</th> --}}
                                    <th>
                                        <div class="d-flex justify-content-center">
                                            <div class="form-check">
                                                <input class="form-check-input mt-2" style="position:relative; left:10px;"
                                                    type="checkbox" id="checklist-pelanggan-app"
                                                    onclick="checkAllPelangganAPP()">
                                            </div>
                                        </div>
                                    </th>
                                    <th>ID Pelanggan</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data_pelanggan_app as $app)
                                    @if (!empty($app->id_pelanggan))
                                        <tr>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="{{ $app->id }}" id="flexCheckDefault"
                                                            name="checkPelangganAPP[]">
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- <td>{{ $app->tanggal_pasang }}</td> --}}
                                            <td>{{ $app->id_pelanggan }}</td>
                                            <td>{{ $app->nama_pelanggan }}</td>
                                            <td>
                                                <a href="#" data-bs-target="#{{ $app->id }}"
                                                    data-bs-toggle="modal">
                                                    <i class="fa-solid fa-circle-info fa-lg text-primary"></i>
                                                </a>
                                                <div class="modal modal-blur fade" id="{{ $app->id }}"
                                                    tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">{{ $app->nama_pelanggan }}</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="mb-3 col-lg-12">
                                                                        <label class="form-label">Tanggal Pasang</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input type="text"
                                                                                value="{{ $app->tanggal_pasang }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-12">
                                                                        <label class="form-label">ID Pelanggan</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input type="text"
                                                                                value="{{ $app->id_pelanggan }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-12">
                                                                        <label class="form-label">Nama
                                                                            Pelanggan</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input type="text"
                                                                                value="{{ $app->nama_pelanggan }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-12">
                                                                        <label class="form-label">Tarif</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input type="text"
                                                                                value="{{ $app->tarif }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-12">
                                                                        <label class="form-label">Daya</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input type="text"
                                                                                value="{{ $app->daya }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-12">
                                                                        <label class="form-label">Alamat</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input type="text"
                                                                                value="{{ $app->alamat }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-12">
                                                                        <label class="form-label">Latitude</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input type="text"
                                                                                value="{{ $app->latitude }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-12">
                                                                        <label class="form-label">Longitude</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input type="text"
                                                                                value="{{ $app->longitude }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-12">
                                                                        <label class="form-label">Jenis Meter</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input type="text"
                                                                                value="{{ $app->jenis_meter }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-12">
                                                                        <label class="form-label">Merk Meter</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input type="text"
                                                                                value="{{ $app->merk_meter }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-12">
                                                                        <label class="form-label">Tahun Meter</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input type="text"
                                                                                value="{{ $app->tahun_meter }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-12">
                                                                        <label class="form-label">Nomor Meter</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input type="text"
                                                                                value="{{ $app->nomor_meter }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-12">
                                                                        <label class="form-label">Merk MCB</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input type="text"
                                                                                value="{{ $app->merk_mcb }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-12">
                                                                        <label class="form-label">Nomor Segel</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input type="text"
                                                                                value="{{ $app->no_segel }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-12">
                                                                        <label class="form-label">Nomor Gardu</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input type="text"
                                                                                value="{{ $app->no_gardu }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-12">
                                                                        <label class="form-label">Tarikan SR ke</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input type="text"
                                                                                value="{{ $app->sr_deret }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-12">
                                                                        <label class="form-label">Catatan</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input type="text"
                                                                                value="{{ $app->catatan }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-12">
                                                                        <label class="form-label">Nama Petugas</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input type="text"
                                                                                value="{{ $app->nama_petugas }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            {{-- <div class="col-lg-3">
                <canvas id="giDayaChart" width="10" height="10"></canvas>
            </div> --}}
        </div>
    </div>
    <script>
        $(document).ready(function() {
            function template_tabel(nama_tabel) {
                $(nama_tabel).DataTable({
                    'pageLength': 10,
                    'lengthMenu': [10, 25, 50, 100, 200, 500, 2000],
                    'order': [
                        [0, 'asc']
                    ]
                });
            }

            template_tabel('#tabel-kelengkapan-data-asset');
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function checkboxGroup(checklistAllParam, checkboxesParam) {
                var checkboxGroups = [{
                    checklistAll: document.getElementById(checklistAllParam),
                    checkboxes: document.querySelectorAll(checkboxesParam)
                }, ];

                checkboxGroups.forEach(function(group) {
                    group.checklistAll.addEventListener("change", function() {
                        group.checkboxes.forEach(function(checkbox) {
                            checkbox.checked = group.checklistAll.checked;
                        });
                    });
                });
            }
            checkboxGroup("checklist-pelanggan-app", 'input[name="checkPelangganAPP[]"]');
        });
    </script>
@endsection
