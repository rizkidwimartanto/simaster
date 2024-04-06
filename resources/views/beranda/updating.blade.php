@extends('layout/templateberanda')
@section('content')
    <div class="container-fluid mt-3">
        @if (session('success_import'))
            <div class="alert alert-success">
                <h3>{{ session('success_import') }}</h3>
            </div>
        @endif
        @if (session('success_hapus_pelanggan'))
            <div class="alert alert-success">
                <h3> {{ session('success_hapus_pelanggan') }}</h3>
            </div>
        @endif
        @if (session('error_import'))
            <div class="alert alert-danger">
                <h3>{{ session('error_import') }}</h3>
            </div>
        @endif
        @if (session('validate_file'))
            <div class="alert alert-danger">
                <h3>{{ session('validate_file') }}</h3>
            </div>
        @endif
        @if (session('error_hapus_pelanggan'))
            <div class="alert alert-danger">
                <h3>{{ session('error_hapus_pelanggan') }}</h3>
            </div>
        @endif
        <div class="col-lg-12">
            <div class="card p-3 mt-4">
                <form method="post" action="/entripadam/import_excel_penyulangsection" enctype="multipart/form-data">
                    @csrf
                    <div class="form-label fs-2">Upload File Penyulang</div>
                    <input type="file" name="file_penyulang" class="form-control" required />
                    <div class="form-label mt-2 fs-2">Upload File Section</div>
                    <input type="file" name="file_section" class="form-control" required />
                    <button type="submit" class="btn btn-primary mt-3 mb-3 col-lg-2"><i class="fa-solid fa-upload fa-lg"
                            style="margin-right: 5px"></i>Import Excel</button>
                </form>
            </div>
        </div>
        <div class="card p-3 mt-4">
            <form method="post" action="/updating/import_excel" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-label fs-2">Upload File Pelanggan</div>
                <input type="file" name="file" class="form-control" required />
                <button type="submit" class="btn btn-primary mt-3 mb-3 col-lg-2"><i class="fa-solid fa-upload fa-lg"
                        style="margin-right: 5px"></i>Import Excel Pelanggan</button>
                <a href="/updating/export_excel_pelanggan" class="btn btn-warning mt-3 mb-3 col-lg-2"><i
                        class="fa-solid fa-download fa-lg" style="margin-right: 5px"></i>Export Excel Pelanggan</a>
            </form>
            <a href="#" class="btn btn-danger col-sm-4 mb-2 button-delete-pegawai" data-bs-toggle="modal"
                data-bs-target="#modal-delete-pegawai">
                <i class="fa-solid fa-trash fa-lg" style="margin-right: 5px;"></i> Hapus Pelanggan
            </a>
            <div class="modal modal-blur fade" id="modal-delete-pegawai" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="modal-status bg-danger"></div>
                        <div class="modal-body text-center py-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
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
                                    <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
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
            <div class="col-lg-12">
                <table class="table table-vcenter table-bordered table-hover table-success" id="tabel_data_pelanggan"
                    style="width: 100%">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="2%">
                                <div class="d-flex justify-content-center">
                                    <div class="form-check">
                                        <input class="form-check-input mt-2" style="position:relative; left:10px;"
                                            type="checkbox" id="checklist-pelanggan" onclick="checkAllPelanggan()">
                                    </div>
                                </div>
                            </th>
                            <th width="5%">Aksi</th>
                            <th width="5%">ID Pelanggan</th>
                            <th width="23%">Nama</th>
                            <th width="35%">Alamat</th>
                            <th width="25%">Maps</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($data_pelanggan as $s)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $s->id }}"
                                                id="flexCheckDefault" name="checkPelanggan[]">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="#" data-bs-target="#{{ $s->id }}" data-bs-toggle="modal">
                                        <i class="fa-solid fa-circle-info fa-lg text-primary"></i>
                                    </a>
                                    <a href="#" data-bs-target="#edit-{{ $s->id }}" data-bs-toggle="modal">
                                        <i class="fa-solid fa-pen-to-square fa-lg text-dark"></i>
                                    </a>
                                    <div class="modal modal-blur fade" id="{{ $s->id }}" tabindex="-1"
                                        role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ $s->nama }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="mb-3 col-lg-12">
                                                            <label class="form-label">Nama Pelanggan</label>
                                                            <div class="input-group input-group-flat">
                                                                <input value="{{ $s->nama }}" class="form-control"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Alamat</label>
                                                            <div class="input-group input-group-flat">
                                                                <textarea class="form-control" name="alamat" rows="5" readonly>{{ $s->alamat }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-12">
                                                            <label class="form-label">No HP StakeHolder</label>
                                                            <div class="input-group input-group-flat">
                                                                <input value="{{ $s->nohp_stakeholder }}"
                                                                    class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-12">
                                                            <label class="form-label">No HP PIC Lapangan</label>
                                                            <div class="input-group input-group-flat">
                                                                <input value="{{ $s->nohp_piclapangan }}"
                                                                    class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <label class="form-label">Latitude</label>
                                                            <div class="input-group input-group-flat">
                                                                <input value="{{ $s->latitude }}" class="form-control"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <label class="form-label">Longtitude</label>
                                                            <div class="input-group input-group-flat">
                                                                <input value="{{ $s->longtitude }}" class="form-control"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <label class="form-label">Unit ULP</label>
                                                            <div class="input-group input-group-flat">
                                                                <?php if ($s->unitulp == 52550) : ?>
                                                                <input value="UP3 Demak" class="form-control" readonly>
                                                                <?php elseif($s->unitulp == 52551) : ?>
                                                                <input value="ULP Demak" class="form-control" readonly>
                                                                <?php elseif($s->unitulp == 52552) : ?>
                                                                <input value="ULP Tegowanu" class="form-control" readonly>
                                                                <?php elseif($s->unitulp == 52553) : ?>
                                                                <input value="ULP Purwodadi" class="form-control"
                                                                    readonly>
                                                                <?php elseif($s->unitulp == 52554) : ?>
                                                                <input value="ULP Wirosari" class="form-control" readonly>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <label class="form-label">Tarif</label>
                                                            <div class="input-group input-group-flat">
                                                                <input value="{{ $s->tarif }}" class="form-control"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <label class="form-label">Daya</label>
                                                            <div class="input-group input-group-flat">
                                                                <input value="{{ $s->daya }}" class="form-control"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <label class="form-label">KOGOL</label>
                                                            <div class="input-group input-group-flat">
                                                                <input value="{{ $s->kogol }}" class="form-control"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <label class="form-label">fakmkwh</label>
                                                            <div class="input-group input-group-flat">
                                                                <input value="{{ $s->fakmkwh }}" class="form-control"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <label class="form-label">rpbp</label>
                                                            <div class="input-group input-group-flat">
                                                                <input value="{{ $s->rpbp }}" class="form-control"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <label class="form-label">rpujl</label>
                                                            <div class="input-group input-group-flat">
                                                                <input value="{{ $s->rpujl }}" class="form-control"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <label class="form-label">nomor_kwh</label>
                                                            <div class="input-group input-group-flat">
                                                                <input value="{{ $s->nomor_kwh }}" class="form-control"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <label class="form-label">penyulang</label>
                                                            <div class="input-group input-group-flat">
                                                                <input value="{{ $s->penyulang }}" class="form-control"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-12">
                                                            <label class="form-label">nama_section</label>
                                                            <div class="input-group input-group-flat">
                                                                <textarea class="form-control" name="nama_section" rows="3" readonly>{{ $s->nama_section }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-12">
                                                            <label class="form-label">Kali Padam</label>
                                                            <div class="input-group input-group-flat">
                                                                @if ($s->entriPadam)
                                                                    <input value="{{ $s->entriPadam->kalipadam }}"
                                                                        class="form-control" readonly>
                                                                @else
                                                                    <input value="{{ 0 }}"
                                                                        class="form-control" readonly>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger me-auto"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="/updating/edit_pelanggan/{{ $s->id }}" method="post">
                                        @csrf
                                        <div class="modal modal-blur fade" id="edit-{{ $s->id }}" tabindex="-1"
                                            role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Pelanggan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="mb-3 col-lg-12">
                                                                <label class="form-label">Nama Pelanggan</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->nama }}"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Alamat</label>
                                                                <div class="input-group input-group-flat">
                                                                    <textarea class="form-control" name="alamat" rows="5">{{ $s->alamat }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-12">
                                                                <label class="form-label">No HP StakeHolder</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->nohp_stakeholder }}"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-12">
                                                                <label class="form-label">No HP PIC Lapangan</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->nohp_piclapangan }}"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-4">
                                                                <label class="form-label">Latitude</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->latitude }}"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-4">
                                                                <label class="form-label">Longtitude</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->longtitude }}"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-4">
                                                                <label class="form-label">Unit ULP</label>
                                                                <div class="input-group input-group-flat">
                                                                    <?php if ($s->unitulp == 52550) : ?>
                                                                    <input value="UP3 Demak" class="form-control">
                                                                    <?php elseif($s->unitulp == 52551) : ?>
                                                                    <input value="ULP Demak" class="form-control">
                                                                    <?php elseif($s->unitulp == 52552) : ?>
                                                                    <input value="ULP Tegowanu" class="form-control">
                                                                    <?php elseif($s->unitulp == 52553) : ?>
                                                                    <input value="ULP Purwodadi" class="form-control">
                                                                    <?php elseif($s->unitulp == 52554) : ?>
                                                                    <input value="ULP Wirosari" class="form-control">
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-4">
                                                                <label class="form-label">Tarif</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->tarif }}"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-4">
                                                                <label class="form-label">Daya</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->daya }}"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-4">
                                                                <label class="form-label">KOGOL</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->kogol }}"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-4">
                                                                <label class="form-label">fakmkwh</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->fakmkwh }}"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-4">
                                                                <label class="form-label">rpbp</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->rpbp }}"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-4">
                                                                <label class="form-label">rpujl</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->rpujl }}"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-4">
                                                                <label class="form-label">nomor_kwh</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->nomor_kwh }}"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-4">
                                                                <label class="form-label">penyulang</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->penyulang }}"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-12">
                                                                <label class="form-label">nama_section</label>
                                                                <div class="input-group input-group-flat">
                                                                    <textarea class="form-control" name="nama_section" rows="3">{{ $s->nama_section }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-12">
                                                                <label class="form-label">Kali Padam</label>
                                                                <div class="input-group input-group-flat">
                                                                    @if ($s->entriPadam)
                                                                        <input value="{{ $s->entriPadam->kalipadam }}"
                                                                            class="form-control">
                                                                    @else
                                                                        <input value="{{ 0 }}"
                                                                            class="form-control">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-info"
                                                            data-bs-dismiss="modal">Edit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td>{{ $s->idpel }}</td>
                                <td>{{ $s->nama }}</td>
                                <td>{{ $s->alamat }}</td>
                                <td><a href="{{ $s->maps }}" target="_blank">{{ $s->maps }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card p-3 mt-4">
            <form method="post" action="/updating/import_excel_trafo" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-label fs-2">Upload File Trafo</div>
                <input type="file" name="file" class="form-control" required />
                <button type="submit" class="btn btn-primary mt-3 mb-3 col-lg-2"><i class="fa-solid fa-upload fa-lg"
                        style="margin-right: 5px"></i>Import Excel Trafo</button>
                {{-- <a href="/updating/export_excel_trafo" class="btn btn-warning mt-3 mb-3 col-lg-2"><i
                        class="fa-solid fa-download fa-lg" style="margin-right: 5px"></i>Export Excel Trafo</a> --}}
            </form>
            <form action="/hapus_pelanggan" method="post">
                @csrf
                @method('delete')
                {{-- <a href="#" class="btn btn-danger col-sm-4 mb-2 button-delete-pegawai" data-bs-toggle="modal"
                    data-bs-target="#modal-delete-pegawai">
                    <i class="fa-solid fa-trash fa-lg" style="margin-right: 5px;"></i> Hapus Pelanggan
                </a>
                <div class="modal modal-blur fade" id="modal-delete-pegawai" tabindex="-1" role="dialog"
                    aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            <div class="modal-status bg-danger"></div>
                            <div class="modal-body text-center py-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                                        <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
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
                </div> --}}
                <div class="col-lg-12">
                    <table class="table table-vcenter table-bordered table-hover table-success" id="tabel_data_trafo"
                        style="width: 100%">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="2%">
                                    <div class="d-flex justify-content-center">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" style="position:relative; left:10px;"
                                                type="checkbox" id="checklist-pelanggan" onclick="checkAllPelanggan()">
                                        </div>
                                    </div>
                                </th>
                                <th width="5%">Aksi</th>
                                <th width="20%">Unit Layanan</th>
                                <th width="18%">Penyulang</th>
                                <th width="25%">No Tiang</th>
                                <th width="25%">Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($data_trafo as $s)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="{{ $s->id }}" id="flexCheckDefault"
                                                    name="checkPelanggan[]">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" data-bs-target="#trafo-{{ $s->id }}"
                                            data-bs-toggle="modal">
                                            <i class="fa-solid fa-circle-info fa-lg text-primary"></i>
                                        </a>
                                        <div class="modal modal-blur fade" id="trafo-{{ $s->id }}" tabindex="-1"
                                            role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">{{ $s->penyulang }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="mb-3 col-lg-4">
                                                                <label class="form-label">Unit Layanan</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->unit_layanan }}"
                                                                        class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-4">
                                                                <label class="form-label">Penyulang</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->penyulang }}"
                                                                        class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-4">
                                                                <label class="form-label">Nomor Tiang</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->no_tiang }}"
                                                                        class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-4">
                                                                <label class="form-label">Daya</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->daya }}"
                                                                        class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-4">
                                                                <label class="form-label">Merk</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->merk }}"
                                                                        class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-4">
                                                                <label class="form-label">Beban X1</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->beban_X1 }}"
                                                                        class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-4">
                                                                <label class="form-label">Beban X2</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->beban_X2 }}"
                                                                        class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-4">
                                                                <label class="form-label">Beban Xo</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->beban_Xo }}"
                                                                        class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-4">
                                                                <label class="form-label">Lokasi</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->lokasi }}"
                                                                        class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-4">
                                                                <label class="form-label">penyebab</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->penyebab }}"
                                                                        class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-4">
                                                                <label class="form-label">No APKT</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->no_pk_apkt }}"
                                                                        class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-lg-4">
                                                                <label class="form-label">Beban (A)</label>
                                                                <div class="input-group input-group-flat">
                                                                    <input value="{{ $s->bebanA }}"
                                                                        class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger me-auto"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $s->unit_layanan }}</td>
                                    <td>{{ $s->penyulang }}</td>
                                    <td>{{ $s->no_tiang }}</td>
                                    <td>{{ $s->lokasi }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#tabel_data_pelanggan').DataTable({
                scrollX: true,
                scrollCollapse: true,
                fixedColumns: true,
                'pageLength': 10,
                'lengthMenu': [10, 25, 50, 100, 200, 500],
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#tabel_data_trafo').DataTable({
                scrollX: true,
                scrollCollapse: true,
                fixedColumns: true,
                'pageLength': 10,
                'lengthMenu': [10, 25, 50, 100, 200, 500],
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var checkboxGroups = [{
                checklistAll: document.getElementById("checklist-pelanggan"),
                checkboxes: document.querySelectorAll('input[name="checkPelanggan[]"]')
            }, ];

            checkboxGroups.forEach(function(group) {
                group.checklistAll.addEventListener("change", function() {
                    group.checkboxes.forEach(function(checkbox) {
                        checkbox.checked = group.checklistAll.checked;
                    });
                });
            });
        });
    </script>
@endsection
