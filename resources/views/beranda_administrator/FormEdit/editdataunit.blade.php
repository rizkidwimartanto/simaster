@extends('layout/templateberanda')
@section('content')
    <div class="container-fluid mt-5">
        <div class="card shadow-lg border-0 rounded">
            <div class="card-header bg-info text-white text-center rounded-top">
                <h3 class="mb-0">Edit Data Unit</h3>
            </div>
            <div class="card-body p-4">
                <form action="/simaster/updating/edit_unit/{{ $dataunit->id }}" method="post">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $dataunit->id }}">
                    <div class="mb-3">
                        <label class="form-label">Unit</label>
                        <div class="input-group input-group-flat">
                            <input type="hidden" name="idunit" id="idunit" value="{{ $dataunit->idunit }}">
                            <select disabled class="form-control" name="unit" id="unit">
                                <option selected>--- Pilih Unit---
                                </option>
                                <option value="ULP Demak" {{ $dataunit->unit == 'ULP Demak' ? 'selected' : '' }}>
                                    ULP Demak</option>
                                <option value="ULP Tegowanu" {{ $dataunit->unit == 'ULP Tegowanu' ? 'selected' : '' }}>
                                    ULP Tegowanu</option>
                                <option value="ULP Purwodadi" {{ $dataunit->unit == 'ULP Purwodadi' ? 'selected' : '' }}>
                                    ULP Purwodadi
                                </option>
                                <option value="ULP Wirosari" {{ $dataunit->unit == 'ULP Wirosari' ? 'selected' : '' }}>
                                    ULP Wirosari</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor MULP</label>
                        <div class="input-group input-group-flat">
                            <input type="text" class="form-control" name="no_mulp" id="no_mulp"
                                value="{{ $dataunit->no_mulp }}" inputmode="numeric" pattern="[0-9]*">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor TL Teknik</label>
                        <div class="input-group input-group-flat">
                            <input type="text" class="form-control" name="no_tlteknik" id="no_tlteknik"
                                value="{{ $dataunit->no_tlteknik }}" inputmode="numeric" pattern="[0-9]*">
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-block" type="submit"><i
                                class="fa-solid fa-right-to-bracket fa-lg" style="margin-right: 5px;"></i> Submit</button>
                        <a href="/simaster/updating" class="btn btn-secondary"><i class="fa-solid fa-left-long fa-lg"
                                style="margin-right: 5px;"></i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
