@extends('layout/templateberanda')
@section('content')
    <div class="container-fluid mt-3">
        @if (session('success_import'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h3>{{ session('success_import') }}</h3>
            </div>
        @endif
        @if (session('success_hapus'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h3> {{ session('success_hapus') }}</h3>
            </div>
        @endif
        @if (session('success_edit'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h3> {{ session('success_edit') }}</h3>
            </div>
        @endif
        @if (session('success_tambah_wanotif'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h3> {{ session('success_tambah_wanotif') }}</h3>
            </div>
        @endif
        @if (session('success_tambah_dataunit'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h3> {{ session('success_tambah_dataunit') }}</h3>
            </div>
        @endif
        @if (session('success_edit_unit'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h3> {{ session('success_edit_unit') }}</h3>
            </div>
        @endif
        @if (session('success_edit_wanotif'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h3> {{ session('success_edit_wanotif') }}</h3>
            </div>
        @endif
        @if (session('error_import'))
            <div class="alert alert-danger">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h3>{{ session('error_import') }}</h3>
            </div>
        @endif
        @if (session('error_tambah_unit'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h3>{{ session('error_tambah_unit') }}</h3>
            </div>
        @endif
        @if (session('error_tambah_wanotif'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h3>{{ session('error_tambah_wanotif') }}</h3>
            </div>
        @endif
        @if (session('error_edit_unit'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h3>{{ session('error_edit_unit') }}</h3>
            </div>
        @endif
        @if (session('validate_file'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h3>{{ session('validate_file') }}</h3>
            </div>
        @endif
        @if (session('error_hapus'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h3>{{ session('error_hapus') }}</h3>
            </div>
        @endif
        @if (session('error_edit'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h3>{{ session('error_edit') }}</h3>
            </div>
        @endif
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="card border border-warning">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold bg-warning text-light fs-3" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapsePenyulangSection" aria-expanded="false"
                            aria-controls="collapsePenyulangSection">
                            Penyulang & Section
                        </button>
                    </h2>
                    <div id="collapsePenyulangSection" class="accordion-collapse collapse show"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <form method="post" action="/entripadam/import_excel_penyulangsection"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-label fs-2">Upload File Penyulang</div>
                                <input type="file" name="file_penyulang" class="form-control" required />
                                <div class="form-label mt-2 fs-2">Upload File Section</div>
                                <input type="file" name="file_section" class="form-control" required />
                                <button type="submit" class="btn btn-primary mt-1 mb-3 col-lg-3"><i
                                        class="fa-solid fa-upload fa-lg" style="margin-right: 5px"></i>Import
                                    Excel</button>
                                <a href="file_penyulang/template_penyulang/penyulang dummy.xlsx"
                                    class="btn btn-success mt-1 mb-3 col-lg-3"><i class="fa-solid fa-download fa-lg"
                                        style="margin-right: 5px"></i>Template Excel Penyulang</a>
                                <a href="file_section/template_section/section dummyy.xlsx"
                                    class="btn btn-secondary mt-1 mb-3 col-lg-3"><i class="fa-solid fa-download fa-lg"
                                        style="margin-right: 5px"></i>Template Excel Section</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border border-info mt-2">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold bg-info text-light fs-3" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapsePelanggan" aria-expanded="false"
                            aria-controls="collapsePelanggan">
                            Data Pelanggan
                        </button>
                    </h2>
                    <div id="collapsePelanggan" class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <form method="post" action="/updating/import_excel" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-label fs-2">Upload File Pelanggan</div>
                                <input type="file" name="file" class="form-control" required />
                                <button type="submit" class="btn btn-primary mt-1 mb-3 col-lg-3"><i
                                        class="fa-solid fa-upload fa-lg" style="margin-right: 5px"></i>Import Excel
                                </button>
                                <a href="/updating/export_excel_pelanggan" class="btn btn-warning mt-1 mb-3 col-lg-3"><i
                                        class="fa-solid fa-file-export fa-lg" style="margin-right: 5px"></i>Export Excel
                                </a>
                                <a href="file_pelanggan/template_pelanggan/Pelanggan TM.xlsx"
                                    class="btn btn-success mt-1 mb-3 col-lg-3"><i class="fa-solid fa-download fa-lg"
                                        style="margin-right: 5px"></i>Template Excel</a>
                            </form>
                            {{-- <form action="/updating/hapus_pelanggan" method="get">
                            @csrf
                            @method('delete')
                            <a href="#" class="btn btn-danger col-sm-4 mb-2 button-delete-pelanggan" data-bs-toggle="modal"
                                data-bs-target="#modal-delete-pelanggan">
                                <i class="fa-solid fa-trash fa-lg" style="margin-right: 5px;"></i> Hapus Pelanggan
                            </a>
                            <div class="modal modal-blur fade" id="modal-delete-pelanggan" tabindex="-1" role="dialog"
                                aria-hidden="true">
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
                            </div> --}}
                            <table class="table table-vcenter table-bordered table-hover table-success"
                                id="tabel_data_pelanggan" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th style="width: 5%">
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check">
                                                    <input class="form-check-input mt-2"
                                                        style="position:relative; left:10px;" type="checkbox"
                                                        id="checklist-pelanggan" onclick="checkAllPelanggan()">
                                                </div>
                                            </div>
                                        </th>
                                        <th style="width: 15%">ID Pelanggan</th>
                                        <th style="width: 25%">Nama</th>
                                        <th style="width: 35%">Alamat</th>
                                        <th style="width: 15%">Maps</th>
                                        <th style="width: 5%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($data_pelanggan as $s)
                                        <tr>
                                            <td style="width: 5%">{{ $i++ }}</td>
                                            <td style="width: 5%">
                                                <div class="d-flex justify-content-center">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="{{ $s->id }}" id="flexCheckDefault"
                                                            name="checkPelanggan[]">
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="width: 15%">{{ $s->idpel }}</td>
                                            <td style="width: 25%">{{ $s->nama }}</td>
                                            <td style="width: 35%">{{ $s->alamat }}</td>
                                            <td style="width: 15%"><a href="{{ $s->maps }}"
                                                    target="_blank">{{ $s->maps }}</a></td>
                                            <td style="width: 5%">
                                                <a href="#" data-bs-target="#{{ $s->id }}"
                                                    data-bs-toggle="modal">
                                                    <i class="fa-solid fa-circle-info fa-lg text-primary"></i>
                                                </a>
                                                <a href="#" data-bs-target="#edit-{{ $s->id }}"
                                                    data-bs-toggle="modal">
                                                    <i class="fa-solid fa-pen-to-square fa-lg text-dark"></i>
                                                </a>
                                                {{-- </form> --}}
                                                <div class="modal modal-blur fade" id="{{ $s->id }}"
                                                    tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">{{ $s->nama }}</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="mb-3 col-lg-12">
                                                                        <label class="form-label">Nama
                                                                            Pelanggan</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input value="{{ $s->nama }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Alamat</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <textarea class="form-control" name="alamat" rows="5" readonly>{{ $s->alamat }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-12">
                                                                        <label class="form-label">No HP
                                                                            StakeHolder</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input value="{{ $s->nohp_stakeholder }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-12">
                                                                        <label class="form-label">No HP PIC
                                                                            Lapangan</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input value="{{ $s->nohp_piclapangan }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-4">
                                                                        <label class="form-label">Latitude</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input value="{{ $s->latitude }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-4">
                                                                        <label class="form-label">Longtitude</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input value="{{ $s->longtitude }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-4">
                                                                        <label class="form-label">Unit ULP</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <?php if ($s->unitulp == 52550) : ?>
                                                                            <input value="UP3 Demak" class="form-control"
                                                                                readonly>
                                                                            <?php elseif($s->unitulp == 52551) : ?>
                                                                            <input value="ULP Demak" class="form-control"
                                                                                readonly>
                                                                            <?php elseif($s->unitulp == 52552) : ?>
                                                                            <input value="ULP Tegowanu"
                                                                                class="form-control" readonly>
                                                                            <?php elseif($s->unitulp == 52553) : ?>
                                                                            <input value="ULP Purwodadi"
                                                                                class="form-control" readonly>
                                                                            <?php elseif($s->unitulp == 52554) : ?>
                                                                            <input value="ULP Wirosari"
                                                                                class="form-control" readonly>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-4">
                                                                        <label class="form-label">Tarif</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input value="{{ $s->tarif }}"
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
                                                                        <label class="form-label">KOGOL</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input value="{{ $s->kogol }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-4">
                                                                        <label class="form-label">fakmkwh</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input value="{{ $s->fakmkwh }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-4">
                                                                        <label class="form-label">rpbp</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input value="{{ $s->rpbp }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-4">
                                                                        <label class="form-label">rpujl</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input value="{{ $s->rpujl }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-4">
                                                                        <label class="form-label">nomor_kwh</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input value="{{ $s->nomor_kwh }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-lg-4">
                                                                        <label class="form-label">penyulang</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input value="{{ $s->penyulang }}"
                                                                                class="form-control" readonly>
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
                                                                                <input
                                                                                    value="{{ $s->entriPadam->kalipadam }}"
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
                                                <div class="modal modal-blur fade" id="edit-{{ $s->id }}"
                                                    tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                        <form action="/updating/edit_pelanggan/{{ $s->id }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Pelanggan</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <label class="form-label">Nama
                                                                                Pelanggan</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text" name="nama"
                                                                                    id="nama"
                                                                                    value="{{ $s->nama }}"
                                                                                    class="form-control @error('nama') is-invalid @enderror">
                                                                                @error('nama')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Alamat</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" rows="3">{{ $s->alamat }}</textarea>
                                                                                @error('alamat')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">No HP
                                                                                StakeHolder</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text"
                                                                                    name="nohp_stakeholder"
                                                                                    id="nohp_stakeholder"
                                                                                    value="{{ $s->nohp_stakeholder }}"
                                                                                    class="form-control @error('nohp_stakeholder') is-invalid @enderror">
                                                                                @error('nohp_stakeholder')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">No HP PIC
                                                                                Lapangan</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text"
                                                                                    name="nohp_piclapangan"
                                                                                    id="nohp_piclapangan"
                                                                                    value="{{ $s->nohp_piclapangan }}"
                                                                                    class="form-control @error('nohp_piclapangan') is-invalid @enderror">
                                                                                @error('nohp_piclapangan')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">Latitude</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text" name="latitude"
                                                                                    id="latitude"
                                                                                    value="{{ $s->latitude }}"
                                                                                    class="form-control @error('latitude') is-invalid @enderror">
                                                                                @error('latitude')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">Longtitude</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text" name="longtitude"
                                                                                    id="longtitude"
                                                                                    value="{{ $s->longtitude }}"
                                                                                    class="form-control @error('longtitude') is-invalid @enderror">
                                                                                @error('longtitude')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">Unit ULP</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <select name="unitulp" id="unitulp"
                                                                                    class="form-control @error('unitulp') is-invalid @enderror">
                                                                                    <option value="52550"
                                                                                        {{ $s->unitulp == 52550 ? 'selected' : '' }}>
                                                                                        UP3
                                                                                        Demak</option>
                                                                                    <option value="52551"
                                                                                        {{ $s->unitulp == 52551 ? 'selected' : '' }}>
                                                                                        ULP
                                                                                        Demak</option>
                                                                                    <option value="52552"
                                                                                        {{ $s->unitulp == 52552 ? 'selected' : '' }}>
                                                                                        ULP
                                                                                        Tegowanu</option>
                                                                                    <option value="52553"
                                                                                        {{ $s->unitulp == 52553 ? 'selected' : '' }}>
                                                                                        ULP
                                                                                        Purwodadi</option>
                                                                                    <option value="52554"
                                                                                        {{ $s->unitulp == 52554 ? 'selected' : '' }}>
                                                                                        ULP
                                                                                        Wirosari</option>
                                                                                </select>
                                                                                @error('unitulp')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">Tarif</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text" name="tarif"
                                                                                    id="tarif"
                                                                                    value="{{ $s->tarif }}"
                                                                                    class="form-control @error('tarif') is-invalid @enderror">
                                                                                @error('tarif')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">Daya</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text" name="daya"
                                                                                    id="daya"
                                                                                    value="{{ $s->daya }}"
                                                                                    class="form-control @error('daya') is-invalid @enderror">
                                                                                @error('daya')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">KOGOL</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text" name="kogol"
                                                                                    id="kogol"
                                                                                    value="{{ $s->kogol }}"
                                                                                    class="form-control @error('kogol') is-invalid @enderror">
                                                                                @error('kogol')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">fakmkwh</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text" name="fakmkwh"
                                                                                    id="fakmkwh"
                                                                                    value="{{ $s->fakmkwh }}"
                                                                                    class="form-control @error('fakmkwh') is-invalid @enderror">
                                                                                @error('fakmkwh')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">rpbp</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text" name="rpbp"
                                                                                    id="rpbp"
                                                                                    value="{{ $s->rpbp }}"
                                                                                    class="form-control @error('rpbp') is-invalid @enderror">
                                                                                @error('rpbp')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">rpujl</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text" name="rpujl"
                                                                                    id="rpujl"
                                                                                    value="{{ $s->rpujl }}"
                                                                                    class="form-control @error('rpujl') is-invalid @enderror">
                                                                                @error('rpujl')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">nomor_kwh</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text" name="nomor_kwh"
                                                                                    id="nomor_kwh"
                                                                                    value="{{ $s->nomor_kwh }}"
                                                                                    class="form-control @error('nomor_kwh') is-invalid @enderror">
                                                                                @error('nomor_kwh')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">penyulang</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text" name="penyulang"
                                                                                    id="penyulang"
                                                                                    value="{{ $s->penyulang }}"
                                                                                    class="form-control @error('penyulang') is-invalid @enderror">
                                                                                @error('penyulang')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">nama_section</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text"
                                                                                    value="{{ $s->nama_section }}"
                                                                                    class="form-control @error('nama_section') is-invalid @enderror"
                                                                                    name="nama_section">
                                                                                @error('nama_section')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">Kali
                                                                                Padam</label>
                                                                            <div class="input-group input-group-flat">
                                                                                @if ($s->entriPadam)
                                                                                    <input
                                                                                        value="{{ $s->entriPadam->kalipadam }}"
                                                                                        class="form-control" readonly>
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
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-2 border border-success">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold bg-success text-light fs-3" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseTrafo" aria-expanded="false"
                            aria-controls="collapseTrafo">
                            Data Trafo
                        </button>
                    </h2>
                    <div id="collapseTrafo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <form method="post" action="/updating/import_excel_trafo" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-label fs-2">Upload File Trafo</div>
                                <input type="file" name="file" class="form-control" required />
                                <div class="row">
                                    <button type="submit" class="btn btn-primary mt-1 mb-3 m-1 col-lg-3"><i
                                            class="fa-solid fa-upload fa-lg" style="margin-right: 5px"></i>Import
                                        Excel</button>
                                    <a href="file_trafo/template_trafo/Data Trafo.xlsx"
                                        class="btn btn-success m-1 mt-1 mb-3 col-lg-3"><i
                                            class="fa-solid fa-download fa-lg" style="margin-right: 5px"></i>Template
                                        Excel</a>
                                </div>
                            </form>
                            {{-- <form action="/updating/hapus_trafo" method="get">
                        @csrf
                        @method('delete')
                        <a href="#" class="btn btn-danger col-sm-4 mb-2 button-delete-trafo" data-bs-toggle="modal"
                            data-bs-target="#modal-delete-trafo">
                            <i class="fa-solid fa-trash fa-lg" style="margin-right: 5px;"></i> Hapus Trafo
                        </a>
                        <div class="modal modal-blur fade" id="modal-delete-trafo" tabindex="-1" role="dialog"
                            aria-hidden="true">
                            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <div class="modal-status bg-danger"></div>
                                    <div class="modal-body text-center py-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                                            <path d="M12 9v4" />
                                            <path d="M12 17h.01" />
                                        </svg>
                                        <h3>Apakah anda yakin?</h3>
                                        <div class="text-muted">Untuk menghapus trafo tersebut</div>
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
                            <table class="table table-vcenter table-bordered table-hover table-success"
                                id="tabel_data_trafo" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="2%">
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check">
                                                    <input class="form-check-input mt-2"
                                                        style="position:relative; left:10px;" type="checkbox"
                                                        id="checklist-trafo" onclick="checkAllTrafo()">
                                                </div>
                                            </div>
                                        </th>
                                        <th width="20%">Unit Layanan</th>
                                        <th width="18%">Penyulang</th>
                                        <th width="25%">No Tiang</th>
                                        <th width="25%">Lokasi</th>
                                        <th width="5%">Aksi</th>
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
                                                            name="checkTrafo[]">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $s->unit_layanan }}</td>
                                            <td>{{ $s->penyulang }}</td>
                                            <td>{{ $s->no_tiang }}</td>
                                            <td>{{ $s->lokasi }}</td>
                                            <td>
                                                <a href="#" data-bs-target="#trafo-{{ $s->id }}"
                                                    data-bs-toggle="modal">
                                                    <i class="fa-solid fa-circle-info fa-lg text-primary"></i>
                                                </a>
                                                <a href="#" data-bs-target="#trafo-edit-{{ $s->id }}"
                                                    data-bs-toggle="modal">
                                                    <i class="fa-solid fa-pen-to-square fa-lg text-dark"></i>
                                                </a>
                                                {{-- </form> --}}
                                                <div class="modal modal-blur fade" id="trafo-{{ $s->id }}"
                                                    tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">{{ $s->penyulang }}</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                                    <!-- Additional fields -->
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
                                                                    <div class="mb-3 col-lg-12">
                                                                        <label class="form-label">Koordinat</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input
                                                                                value="{{ $s->latitude }}{{ $s->longitude }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="#" class="btn btn-link link-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    Cancel
                                                                </a>
                                                                <a href="#" class="btn btn-primary ms-auto"
                                                                    data-bs-dismiss="modal">
                                                                    Confirm
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal modal-blur fade" id="trafo-edit-{{ $s->id }}"
                                                    tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                        role="document">
                                                        <form action="/updating/edit_trafo/{{ $s->id }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Trafo</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">Unit Layanan</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <select name="unit_layanan"
                                                                                    id="unit_layanan"
                                                                                    class="form-control @error('unit_layanan') is-invalid @enderror">
                                                                                    <option value="Demak"
                                                                                        {{ $s->unit_layanan == 'Demak' ? 'selected' : '' }}>
                                                                                        Demak</option>
                                                                                    <option value="Tegowanu"
                                                                                        {{ $s->unit_layanan == 'Tegowanu' ? 'selected' : '' }}>
                                                                                        Tegowanu
                                                                                    </option>
                                                                                    <option value="Purwodadi"
                                                                                        {{ $s->unit_layanan == 'Purwodadi' ? 'selected' : '' }}>
                                                                                        Purwodadi
                                                                                    </option>
                                                                                    <option value="Wirosari"
                                                                                        {{ $s->unit_layanan == 'Wirosari' ? 'selected' : '' }}>
                                                                                        Wirosari
                                                                                    </option>
                                                                                </select>
                                                                                @error('unit_layanan')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">Penyulang</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text" name="penyulang"
                                                                                    id="penyulang"
                                                                                    value="{{ $s->penyulang }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">Nomor Tiang</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text" name="no_tiang"
                                                                                    id="no_tiang"
                                                                                    value="{{ $s->no_tiang }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">Daya</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text" name="daya"
                                                                                    id="daya"
                                                                                    value="{{ $s->daya }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">Merk</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text" name="merk"
                                                                                    id="merk"
                                                                                    value="{{ $s->merk }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">Beban X1</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text" name="beban_X1"
                                                                                    id="beban_X1"
                                                                                    value="{{ $s->beban_X1 }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">Beban X2</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text" name="beban_X2"
                                                                                    id="beban_X2"
                                                                                    value="{{ $s->beban_X2 }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">Beban Xo</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text" name="beban_Xo"
                                                                                    id="beban_Xo"
                                                                                    value="{{ $s->beban_Xo }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">Lokasi</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text" name="lokasi"
                                                                                    id="lokasi"
                                                                                    value="{{ $s->lokasi }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">penyebab</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text" name="penyebab"
                                                                                    id="penyebab"
                                                                                    value="{{ $s->penyebab }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">No APKT</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text" name="no_pk_apkt"
                                                                                    id="no_pk_apkt"
                                                                                    value="{{ $s->no_pk_apkt }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4">
                                                                            <label class="form-label">Beban (A)</label>
                                                                            <div class="input-group input-group-flat">
                                                                                <input type="text" name="bebanA"
                                                                                    id="bebanA"
                                                                                    value="{{ $s->bebanA }}"
                                                                                    class="form-control">
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
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-2 border border-secondary">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold bg-secondary text-light fs-3" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseDataUnit" aria-expanded="false"
                            aria-controls="collapseDataUnit">
                            Data Unit
                        </button>
                    </h2>
                    <div id="collapseDataUnit" class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <button type="button" class="btn btn-info mb-3 col-lg-3" data-bs-toggle="modal"
                                data-bs-target="#modalTambahDataUnit">
                                Tambah Data Unit
                            </button>
                            <div class="modal fade" id="modalTambahDataUnit" tabindex="-1"
                                aria-labelledby="modalTambahDataUnitLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="/updating/proses_tambah_dataunit" method="post">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-3" id="modalTambahDataUnitLabel">Tambah Data
                                                    Unit
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Unit</label>
                                                    <div class="input-group input-group-flat">
                                                        <input type="hidden" name="idunit" id="idunit">
                                                        <select class="form-control" name="unit" id="unit">
                                                            <option selected>--- Pilih Unit---
                                                            </option>
                                                            <option value="ULP Demak">
                                                                ULP Demak</option>
                                                            <option value="ULP Tegowanu">
                                                                ULP Tegowanu</option>
                                                            <option value="ULP Purwodadi">
                                                                ULP Purwodadi
                                                            </option>
                                                            <option value="ULP Wirosari">
                                                                ULP Wirosari</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nomor MULP</label>
                                                    <div class="input-group input-group-flat">
                                                        <input type="text" class="form-control" name="no_mulp"
                                                            id="no_mulp">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nomor TL Teknik</label>
                                                    <div class="input-group input-group-flat">
                                                        <input type="text" class="form-control" name="no_tlteknik"
                                                            id="no_tlteknik">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <table class="table table-vcenter table-bordered table-hover table-secondary"
                                id="tabel_data_unit" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Unit</th>
                                        <th>Unit</th>
                                        <th>No HP MULP</th>
                                        <th>No HP TLTeknik</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data_unit as $unit)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $unit->idunit }}</td>
                                            <td>{{ $unit->unit }}</td>
                                            <td>{{ $unit->no_mulp }}</td>
                                            <td>{{ $unit->no_tlteknik }}</td>
                                            <td>
                                                <a style="cursor: pointer" data-bs-toggle="modal"
                                                    data-bs-target="#modalEditUnit{{ $unit->id }}">
                                                    <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                                </a>

                                                <div class="modal fade" id="modalEditUnit{{ $unit->id }}"
                                                    tabindex="-1" aria-labelledby="modalEditUnitLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="/updating/edit_unit/{{ $unit->id }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title" id="exampleModalLabel">Edit
                                                                        Unit
                                                                    </h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Unit</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input type="hidden" name="idunit"
                                                                                id="idunit"
                                                                                value="{{ $unit->idunit }}">
                                                                            <select disabled class="form-control"
                                                                                name="unit" id="unit">
                                                                                <option selected>--- Pilih Unit---
                                                                                </option>
                                                                                <option value="ULP Demak"
                                                                                    {{ $unit->unit == 'ULP Demak' ? 'selected' : '' }}>
                                                                                    ULP Demak</option>
                                                                                <option value="ULP Tegowanu"
                                                                                    {{ $unit->unit == 'ULP Tegowanu' ? 'selected' : '' }}>
                                                                                    ULP Tegowanu</option>
                                                                                <option value="ULP Purwodadi"
                                                                                    {{ $unit->unit == 'ULP Purwodadi' ? 'selected' : '' }}>
                                                                                    ULP Purwodadi
                                                                                </option>
                                                                                <option value="ULP Wirosari"
                                                                                    {{ $unit->unit == 'ULP Wirosari' ? 'selected' : '' }}>
                                                                                    ULP Wirosari</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Nomor MULP</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input type="text" class="form-control"
                                                                                name="no_mulp" id="no_mulp"
                                                                                value="{{ $unit->no_mulp }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Nomor TL Teknik</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input type="text" class="form-control"
                                                                                name="no_tlteknik" id="no_tlteknik"
                                                                                value="{{ $unit->no_tlteknik }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Edit</button>
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
                </div>
            </div>
            <div class="card mt-2 border border-danger">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold bg-danger text-light fs-3" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseWANotif" aria-expanded="false"
                            aria-controls="collapseWANotif">
                            WA Notif
                        </button>
                    </h2>
                    <div id="collapseWANotif" class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            {{-- <a href="/updating/tambah_wanotif" class="btn btn-info col-lg-3 mb-3">Tambah Data Unit</a> --}}
                            <button type="button" class="btn btn-info mb-3 col-lg-3" data-bs-toggle="modal"
                                data-bs-target="#modalTambahWANotif">
                                Tambah WA Notif
                            </button>
                            <div class="modal fade" id="modalTambahWANotif" tabindex="-1"
                                aria-labelledby="modalTambahWANotifLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="/updating/proses_tambah_wanotif" method="post">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-3" id="modalTambahWANotifLabel">Tambah WA Notif
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-4">
                                                    <label class="form-label">ID Serial</label>
                                                    <div class="input-group input-group-flat">
                                                        <input class="form-control" name="idserial" id="idserial"
                                                            type="text">
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label">ID Pelanggan</label>
                                                    <div class="input-group input-group-flat">
                                                        <input class="form-control" name="idpel" id="idpel"
                                                            type="text">
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label">ID Unit</label>
                                                    <div class="input-group input-group-flat">
                                                        <select class="form-control" name="idunit" id="idunit">
                                                            <option selected disabled>--- Pilih ID Unit ---</option>
                                                            <option value="52551">52551</option>
                                                            <option value="52552">52552</option>
                                                            <option value="52553">52553</option>
                                                            <option value="52554">52554</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <table class="table table-vcenter table-bordered table-hover table-secondary"
                                id="tabel_data_wanotif" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Serial</th>
                                        <th>ID Pel</th>
                                        <th>ID Unit</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data_wanotif as $wanotif)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $wanotif->idserial }}</td>
                                            <td>{{ $wanotif->idpel }}</td>
                                            <td>{{ $wanotif->idunit }}</td>
                                            <td>
                                                <a style="cursor: pointer" data-bs-toggle="modal"
                                                    data-bs-target="#modalEditWANotif{{ $wanotif->id }}">
                                                    <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                                </a>

                                                <div class="modal fade" id="modalEditWANotif{{ $wanotif->id }}"
                                                    tabindex="-1" aria-labelledby="modalEditWANotifLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form action="/updating/edit_wanotif/{{ $wanotif->id }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title" id="exampleModalLabel">Edit WA
                                                                        Notif
                                                                    </h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">ID Serial</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input type="text" class="form-control"
                                                                                name="idserial" id="idserial"
                                                                                value="{{ $wanotif->idserial }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">ID Pel</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <input type="text" class="form-control"
                                                                                name="idpel" id="idpel"
                                                                                value="{{ $wanotif->idpel }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">ID Unit</label>
                                                                        <div class="input-group input-group-flat">
                                                                            <select class="form-control" name="idunit"
                                                                                id="idunit">
                                                                                <option selected disabled>--- Pilih ID
                                                                                    Unit---
                                                                                </option>
                                                                                <option value="52551"
                                                                                    {{ $wanotif->idunit == '52551' ? 'selected' : '' }}>
                                                                                    52551</option>
                                                                                <option value="52552"
                                                                                    {{ $wanotif->idunit == '52552' ? 'selected' : '' }}>
                                                                                    52552</option>
                                                                                <option value="52553"
                                                                                    {{ $wanotif->idunit == '52553' ? 'selected' : '' }}>
                                                                                    52553
                                                                                </option>
                                                                                <option value="52554"
                                                                                    {{ $wanotif->idunit == '52554' ? 'selected' : '' }}>
                                                                                    52554</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Edit</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            function template_tabel(nama_tabel) {
                $(nama_tabel).DataTable({
                    scrollX: true,
                    scrollCollapse: true,
                    fixedColumns: true,
                    'pageLength': 10,
                    'lengthMenu': [10, 25, 50, 100, 200, 500],
                });
            }

            template_tabel('#tabel_data_pelanggan');
            template_tabel('#tabel_data_trafo');
            template_tabel('#tabel_data_unit');
            template_tabel('#tabel_data_wanotif');
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
            checkboxGroup("checklist-pelanggan", 'input[name="checkPelanggan[]"]');
            checkboxGroup("checklist-trafo", 'input[name="checkTrafo[]"]');
        });
    </script>
    <script>
        document.getElementById('unit').addEventListener('change', function() {
            var selectedUnit = this.value;
            var idunit = document.getElementById('idunit');

            if (selectedUnit == 'ULP Demak') {
                idunit.value = '52551'
            }
            if (selectedUnit == 'ULP Tegowanu') {
                idunit.value = '52552'
            }
            if (selectedUnit == 'ULP Purwodadi') {
                idunit.value = '52553'
            }
            if (selectedUnit == 'ULP Wirosari') {
                idunit.value = '52554'
            }
        })
    </script>
@endsection
