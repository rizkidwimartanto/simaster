@extends('layout/templateberanda')
@section('content')
<div class="container-fluid mt-3">
    <form method="post" action="/inputpelanggan/import_excel" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-label">Custom File Input</div>
        <input type="file" name="file" class="form-control" />
        <button type="submit" class="btn btn-primary mt-3 mb-3 col-lg-2">Import Excel</button>
    </form>
    @if (session('success_hapus'))
        <div class="alert alert-success">
            {{ session('success_hapus') }}
        </div>
    @endif
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
    @if (session('error_hapus'))
        <div class="alert alert-danger">
            {{ session('error_hapus') }}
        </div>
    @endif

    <div class="col-lg-12">
        <div class="card p-3">
            <form action="/inputpelanggan/hapus_pelanggan" method="get">
                {{ csrf_field() }}
                <button type="button" class="btn btn-danger mt-2 mb-2 col-2" data-bs-toggle="modal"
                    data-bs-target="#modal-danger">
                    <i class="fa-solid fa-trash fa-lg"></i> Hapus
                </button>
                <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            <div class="modal-status bg-danger"></div>
                            <div class="modal-body text-center py-4">
                                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                                    <path d="M12 9v4" />
                                    <path d="M12 17h.01" />
                                </svg>
                                <h3>Are you sure?</h3>
                                <div class="text-muted">Hapus Data Pelanggan yang Dipilih</div>
                            </div>
                            <div class="modal-footer">
                                <div class="w-100">
                                    <div class="row">
                                        <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                                Cancel
                                            </a></div>
                                        <div class="col"><button type="submit" class="btn btn-danger w-100"
                                                data-bs-dismiss="modal">
                                                Yes
                                            </button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-vcenter card-table table-bordered" id="tabel_data_pelanggan">
                    <thead>
                        <tr>
                            <th>
                                <div class="d-flex justify-content-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checklist-pelanggan">
                                    </div>
                                </div>
                            </th>
                            <th>Aksi</th>
                            <th>No</th>
                            <th>ID Pelanggan</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th width="10%">Maps</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($data_pelanggan as $s)
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="form-check">
                                            <input class="form-check-input" style="position: relative; right: 10px;"
                                                type="checkbox" value="{{ $s->id }}" id="flexCheckDefault"
                                                name="check[]">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="#" data-bs-target="#{{{$s->id}}}" data-bs-toggle="modal">
                                        <i class="fa-solid fa-circle-info fa-lg text-primary"></i>
                                    </a>
                                    <div class="modal modal-blur fade" id="{{$s->id}}" tabindex="-1"
                                        role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{$s->nama}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                    <div class="mb-3 col-lg-12">
                                                        <label class="form-label">Nama Pelanggan</label>
                                                        <div class="input-group input-group-flat">
                                                            <input value="{{$s->nama}}" class="form-control" readonly>
                                                        </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-12">
                                                            <label class="form-label">Alamat</label>
                                                            <div class="input-group input-group-flat">
                                                            <input value="{{$s->alamat}}" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <label class="form-label">Latitude</label>
                                                            <div class="input-group input-group-flat">
                                                            <input value="{{$s->latitude}}" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <label class="form-label">Longtitude</label>
                                                            <div class="input-group input-group-flat">
                                                            <input value="{{$s->longtitude}}" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <label class="form-label">No Telepon</label>
                                                            <div class="input-group input-group-flat">
                                                            <input value="{{$s->no_telepon}}" class="form-control" readonly>
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
                                                            <input value="{{$s->tarif}}" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <label class="form-label">Daya</label>
                                                            <div class="input-group input-group-flat">
                                                            <input value="{{$s->daya}}" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <label class="form-label">KOGOL</label>
                                                            <div class="input-group input-group-flat">
                                                            <input value="{{$s->kogol}}" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <label class="form-label">fakmkwh</label>
                                                            <div class="input-group input-group-flat">
                                                            <input value="{{$s->fakmkwh}}" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <label class="form-label">rpbp</label>
                                                            <div class="input-group input-group-flat">
                                                            <input value="{{$s->rpbp}}" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <label class="form-label">rpujl</label>
                                                            <div class="input-group input-group-flat">
                                                            <input value="{{$s->rpujl}}" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <label class="form-label">nomor_kwh</label>
                                                            <div class="input-group input-group-flat">
                                                            <input value="{{$s->nomor_kwh}}" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <label class="form-label">penyulang</label>
                                                            <div class="input-group input-group-flat">
                                                            <input value="{{$s->penyulang}}" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <label class="form-label">nama_section</label>
                                                            <div class="input-group input-group-flat">
                                                            <input value="{{$s->nama_section}}" class="form-control" readonly>
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
                                    </div>
                                </td>
                                <td>{{ $i++ }}</td>
                                <td>{{ $s->idpel }}</td>
                                <td>{{ $s->nama }}</td>
                                <td>{{ $s->alamat }}</td>
                                <td><a href="{{ $s->maps }}" target="_blank">{{ $s->maps }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
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
