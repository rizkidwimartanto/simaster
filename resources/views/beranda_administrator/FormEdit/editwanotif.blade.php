@extends('layout/templateberanda')
@section('content')
    <div class="container-fluid mt-5">
        <div class="card shadow-lg border-0 rounded">
            <div class="card-header bg-info text-white text-center rounded-top">
                <h3 class="mb-0">Edit WA Notif</h3>
            </div>
            <div class="card-body p-4">
                    <form action="/simaster/updating/edit_wanotif/{{ $wanotif->id }}" method="post">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{$wanotif->id}}">
                        <div class="mb-3">
                            <label class="form-label">ID Serial</label>
                            <div class="input-group input-group-flat">
                                <input type="text" class="form-control" name="idserial" id="idserial"
                                    value="{{ $wanotif->idserial }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ID Pel</label>
                            <div class="input-group input-group-flat">
                                <input type="text" class="form-control" name="idpel" id="idpel"
                                    value="{{ $wanotif->idpel }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ID Unit</label>
                            <div class="input-group input-group-flat">
                                <select class="form-control" name="idunit" id="idunit">
                                    <option selected disabled>--- Pilih ID
                                        Unit---
                                    </option>
                                    <option value="52551" {{ $wanotif->idunit == '52551' ? 'selected' : '' }}>
                                        52551</option>
                                    <option value="52552" {{ $wanotif->idunit == '52552' ? 'selected' : '' }}>
                                        52552</option>
                                    <option value="52553" {{ $wanotif->idunit == '52553' ? 'selected' : '' }}>
                                        52553
                                    </option>
                                    <option value="52554" {{ $wanotif->idunit == '52554' ? 'selected' : '' }}>
                                        52554</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-block" type="submit"><i class="fa-solid fa-right-to-bracket fa-lg" style="margin-right: 5px;"></i> Submit</button>
                            <a href="/simaster/updating" class="btn btn-secondary"><i class="fa-solid fa-left-long fa-lg" style="margin-right: 5px;"></i> Kembali</a>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection
