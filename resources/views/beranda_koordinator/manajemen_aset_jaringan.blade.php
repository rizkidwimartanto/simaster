@extends('layout/templateberanda_koordinator')
@section('content')
    <div class="container-fluid mt-2">
        <form method="post" action="/koordinator/import_excel_data_aset" enctype="multipart/form-data">
            @csrf
            <div class="form-label fs-2">Upload File Excel Manajemen Aset Jaringan</div>
            <input type="file" name="file_data_aset" id="file_data_aset" class="form-control" required />
            <div class="row">
                <button type="submit" class="btn btn-primary mt-2 mb-3 col-lg-6"><i class="fa-solid fa-upload fa-lg"
                        style="margin-right: 5px"></i>Import
                    Excel</button>
                <a href="/file_data_aset/template_recloser_lbs/Data Label.xlsx"
                    class="btn btn-success mt-2 mb-3 col-lg-6"><i class="fa-solid fa-download fa-lg"
                        style="margin-right: 5px"></i>Template
                    Excel</a>
            </div>
        </form>
        <button type="button" class="btn btn-info mb-3 col-12" data-bs-toggle="modal" data-bs-target="#modalTambahaset"><i
                class="fa-solid fa-circle-plus fa-lg" style="margin-right: 5px;"></i>
            Tambah Data Manajemen Aset Jaringan
        </button>
        <div class="modal fade" id="modalTambahaset" tabindex="-1" aria-labelledby="modalTambahasetLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form action="/aset/proses_tambah_aset" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-3" id="modalTambahasetLabel">Tambah Data aset
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-4">
                                <label class="form-label">Jenis aset</label>
                                <div class="input-group input-group-flat">
                                    <input class="form-control" name="kms_jtm" id="kms_jtm" type="text">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Nomor Tiang</label>
                                <div class="input-group input-group-flat">
                                    <input class="form-control" name="kms_jtr" id="kms_jtr" type="text">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Status aset</label>
                                <div class="input-group input-group-flat">
                                    <input class="form-control" name="status_aset" id="status_aset" type="text">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Kondisi aset</label>
                                <div class="input-group input-group-flat">
                                    <input class="form-control" name="kondisi_aset" id="kondisi_aset" type="text">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Merk</label>
                                <div class="input-group input-group-flat">
                                    <input class="form-control" name="merk" id="merk" type="text">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Nomor Seri</label>
                                <div class="input-group input-group-flat">
                                    <input class="form-control" name="no_seri" id="no_seri" type="text">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Setting OCR</label>
                                <div class="input-group input-group-flat">
                                    <input class="form-control" name="setting_ocr" id="setting_ocr" type="text">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Setting GFR</label>
                                <div class="input-group input-group-flat">
                                    <input class="form-control" name="setting_gfr" id="setting_gfr" type="text">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Setting Grup Aktif</label>
                                <div class="input-group input-group-flat">
                                    <input class="form-control" name="setting_grupaktif" id="setting_grupaktif"
                                        type="text">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Alamat</label>
                                <div class="input-group input-group-flat">
                                    <input class="form-control" name="alamat" id="alamat" type="text">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Tanggal HAR</label>
                                <div class="input-group input-group-flat">
                                    <input class="form-control" name="tanggal_har" id="tanggal_har" type="date">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Tanggal Pasang</label>
                                <div class="input-group input-group-flat">
                                    <input class="form-control" name="tanggal_pasang" id="tanggal_pasang"
                                        type="date">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div style="overflow-y: auto;">
            <table class="table-bordered tabel-app mt-2 display" id="tabel-aset">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ULP</th>
                        <th>KMS JTM</th>
                        <th>KMS JTR</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data_aset as $aset)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $aset->ulp }}</td>
                            <td>{{ $aset->kms_jtm }}</td>
                            <td>{{ $aset->kms_jtr }}</td>
                            <td>
                                <a href="/info_aset/{{ $aset->id }}">
                                    <i class="fa-solid text-secondary fa-circle-info fa-lg"></i>
                                </a>
                                <a href="#" data-bs-target="#{{ $aset->id }}" data-bs-toggle="modal">
                                    <i class="fa-solid fa-edit fa-lg text-primary"></i>
                                </a>
                                <div class="modal fade" id="{{ $aset->id }}" tabindex="-1"
                                    aria-labelledby="modalTambahasetLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="/edit_aset/{{ $aset->id }}" method="post">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-3" id="modalTambahasetLabel">Edit
                                                        Data
                                                        aset
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save
                                                        changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <a href="#" class="col-12 mb-2" data-bs-toggle="modal"
                                    data-bs-target="#modal-delete-pelangganapp">
                                    <i class="fa-solid fa-trash fa-lg text-danger" style="margin-right: 5px;"></i>
                                </a>
                                <div class="modal modal-blur fade" id="modal-delete-pelangganapp" tabindex="-1"
                                    role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="/delete_aset/{{ $aset->id }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                                <div class="modal-status bg-danger"></div>
                                                <div class="modal-body text-center py-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon mb-2 text-danger icon-lg" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
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
                                                            <div class="col"><button type="submit"
                                                                    class="btn btn-danger w-100" data-bs-dismiss="modal">
                                                                    Delete
                                                                </button></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            function template_tabel(nama_tabel) {
                $(nama_tabel).DataTable({
                    'pageLength': 10,
                    'lengthMenu': [10, 25, 50, 100, 200, 500],
                });
            }

            template_tabel('#tabel-aset');
        });
    </script>
    </div>
@endsection
