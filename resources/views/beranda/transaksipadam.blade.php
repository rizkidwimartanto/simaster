@extends('layout/templateberanda')
@section('content')
    @php
        $uniqueSections = array_unique($sections);
        $uniqueSectionPelanggan = array_unique($data_section);
    @endphp

    @foreach ($uniqueSections as $section)
        @foreach ($uniqueSectionPelanggan as $item_section)
            <p>{{ $item_section }} : {{ $section }}</p>
        @endforeach
    @endforeach

    <div class="container-fluid mt-3">
        @if (session('success_nyala'))
            <div class="alert alert-success">
                {{ session('success_nyala') }}
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
        @if (session('error_nyala'))
            <div class="alert alert-danger">
                {{ session('error_nyala') }}
            </div>
        @endif
        <div class="card p-3 mb-3">
            <canvas id="myChart" style="width:100%;max-width:550px"></canvas>
        </div>
        <div class="col-lg-12">
            <div class="card p-3">
                <form action="/transaksipadam/edit_status_padam" method="post">
                    @csrf
                    <input type="hidden" value="Menyala" name="status" id="status">
                    <a href="#" class="btn btn-success col-12 mb-3" data-bs-toggle="modal"
                        data-bs-target="#modal-report"><i class="fa-solid fa-power-off fa-lg"
                            style="margin-right: 5px;"></i>
                        Hidupkan
                    </a>
                    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Update</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Jam Nyala</label>
                                                <input type="datetime-local"
                                                    class="form-control @error('jam_nyala') is-invalid @enderror"
                                                    name="jam_nyala" id="jam_nyala">
                                                @error('jam_nyala')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Penyebab Fix</label>
                                                <textarea class="form-control @error('penyebab_fix') is-invalid @enderror" rows="3" name="penyebab_fix"
                                                    id="penyebab_fix"></textarea>
                                                @error('penyebab_fix')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancel</a>
                                    <button type="submit" class="btn btn-success ms-auto">
                                        <i class="fa-solid fa-power-off" style="margin-right: 5px;"></i> Hidupkan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-vcenter table-bordered" id="tabel_data_padam">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th width="5%">
                                    <div class="d-flex justify-content-center">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" type="checkbox" id="checklist-padam">
                                        </div>
                                    </div>
                                </th>
                                <th>Penyulang</th>
                                <th>Section</th>
                                <th>Penyebab Padam</th>
                                <th>Jam Padam</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($data_padam as $s)
                                @if ($s->status == 'Menyala')
                                    <tr style="visibility:hidden; position:absolute;">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $s->id }}" id="flexCheckDefault" name="check[]">
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $s->penyulang }}</td>
                                        <td>{{ $s->section }}</td>
                                        <td>{{ $s->penyebab_padam }}</td>
                                        <td>{{ $s->jam_padam }}</td>
                                        <td>{{ $s->keterangan }}</td>
                                        <td>{{ $s->status }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card p-3 mt-4">
                <table class="table table-vcenter table-bordered" id="tabel_data_menyala">
                    <thead>
                        <tr>
                            <th width="1%">No</th>
                            <th>Penyulang</th>
                            <th>Section</th>
                            <th>Penyebab Padam</th>
                            <th>Penyebab Fix</th>
                            <th>Jam Padam</th>
                            <th>Jam Nyala</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($data_padam as $s)
                            @if ($s->status == 'Menyala')
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $s->penyulang }}</td>
                                    <td>{{ $s->section }}</td>
                                    <td>{{ $s->penyebab_padam }}</td>
                                    <td>{{ $s->penyebab_fix }}</td>
                                    <td>{{ $s->jam_padam }}</td>
                                    <td>{{ $s->jam_nyala }}</td>
                                    <td>{{ $s->keterangan }}</td>
                                    <td>{{ $s->status }}</td>
                                </tr>
                            @endif
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
                'pageLength': 500,
                'lengthMenu': [10, 25, 50, 100, 200, 500]
            });
        });
        $(document).ready(function() {
            $('#tabel_data_menyala').DataTable({
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
    <script>
        var xValues = ["KDS21", "SYG14"];
        var yValues = [KDS21, SYG14];
        var barColors = [
            "#b91d47",
            "#00aba9",
        ];

        new Chart("myChart", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Jumlah Padam Demak"
                }
            }
        });
    </script>
@endsection
