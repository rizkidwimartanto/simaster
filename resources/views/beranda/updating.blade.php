@extends('layout/templateberanda')
@section('content')
    <div class="container-fluid mt-3">
        @if (session('success_import'))
            <div class="alert alert-success">
                <h3>{{ session('success_import') }}</h3>
            </div>
        @endif
        @if (session('success_hapus'))
            <div class="alert alert-success">
                <h3> {{ session('success_hapus') }}</h3>
            </div>
        @endif
        @if (session('success_edit'))
            <div class="alert alert-success">
                <h3> {{ session('success_edit') }}</h3>
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
        @if (session('error_hapus'))
            <div class="alert alert-danger">
                <h3>{{ session('error_hapus') }}</h3>
            </div>
        @endif
        @if (session('error_edit'))
            <div class="alert alert-danger">
                <h3>{{ session('error_edit') }}</h3>
            </div>
        @endif
        <div class="col-lg-12">
            <div class="card border border-info p-3 mt-4">
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
        <div class="card border border-info p-3 mt-4">
            <form method="post" action="/updating/import_excel" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-label fs-2">Upload File Pelanggan</div>
                <input type="file" name="file" class="form-control" required />
                <button type="submit" class="btn btn-primary mt-3 mb-3 col-lg-2"><i class="fa-solid fa-upload fa-lg"
                        style="margin-right: 5px"></i>Import Excel Pelanggan</button>
                <a href="/updating/export_excel_pelanggan" class="btn btn-warning mt-3 mb-3 col-lg-2"><i
                        class="fa-solid fa-download fa-lg" style="margin-right: 5px"></i>Export Excel Pelanggan</a>
            </form>
            <form action="/updating/hapus_pelanggan" method="get">
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
                                <th width="5%">ID Pelanggan</th>
                                <th width="23%">Nama</th>
                                <th width="35%">Alamat</th>
                                <th width="25%">Maps</th>
                                <th width="5%">Aksi</th>
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
                                                <input class="form-check-input" type="checkbox"
                                                    value="{{ $s->id }}" id="flexCheckDefault"
                                                    name="checkPelanggan[]">
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $s->idpel }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <td>{{ $s->alamat }}</td>
                                    <td><a href="{{ $s->maps }}" target="_blank">{{ $s->maps }}</a></td>
                                    <td>
                                        <a href="#" data-bs-target="#{{ $s->id }}" data-bs-toggle="modal">
                                            <i class="fa-solid fa-circle-info fa-lg text-primary"></i>
                                        </a>
                                        <a href="#" data-bs-target="#edit-{{ $s->id }}"
                                            data-bs-toggle="modal">
                                            <i class="fa-solid fa-pen-to-square fa-lg text-dark"></i>
                                        </a>
            </form>
            <div class="modal modal-blur fade" id="{{ $s->id }}" tabindex="-1" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
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
                                        <input value="{{ $s->nama }}" class="form-control" readonly>
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
                                        <input value="{{ $s->nohp_stakeholder }}" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-12">
                                    <label class="form-label">No HP PIC Lapangan</label>
                                    <div class="input-group input-group-flat">
                                        <input value="{{ $s->nohp_piclapangan }}" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label">Latitude</label>
                                    <div class="input-group input-group-flat">
                                        <input value="{{ $s->latitude }}" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label">Longtitude</label>
                                    <div class="input-group input-group-flat">
                                        <input value="{{ $s->longtitude }}" class="form-control" readonly>
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
                                        <input value="ULP Purwodadi" class="form-control" readonly>
                                        <?php elseif($s->unitulp == 52554) : ?>
                                        <input value="ULP Wirosari" class="form-control" readonly>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label">Tarif</label>
                                    <div class="input-group input-group-flat">
                                        <input value="{{ $s->tarif }}" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label">Daya</label>
                                    <div class="input-group input-group-flat">
                                        <input value="{{ $s->daya }}" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label">KOGOL</label>
                                    <div class="input-group input-group-flat">
                                        <input value="{{ $s->kogol }}" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label">fakmkwh</label>
                                    <div class="input-group input-group-flat">
                                        <input value="{{ $s->fakmkwh }}" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label">rpbp</label>
                                    <div class="input-group input-group-flat">
                                        <input value="{{ $s->rpbp }}" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label">rpujl</label>
                                    <div class="input-group input-group-flat">
                                        <input value="{{ $s->rpujl }}" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label">nomor_kwh</label>
                                    <div class="input-group input-group-flat">
                                        <input value="{{ $s->nomor_kwh }}" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label">penyulang</label>
                                    <div class="input-group input-group-flat">
                                        <input value="{{ $s->penyulang }}" class="form-control" readonly>
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
                                            <input value="{{ $s->entriPadam->kalipadam }}" class="form-control" readonly>
                                        @else
                                            <input value="{{ 0 }}" class="form-control" readonly>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger me-auto" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal modal-blur fade" id="edit-{{ $s->id }}" tabindex="-1" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <form action="/updating/edit_pelanggan/{{ $s->id }}" method="post">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Pelanggan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label class="form-label">Nama Pelanggan</label>
                                        <div class="input-group input-group-flat">
                                            <input type="text" name="nama" id="nama"
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
                                        <label class="form-label">No HP StakeHolder</label>
                                        <div class="input-group input-group-flat">
                                            <input type="text" name="nohp_stakeholder" id="nohp_stakeholder"
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
                                        <label class="form-label">No HP PIC Lapangan</label>
                                        <div class="input-group input-group-flat">
                                            <input type="text" name="nohp_piclapangan" id="nohp_piclapangan"
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
                                            <input type="text" name="latitude" id="latitude"
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
                                            <input type="text" name="longtitude" id="longtitude"
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
                                                <option value="52550" {{$s->unitulp == 52550 ? 'selected' : ''}}>UP3 Demak</option>
                                                <option value="52551" {{$s->unitulp == 52551 ? 'selected' : ''}}>ULP Demak</option>
                                                <option value="52552" {{$s->unitulp == 52552 ? 'selected' : ''}}>ULP Tegowanu</option>
                                                <option value="52553" {{$s->unitulp == 52553 ? 'selected' : ''}}>ULP Purwodadi</option>
                                                <option value="52554" {{$s->unitulp == 52554 ? 'selected' : ''}}>ULP Wirosari</option>
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
                                            <input type="text" name="tarif" id="tarif"
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
                                            <input type="text" name="daya" id="daya"
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
                                            <input type="text" name="kogol" id="kogol"
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
                                            <input type="text" name="fakmkwh" id="fakmkwh"
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
                                            <input type="text" name="rpbp" id="rpbp"
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
                                            <input type="text" name="rpujl" id="rpujl"
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
                                            <input type="text" name="nomor_kwh" id="nomor_kwh"
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
                                            <input type="text" name="penyulang" id="penyulang"
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
                                            <input type="text" value="{{ $s->nama_section }}"
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
                                        <label class="form-label">Kali Padam</label>
                                        <div class="input-group input-group-flat">
                                            @if ($s->entriPadam)
                                                <input value="{{ $s->entriPadam->kalipadam }}" class="form-control"
                                                    readonly>
                                            @else
                                                <input value="{{ 0 }}" class="form-control">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info" data-bs-dismiss="modal">Edit</button>
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
    <div class="card p-3 mt-4 border border-info">
        <form method="post" action="/updating/import_excel_trafo" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-label fs-2">Upload File Trafo</div>
            <input type="file" name="file" class="form-control" required />
            <button type="submit" class="btn btn-primary mt-3 mb-3 col-lg-4"><i class="fa-solid fa-upload fa-lg"
                    style="margin-right: 5px"></i>Import Excel Trafo</button>
            {{-- <a href="/updating/export_excel_trafo" class="btn btn-warning mt-3 mb-3 col-lg-2"><i
                        class="fa-solid fa-download fa-lg" style="margin-right: 5px"></i>Export Excel Trafo</a> --}}
        </form>
        <form action="/updating/hapus_trafo" method="get">
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
            </div>
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
                                            type="checkbox" id="checklist-trafo" onclick="checkAllTrafo()">
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
                                            <input class="form-check-input" type="checkbox" value="{{ $s->id }}"
                                                id="flexCheckDefault" name="checkTrafo[]">
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
        </form>
        <div class="modal modal-blur fade" id="trafo-{{ $s->id }}" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $s->penyulang }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-lg-4">
                                <label class="form-label">Unit Layanan</label>
                                <div class="input-group input-group-flat">
                                    <input value="{{ $s->unit_layanan }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label">Penyulang</label>
                                <div class="input-group input-group-flat">
                                    <input value="{{ $s->penyulang }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label">Nomor Tiang</label>
                                <div class="input-group input-group-flat">
                                    <input value="{{ $s->no_tiang }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label">Daya</label>
                                <div class="input-group input-group-flat">
                                    <input value="{{ $s->daya }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label">Merk</label>
                                <div class="input-group input-group-flat">
                                    <input value="{{ $s->merk }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label">Beban X1</label>
                                <div class="input-group input-group-flat">
                                    <input value="{{ $s->beban_X1 }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label">Beban X2</label>
                                <div class="input-group input-group-flat">
                                    <input value="{{ $s->beban_X2 }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label">Beban Xo</label>
                                <div class="input-group input-group-flat">
                                    <input value="{{ $s->beban_Xo }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label">Lokasi</label>
                                <div class="input-group input-group-flat">
                                    <input value="{{ $s->lokasi }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label">penyebab</label>
                                <div class="input-group input-group-flat">
                                    <input value="{{ $s->penyebab }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label">No APKT</label>
                                <div class="input-group input-group-flat">
                                    <input value="{{ $s->no_pk_apkt }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label">Beban (A)</label>
                                <div class="input-group input-group-flat">
                                    <input value="{{ $s->bebanA }}" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger me-auto" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-blur fade" id="trafo-edit-{{ $s->id }}" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <form action="/updating/edit_trafo/{{ $s->id }}" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Trafo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label">Unit Layanan</label>
                                    <div class="input-group input-group-flat">
                                        <select name="unit_layanan" id="unit_layanan"
                                        class="form-control @error('unit_layanan') is-invalid @enderror">
                                        <option value="Demak" {{$s->unit_layanan == 'Demak' ? 'selected' : ''}}>Demak</option>
                                        <option value="Tegowanu" {{$s->unit_layanan == 'Tegowanu' ? 'selected' : ''}}>Tegowanu</option>
                                        <option value="Purwodadi" {{$s->unit_layanan == 'Purwodadi' ? 'selected' : ''}}>Purwodadi</option>
                                        <option value="Wirosari" {{$s->unit_layanan == 'Wirosari' ? 'selected' : ''}}>Wirosari</option>
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
                                        <input type="text" name="penyulang" id="penyulang"
                                            value="{{ $s->penyulang }}" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label">Nomor Tiang</label>
                                    <div class="input-group input-group-flat">
                                        <input type="text" name="no_tiang" id="no_tiang"
                                            value="{{ $s->no_tiang }}" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label">Daya</label>
                                    <div class="input-group input-group-flat">
                                        <input type="text" name="daya" id="daya" value="{{ $s->daya }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label">Merk</label>
                                    <div class="input-group input-group-flat">
                                        <input type="text" name="merk" id="merk"
                                            value="{{ $s->merk }}" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label">Beban X1</label>
                                    <div class="input-group input-group-flat">
                                        <input type="text" name="beban_X1" id="beban_X1"
                                            value="{{ $s->beban_X1 }}" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label">Beban X2</label>
                                    <div class="input-group input-group-flat">
                                        <input type="text" name="beban_X2" id="beban_X2"
                                            value="{{ $s->beban_X2 }}" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label">Beban Xo</label>
                                    <div class="input-group input-group-flat">
                                        <input type="text" name="beban_Xo" id="beban_Xo"
                                            value="{{ $s->beban_Xo }}" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label">Lokasi</label>
                                    <div class="input-group input-group-flat">
                                        <input type="text" name="lokasi" id="lokasi"
                                            value="{{ $s->lokasi }}" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label">penyebab</label>
                                    <div class="input-group input-group-flat">
                                        <input type="text" name="penyebab" id="penyebab"
                                            value="{{ $s->penyebab }}" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label">No APKT</label>
                                    <div class="input-group input-group-flat">
                                        <input type="text" name="no_pk_apkt" id="no_pk_apkt"
                                            value="{{ $s->no_pk_apkt }}" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label">Beban (A)</label>
                                    <div class="input-group input-group-flat">
                                        <input type="text" name="bebanA" id="bebanA"
                                            value="{{ $s->bebanA }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info" data-bs-dismiss="modal">Edit</button>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var checkboxGroups = [{
                checklistAll: document.getElementById("checklist-trafo"),
                checkboxes: document.querySelectorAll('input[name="checkTrafo[]"]')
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
