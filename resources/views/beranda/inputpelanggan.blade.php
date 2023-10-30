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
                    <div class="table-responsive">
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
                                    <th>Maps</th>
                                    <th>Latitude</th>
                                    <th>Longtitude</th>
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
                                            <a href="#" data-bs-target="#modal-preview" data-bs-toggle="modal">
                                                <i class="fa-solid fa-pen-to-square fa-lg text-primary"></i>
                                            </a>
                                            <div class="modal modal-blur fade" id="modal-preview" tabindex="-1"
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
                                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                                odio, dapibus ac facilisis in, egestas
                                                                eget quam. Morbi leo risus, porta ac consectetur ac,
                                                                vestibulum at eros.</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn me-auto"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-dismiss="modal">Save changes</button>
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
                                        <td>{{ $s->latitude }}</td>
                                        <td>{{ $s->longtitude }}</td>
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
