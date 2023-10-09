@extends('layout/templateberanda')
@section('content')
    <div class="container mt-3">
        <form method="post" action="/inputpelanggan/import_excel" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-label">Custom File Input</div>
            <input type="file" name="file" class="form-control" />
            <button type="submit" class="btn btn-primary mt-3 mb-3">Import Excel</button>
        </form>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="col-lg-12">
            <div class="card p-3">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-bordered" id="tabel_data_pelanggan">
                        <thead>
                            <tr>
                                <th>Aksi</th>
                                <th>No</th>
                                <th>ID Pelanggan</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Unit UP1</th>
                                <th>Unit AP</th>
                                <th>Unit UP</th>
                                <th>Tarif</th>
                                <th>Daya</th>
                                <th>Kogol</th>
                                <th>Fakmkwh</th>
                                <th>RPBP</th>
                                <th>RPUJL</th>
                                <th>PEMDA</th>
                                <th>Nomor KWH</th>
                                <th>Status Pelanggan</th>
                                <th>kdpembmeter</th>
                                <th>Penyulang</th>
                                <th>Nama Section</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1 @endphp
                            @foreach ($data_pelanggan as $s)
                                <tr>
                                    <td>
                                        <i class="fa-solid fa-pen-to-square fa-lg text-primary"></i>
                                        <a href="/inputpelanggan/hapus_pelanggan/{{ $s->id }}"
                                            data-bs-toggle="modal" data-bs-target="#modal-small">
                                            <i class="fa-solid fa-trash fa-lg text-danger"></i>
                                        </a>
                                        <div class="modal modal-blur fade" id="modal-small" tabindex="-1" role="dialog"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="modal-title">Are you sure?</div>
                                                        <div>If you proceed, you will lose all your personal data.</div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-link link-secondary me-auto"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Yes, delete all my data</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $s->idpel }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <td>{{ $s->alamat }}</td>
                                    <td>{{ $s->unitup1 }}</td>
                                    <td>{{ $s->unitap }}</td>
                                    <td>{{ $s->unitup }}</td>
                                    <td>{{ $s->tarif }}</td>
                                    <td>{{ $s->daya }}</td>
                                    <td>{{ $s->kogol }}</td>
                                    <td>{{ $s->fakmkwh }}</td>
                                    <td>{{ $s->rpbp }}</td>
                                    <td>{{ $s->rpujl }}</td>
                                    <td>{{ $s->pemda }}</td>
                                    <td>{{ $s->nomorkwh }}</td>
                                    <td>{{ $s->statusplg }}</td>
                                    <td>{{ $s->kdpembmeter }}</td>
                                    <td>{{ $s->penyulang }}</td>
                                    <td>{{ $s->nama_section }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
@endsection
