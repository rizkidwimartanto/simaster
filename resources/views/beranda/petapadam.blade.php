@extends('layout/templateberanda')
@section('content')
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
                <form action="/petapadam/edit_status_padam" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" value="0" name="status" id="status">
                    <button type="submit" class="btn btn-success col-12 mb-3">Hidupkan</button>
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
                                    <td>{{ $s->penyulang }}</td>
                                    <td>{{ $s->section }}</td>
                                    <td>{{ $s->penyebab_padam }}</td>
                                    <td>{{ $s->jam_padam }}</td>
                                    <td>{{ $s->keterangan }}</td>
                                    <td>{{ $s->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
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
    <script>
        var KDS21 = @json($jumlah_KDS21);
        var SYG14 = @json($jumlah_SYG14);
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
