@extends('layout/templateberanda')
@section('content')
    <div class="container-fluid mt-3">
        <form method="post" action="/inputpelanggan/import_excel" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-label">Custom File Input</div>
            <input type="file" name="file" class="form-control" />
            <button type="submit" class="btn btn-primary mt-3 mb-3">Import Excel</button>
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
                    <button type="button" class="btn btn-danger mt-2 mb-2 col-2" data-bs-toggle="modal"
                        data-bs-target="#modal-small">
                        <i class="fa-solid fa-trash fa-lg"></i> Hapus
                    </button>
                    <div class="modal modal-blur fade" id="modal-small" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="modal-title">Are you sure?</div>
                                    <div>If you proceed, you will lose all your personal data.</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-link link-secondary me-auto"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Yes, delete all my data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-bordered" id="tabel_data_pelanggan">
                            <thead>
                                <tr>
                                    <th width="5%">
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
                                    <th width="20%">Maps</th>
                                    <th>Titik Koordinat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
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
                                            <i class="fa-solid fa-pen-to-square fa-lg text-primary"></i>
                                        </td>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $s->idpel }}</td>
                                        <td>{{ $s->nama }}</td>
                                        <td>{{ $s->alamat }}</td>
                                        <td><a href="{{ $s->maps }}" target="_blank">{{ $s->maps }}</a></td>
                                        <td>{{ $s->titik_koordinat }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                    </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#tabel_data_pelanggan').DataTable({
                scrollX: true
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Daftar elemen checkbox "checklist all" dan checkbox data
            var checkboxGroups = [{
                checklistAll: document.getElementById("checklist-pelanggan"),
                checkboxes: document.querySelectorAll('input[name="check[]"]')
            }, ];
            // end checklist

            // Tambahkan event listener untuk setiap grup checkbox
            checkboxGroups.forEach(function(group) {
                group.checklistAll.addEventListener("change", function() {
                    // Set status checkbox data berdasarkan status checkbox "checklist all"
                    group.checkboxes.forEach(function(checkbox) {
                        checkbox.checked = group.checklistAll.checked;
                    });
                });
            });
        });
    </script>
@endsection
