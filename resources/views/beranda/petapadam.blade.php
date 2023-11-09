@extends('layout/templateberanda')
@section('content')
    <div class="container-fluid mt-3">
        @if (session('success_hapus'))
            <div class="alert alert-success">
                {{ session('success_hapus') }}
            </div>
        @endif
        @if (session('success_tambah'))
            <div class="alert alert-success">
                {{ session('success_tambah') }}
            </div>
        @endif
        @if (session('error_tambah'))
            <div class="alert alert-danger">
                {{ session('error_tambah') }}
            </div>
        @endif
        @if (session('error_hapus'))
            <div class="alert alert-danger">
                {{ session('error_hapus') }}
            </div>
        @endif
        <div class="col-lg-12">
            <div class="card p-3">
                <form action="/petapadam/hapus_entri" method="get">
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
                    <table class="table table-vcenter card-table table-bordered" id="tabel_data_padam">
                        <thead>
                            <tr>
                                <th width="5%">
                                    <div class="d-flex justify-content-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checklist-padam">
                                        </div>
                                    </div>
                                </th>
                                <th>No</th>
                                <th>Penyulang</th>
                                <th>Section</th>
                                <th>Jam Padam</th>
                                <th>Penyebab Padam</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($data_padam as $s)
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
                </form>
                <td>{{ $i++ }}</td>
                <td>{{ $s->penyulang }}</td>
                <td>{{ $s->section }}</td>
                <td>{{ $s->jam_padam }}</td>
                <td>{{ $s->penyebab_padam }}</td>
                <td>{{ $s->status }}</td>
                <form action="/petapadam/edit_status_padam" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id" value="{{ $s->id }}">
                    <input type="hidden" value="0" name="status" id="status">
                    @if ($s->status == 1)
                        <td><button type="submit" class="btn btn-success">Hidupkan</button></td>
                    @else
                        <td><button type="submit" class="btn btn-danger" disabled>Hidupkan</button></td>
                    @endif
                </form>
                </tr>
                @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#tabel_data_padam').DataTable({
                scrollX: true,
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var checkboxGroups = [{
                checklistAll: document.getElementById("checklist-padam"),
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
