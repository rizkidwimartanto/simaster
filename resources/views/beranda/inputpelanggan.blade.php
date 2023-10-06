@extends('layout/templateberanda')
@section('content')
    <div class="container mt-3">
        <form method="post" action="/inputpelanggan/import_excel" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-label">Custom File Input</div>
            <input type="file" name="file" class="form-control" />
            <button type="submit" class="btn btn-primary mt-3 mb-3">Import Excel</button>
        </form>

        <div class="col-lg-12">
            <div class="card p-3">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-bordered" id="tabel_data_pelanggan">
                        <thead>
                            <tr>
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
