@extends('layout/templateberanda')
@section('content')
    <div class="container-fluid mt-3">
        @if (session('success_import'))
            <div class="alert alert-success">
                {{ session('success_import') }}
            </div>
        @endif
        @if (session('error_import'))
            <div class="alert alert-danger">
                {{ session('error_import') }}
            </div>
        @endif
        @if (session('validate_file'))
            <div class="alert alert-danger">
                {{ session('validate_file') }}
            </div>
        @endif
        <form method="post" action="/inputpelanggan/import_excel" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-label">Custom File Input</div>
            <input type="file" name="file" class="form-control" required />
            <button type="submit" class="btn btn-primary mt-3 mb-3 col-lg-2"><i class="fa-solid fa-upload fa-lg"
                    style="margin-right: 5px"></i>Import Excel</button>
            <a href="/inputpelanggan/export_excel" class="btn btn-warning mt-3 mb-3 col-lg-2"><i
                    class="fa-solid fa-download fa-lg" style="margin-right: 5px"></i>Export Excel</a>
        </form>

        <div class="col-lg-12">
            <div class="card p-3">
                <table class="table table-vcenter table-bordered table-hover table-success" id="tabel_data_pelanggan" style="width: 100%">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="5%">Aksi</th>
                            <th width="20%">ID Pelanggan</th>
                            <th width="20%">Nama</th>
                            <th width="25%">Alamat</th>
                            <th width="25%">Maps</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($data_pelanggan as $s)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    <a href="#" data-bs-target="#{{ $s->id }}" data-bs-toggle="modal">
                                        <i class="fa-solid fa-circle-info fa-lg text-primary"></i>
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
                                                                <input value="{{ $s->nohp_stakeholder }}" class="form-control"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-12">
                                                            <label class="form-label">No HP PIC Lapangan</label>
                                                            <div class="input-group input-group-flat">
                                                                <input value="{{ $s->nohp_piclapangan }}" class="form-control"
                                                                    readonly>
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
                                                                <input value="ULP Purwodadi" class="form-control" readonly>
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
    </div>
    <script>
        $(document).ready(function() {
            $('#tabel_data_pelanggan').DataTable({
                scrollX: true,
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var checkboxGroups = [{
                checklistAll: document.getElementById("checklist-pelanggan"),
                checkboxes: document.querySelectorAll('input[name="check[]"]')
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
