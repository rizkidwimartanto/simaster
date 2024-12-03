@extends('layout/templateberanda_mitra')
@section('content')
    <div class="container-fluid mt-2">
		        @if (session('success_edit_mitraup3'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h3> {{ session('success_edit_mitraup3') }}
                </h3>
            </div>
        @endif
        @if (session('success_error_mitraup3'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h3> {{ session('error_edit_mitraup3') }}
                </h3>
            </div>
        @endif
        <div style="overflow-y: auto;">
            <table class="display mt-2 table-bordered" id="tabel_rise_pole">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Penyulang</th>
                        <th>ABSW</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data_keypoint as $keypoint)
                        @if ($keypoint->jenis_keypoint === 'Rise Pole')
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $keypoint->penyulang }}</td>
                                <td>{{ $keypoint->absw }}</td>
                                <td>
                                    <a href="/info_keypoint/{{ $keypoint->id }}">
                                        <i class="fa-solid text-secondary fa-circle-info fa-lg"></i>
                                    </a>
                                    <a href="#" data-bs-target="#{{ $keypoint->id }}" data-bs-toggle="modal">
                                        <i class="fa-solid fa-edit fa-lg text-primary"></i>
                                    </a>
                                    <div class="modal fade" id="{{ $keypoint->id }}" tabindex="-1"
                                        aria-labelledby="modalTambahKeypointLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="/edit_keypoint/{{ $keypoint->id }}" method="post">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-3" id="modalTambahKeypointLabel">Edit Data
                                                            Keypoint
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-4">
                                                            <label class="form-label">Jenis Keypoint</label>
                                                            <div class="input-group input-group-flat">
                                                                <input class="form-control" name="jenis_keypoint"
                                                                    id="jenis_keypoint" type="text"
                                                                    value="{{ $keypoint->jenis_keypoint }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="form-label">Nomor Tiang</label>
                                                            <div class="input-group input-group-flat">
                                                                <input class="form-control" name="nomor_tiang"
                                                                    id="nomor_tiang" type="text"
                                                                    value="{{ $keypoint->nomor_tiang }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="form-label">Status Keypoint</label>
                                                            <div class="input-group input-group-flat">
                                                                <input class="form-control" name="status_keypoint"
                                                                    id="status_keypoint" type="text"
                                                                    value="{{ $keypoint->status_keypoint }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="form-label">Kondisi Keypoint</label>
                                                            <div class="input-group input-group-flat">
                                                                <input class="form-control" name="kondisi_keypoint"
                                                                    id="kondisi_keypoint"
                                                                    value="{{ $keypoint->kondisi_keypoint }}"
                                                                    type="text">
                                                            </div>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="form-label">Merk</label>
                                                            <div class="input-group input-group-flat">
                                                                <input class="form-control" name="merk" id="merk"
                                                                    type="text" value="{{ $keypoint->merk }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="form-label">Nomor Seri</label>
                                                            <div class="input-group input-group-flat">
                                                                <input class="form-control" name="no_seri" id="no_seri"
                                                                    type="text" value="{{ $keypoint->no_seri }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="form-label">Setting OCR</label>
                                                            <div class="input-group input-group-flat">
                                                                <input class="form-control" name="setting_ocr"
                                                                    id="setting_ocr" type="text"
                                                                    value="{{ $keypoint->setting_ocr }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="form-label">Setting GFR</label>
                                                            <div class="input-group input-group-flat">
                                                                <input class="form-control" name="setting_gfr"
                                                                    id="setting_gfr" type="text"
                                                                    value="{{ $keypoint->setting_gfr }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="form-label">Setting Grup Aktif</label>
                                                            <div class="input-group input-group-flat">
                                                                <input class="form-control" name="setting_grupaktif"
                                                                    id="setting_grupaktif"
                                                                    value="{{ $keypoint->setting_grupaktif }}"
                                                                    type="text">
                                                            </div>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="form-label">Alamat</label>
                                                            <div class="input-group input-group-flat">
                                                                <input class="form-control" name="alamat" id="alamat"
                                                                    type="text" value="{{ $keypoint->alamat }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="form-label">Tanggal HAR</label>
                                                            <div class="input-group input-group-flat">
                                                                <input class="form-control" name="tanggal_har"
                                                                    id="tanggal_har" type="date"
                                                                    value="{{ $keypoint->tanggal_har }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="form-label">Tanggal Pasang</label>
                                                            <div class="input-group input-group-flat">
                                                                <input class="form-control" name="tanggal_pasang"
                                                                    id="tanggal_pasang" type="date"
                                                                    value="{{ $keypoint->tanggal_pasang }}">
                                                            </div>
                                                        </div>
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
                                                <form action="/delete_keypoint/{{ $keypoint->id }}" method="post">
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
                                                                        class="btn btn-danger w-100"
                                                                        data-bs-dismiss="modal">
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
                        @endif
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

            template_tabel('#tabel_rise_pole');
        });
    </script>
@endsection
