@extends('layout/templateberanda')
@section('content')
    <div class="container-fluid mt-5">
        <div class="card shadow-lg border-0 rounded">
            <div class="card-header bg-info text-white text-center rounded-top">
                <h3 class="mb-0">Edit Data Pelanggan</h3>
            </div>
            <div class="card-body p-4">
                <form action="/simaster/updating/edit_pelanggan/{{ $pelanggan->id }}" method="post">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $pelanggan->id }}">
                    <div class="mb-3">
                        <label class="form-label">Nama
                            Pelanggan</label>
                        <div class="input-group input-group-flat">
                            <input type="text" name="nama" id="nama" value="{{ $pelanggan->nama }}"
                                class="form-control @error('nama') is-invalid @enderror">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <div class="input-group input-group-flat">
                            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" rows="3">{{ $pelanggan->alamat }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No HP
                            StakeHolder</label>
                        <div class="input-group input-group-flat">
                            <input inputmode="numeric" pattern="[0-9]*" type="text" name="nohp_stakeholder" id="nohp_stakeholder"
                                value="{{ $pelanggan->nohp_stakeholder }}"
                                class="form-control @error('nohp_stakeholder') is-invalid @enderror">
                            @error('nohp_stakeholder')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No HP PIC
                            Lapangan</label>
                        <div class="input-group input-group-flat">
                            <input inputmode="numeric" pattern="[0-9]*" type="text" name="nohp_piclapangan" id="nohp_piclapangan"
                                value="{{ $pelanggan->nohp_piclapangan }}"
                                class="form-control @error('nohp_piclapangan') is-invalid @enderror">
                            @error('nohp_piclapangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Latitude</label>
                        <div class="input-group input-group-flat">
                            <input inputmode="numeric" pattern="[0-9]*" type="text" name="latitude" id="latitude" value="{{ $pelanggan->latitude }}"
                                class="form-control @error('latitude') is-invalid @enderror">
                            @error('latitude')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Longtitude</label>
                        <div class="input-group input-group-flat">
                            <input inputmode="numeric" pattern="[0-9]*" type="text" name="longtitude" id="longtitude" value="{{ $pelanggan->longtitude }}"
                                class="form-control @error('longtitude') is-invalid @enderror">
                            @error('longtitude')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Unit ULP</label>
                        <div class="input-group input-group-flat">
                            <select name="unitulp" id="unitulp"
                                class="form-control @error('unitulp') is-invalid @enderror">
                                <option value="52550" {{ $pelanggan->unitulp == 52550 ? 'selected' : '' }}>
                                    UP3
                                    Demak</option>
                                <option value="52551" {{ $pelanggan->unitulp == 52551 ? 'selected' : '' }}>
                                    ULP
                                    Demak</option>
                                <option value="52552" {{ $pelanggan->unitulp == 52552 ? 'selected' : '' }}>
                                    ULP
                                    Tegowanu</option>
                                <option value="52553" {{ $pelanggan->unitulp == 52553 ? 'selected' : '' }}>
                                    ULP
                                    Purwodadi</option>
                                <option value="52554" {{ $pelanggan->unitulp == 52554 ? 'selected' : '' }}>
                                    ULP
                                    Wirosari</option>
                            </select>
                            @error('unitulp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tarif</label>
                        <div class="input-group input-group-flat">
                            <input type="text" name="tarif" id="tarif" value="{{ $pelanggan->tarif }}"
                                class="form-control @error('tarif') is-invalid @enderror">
                            @error('tarif')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Daya</label>
                        <div class="input-group input-group-flat">
                            <input inputmode="numeric" pattern="[0-9]*" type="text" name="daya" id="daya" value="{{ $pelanggan->daya }}"
                                class="form-control @error('daya') is-invalid @enderror">
                            @error('daya')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">KOGOL</label>
                        <div class="input-group input-group-flat">
                            <input type="text" name="kogol" id="kogol" value="{{ $pelanggan->kogol }}"
                                class="form-control @error('kogol') is-invalid @enderror">
                            @error('kogol')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">fakmkwh</label>
                        <div class="input-group input-group-flat">
                            <input type="text" name="fakmkwh" id="fakmkwh" value="{{ $pelanggan->fakmkwh }}"
                                class="form-control @error('fakmkwh') is-invalid @enderror">
                            @error('fakmkwh')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">rpbp</label>
                        <div class="input-group input-group-flat">
                            <input type="text" name="rpbp" id="rpbp" value="{{ $pelanggan->rpbp }}"
                                class="form-control @error('rpbp') is-invalid @enderror">
                            @error('rpbp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">rpujl</label>
                        <div class="input-group input-group-flat">
                            <input type="text" name="rpujl" id="rpujl" value="{{ $pelanggan->rpujl }}"
                                class="form-control @error('rpujl') is-invalid @enderror">
                            @error('rpujl')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">nomor_kwh</label>
                        <div class="input-group input-group-flat">
                            <input inputmode="numeric" pattern="[0-9]*" type="text" name="nomor_kwh" id="nomor_kwh" value="{{ $pelanggan->nomor_kwh }}"
                                class="form-control @error('nomor_kwh') is-invalid @enderror">
                            @error('nomor_kwh')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">penyulang</label>
                        <div class="input-group input-group-flat">
                            <input type="text" name="penyulang" id="penyulang" value="{{ $pelanggan->penyulang }}"
                                class="form-control @error('penyulang') is-invalid @enderror">
                            @error('penyulang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">nama_section</label>
                        <div class="input-group input-group-flat">
                            <input type="text" value="{{ $pelanggan->nama_section }}"
                                class="form-control @error('nama_section') is-invalid @enderror" name="nama_section">
                            @error('nama_section')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kali
                            Padam</label>
                        <div class="input-group input-group-flat">
                            @if ($pelanggan->entriPadam)
                                <input value="{{ $pelanggan->entriPadam->kalipadam }}" class="form-control" readonly>
                            @else
                                <input value="{{ 0 }}" class="form-control">
                            @endif
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
