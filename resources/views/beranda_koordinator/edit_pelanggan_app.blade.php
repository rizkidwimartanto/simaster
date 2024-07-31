@extends('layout/templateberanda_user')
@section('content')
    <div class="container-fluid mt-4">
        <div class="card shadow-lg border-0 rounded">
            <div class="card-header bg-info text-white text-center rounded-top">
                <h3 class="mb-0">Edit Pelanggan APP</h3>
            </div>
            <div class="card-body p-4">
                <form action="/proses_edit_pelanggan_app/{{ $datapelangganapp->id }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">ID Pelanggan</label>
                        <input class="form-control @error('id_pelanggan') is-invalid @enderror" name="id_pelanggan"
                            id="id_pelanggan" type="text" inputmode="numeric" pattern="[0-9]*"
                            value="{{ old('id_pelanggan', $datapelangganapp->id_pelanggan) }}">
                        @error('id_pelanggan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Nama Pelanggan</label>
                        <input class="form-control @error('nama_pelanggan') is-invalid @enderror" name="nama_pelanggan"
                            id="nama_pelanggan" type="text"
                            value="{{ old('nama_pelanggan', $datapelangganapp->nama_pelanggan) }}">

                        @error('nama_pelanggan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Tarif</label>
                        <select class="form-control @error('tarif') is-invalid @enderror" name="tarif" id="tarif">
                            <option selected disabled>--- Pilih Tarif ---</option>
                            <option value="R1" {{ old('tarif', $datapelangganapp->tarif) == 'R1' ? 'selected' : '' }}>R1</option>
                            <option value="R1T" {{ old('tarif', $datapelangganapp->tarif) == 'R1T' ? 'selected' : '' }}>R1T</option>
                            <option value="R1M" {{ old('tarif', $datapelangganapp->tarif) == 'R1M' ? 'selected' : '' }}>R1M</option>
                            <option value="R1MT" {{ old('tarif', $datapelangganapp->tarif) == 'R1MT' ? 'selected' : '' }}>R1MT</option>
                            <option value="R2" {{ old('tarif', $datapelangganapp->tarif) == 'R2' ? 'selected' : '' }}>R2</option>
                            <option value="R2T" {{ old('tarif', $datapelangganapp->tarif) == 'R2T' ? 'selected' : '' }}>R2T</option>
                            <option value="R3" {{ old('tarif', $datapelangganapp->tarif) == 'R3' ? 'selected' : '' }}>R3</option>
                            <option value="R3T" {{ old('tarif', $datapelangganapp->tarif) == 'R3T' ? 'selected' : '' }}>R3T</option>
                            <option value="B1" {{ old('tarif', $datapelangganapp->tarif) == 'B1' ? 'selected' : '' }}>B1</option>
                            <option value="B1T" {{ old('tarif', $datapelangganapp->tarif) == 'B1T' ? 'selected' : '' }}>B1T</option>
                            <option value="S2" {{ old('tarif', $datapelangganapp->tarif) == 'S2' ? 'selected' : '' }}>S2</option>
                            <option value="S2T" {{ old('tarif', $datapelangganapp->tarif) == 'S2T' ? 'selected' : '' }}>S2T</option>
                            <option value="P1" {{ old('tarif', $datapelangganapp->tarif) == 'P1' ? 'selected' : '' }}>P1</option>
                            <option value="P1T" {{ old('tarif', $datapelangganapp->tarif) == 'P1T' ? 'selected' : '' }}>P1T</option>
                            <option value="P3" {{ old('tarif', $datapelangganapp->tarif) == 'P3' ? 'selected' : '' }}>P3</option>
                            <option value="P3T" {{ old('tarif', $datapelangganapp->tarif) == 'P3T' ? 'selected' : '' }}>P3T</option>                            
                        </select>
                        @error('tarif')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Daya</label>
                        <select class="form-control @error('daya') is-invalid @enderror" name="daya" id="daya">
                            <option selected disabled>--- Pilih Daya ---</option>
                        </select>
                        @error('daya')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" cols="30"
                            rows="10">{{ old('alamat', $datapelangganapp->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                {{-- <label class="form-label">Latitude</label> --}}
                                <input class="form-control" name="latitude" id="latitude" type="hidden" value="{{$datapelangganapp->latitude}}" readonly>
                            </div>
                            <div class="col-md-6">
                                {{-- <label class="form-label">Longitude</label> --}}
                                <input class="form-control" name="longitude" id="longitude" type="hidden" value="{{$datapelangganapp->longitude}}" readonly>
                            </div>
                        </div>
                    </div>
                    <h1>Data APP</h1>
                    <div class="mb-4">
                        <label class="form-label">Jenis Meter</label>
                        <select class="form-control @error('jenis_meter') is-invalid @enderror" name="jenis_meter"
                            id="jenis_meter">
                            <option value="" disabled selected>--- Pilih Jenis Meter ---</option>
                            <option value="Prabayar"
                                {{ old('jenis_meter', $datapelangganapp->jenis_meter) == 'Prabayar' ? 'selected' : '' }}>
                                Prabayar
                            </option>
                            <option value="Pascabayar"
                                {{ old('jenis_meter', $datapelangganapp->jenis_meter) == 'Pascabayar' ? 'selected' : '' }}>
                                Pascabayar
                            </option>
                        </select>
                        @error('jenis_meter')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Merk Meter</label>
                        <select class="form-control @error('merk_meter') is-invalid @enderror" name="merk_meter"
                            id="merk_meter">
                            <option value="" disabled selected>--- Pilih Merk Meter ---</option>
                            <option value="Actaris"
                                {{ old('merk_meter', $datapelangganapp->merk_meter) == 'Actaris' ? 'selected' : '' }}>
                                Actaris</option>
                            <option value="Cannet"
                                {{ old('merk_meter', $datapelangganapp->merk_meter) == 'Cannet' ? 'selected' : '' }}>
                                Cannet</option>
                            <option value="Conlog"
                                {{ old('merk_meter', $datapelangganapp->merk_meter) == 'Conlog' ? 'selected' : '' }}>
                                Conlog</option>
                            <option value="Fuji"
                                {{ old('merk_meter', $datapelangganapp->merk_meter) == 'Fuji' ? 'selected' : '' }}>Fuji
                            </option>
                            <option value="Hexing"
                                {{ old('merk_meter', $datapelangganapp->merk_meter) == 'Hexing' ? 'selected' : '' }}>
                                Hexing</option>
                            <option value="Itron"
                                {{ old('merk_meter', $datapelangganapp->merk_meter) == 'Itron' ? 'selected' : '' }}>Itron
                            </option>
                            <option value="Landis"
                                {{ old('merk_meter', $datapelangganapp->merk_meter) == 'Landis' ? 'selected' : '' }}>
                                Landis</option>
                            <option value="Melcoinda"
                                {{ old('merk_meter', $datapelangganapp->merk_meter) == 'Melcoinda' ? 'selected' : '' }}>
                                Melcoinda</option>
                            <option value="Prima"
                                {{ old('merk_meter', $datapelangganapp->merk_meter) == 'Prima' ? 'selected' : '' }}>Prima
                            </option>
                            <option value="Sanxing"
                                {{ old('merk_meter', $datapelangganapp->merk_meter) == 'Sanxing' ? 'selected' : '' }}>
                                Sanxing</option>
                            <option value="SmartMeter"
                                {{ old('merk_meter', $datapelangganapp->merk_meter) == 'SmartMeter' ? 'selected' : '' }}>
                                SmartMeter</option>
                        </select>
                        @error('merk_meter')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Tahun Meter</label>
                        <input class="form-control @error('tahun_meter') is-invalid @enderror" name="tahun_meter"
                            id="tahun_meter" type="text" inputmode="numeric" pattern="[0-9]*"
                            value="{{ old('tahun_meter', $datapelangganapp->tahun_meter) }}">
                        @error('tahun_meter')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Nomor Meter</label>
                        <input class="form-control @error('nomor_meter') is-invalid @enderror" name="nomor_meter"
                            id="nomor_meter" type="text" inputmode="numeric" pattern="[0-9]*"
                            value="{{ old('nomor_meter', $datapelangganapp->nomor_meter) }}">
                        @error('nomor_meter')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Merk MCB</label>
                        <select class="form-control @error('merk_mcb') is-invalid @enderror" name="merk_mcb"
                            id="merk_mcb">
                            <option value="" disabled selected>--- Pilih Merk MCB ---</option>
                            <option value="ABB"
                                {{ old('merk_mcb', $datapelangganapp->merk_mcb) == 'ABB' ? 'selected' : '' }}>ABB</option>
                            <option value="ABBA"
                                {{ old('merk_mcb', $datapelangganapp->merk_mcb) == 'ABBA' ? 'selected' : '' }}>ABBA
                            </option>
                            <option value="BROCO"
                                {{ old('merk_mcb', $datapelangganapp->merk_mcb) == 'BROCO' ? 'selected' : '' }}>BROCO
                            </option>
                            <option value="DAYA"
                                {{ old('merk_mcb', $datapelangganapp->merk_mcb) == 'DAYA' ? 'selected' : '' }}>DAYA
                            </option>
                            <option value="EMCO"
                                {{ old('merk_mcb', $datapelangganapp->merk_mcb) == 'EMCO' ? 'selected' : '' }}>EMCO
                            </option>
                            <option value="ELEKTRO"
                                {{ old('merk_mcb', $datapelangganapp->merk_mcb) == 'ELEKTRO' ? 'selected' : '' }}>ELEKTRO
                            </option>
                            <option value="HPL"
                                {{ old('merk_mcb', $datapelangganapp->merk_mcb) == 'HPL' ? 'selected' : '' }}>HPL</option>
                            <option value="LG"
                                {{ old('merk_mcb', $datapelangganapp->merk_mcb) == 'LG' ? 'selected' : '' }}>LG</option>
                            <option value="MCCB / HAGER"
                                {{ old('merk_mcb', $datapelangganapp->merk_mcb) == 'MCCB / HAGER' ? 'selected' : '' }}>MCCB
                                / HAGER</option>
                            <option value="MELCO"
                                {{ old('merk_mcb', $datapelangganapp->merk_mcb) == 'MELCO' ? 'selected' : '' }}>MELCO
                            </option>
                            <option value="MERLIN"
                                {{ old('merk_mcb', $datapelangganapp->merk_mcb) == 'MERLIN' ? 'selected' : '' }}>MERLIN
                            </option>
                            <option value="MERLIN GERIN"
                                {{ old('merk_mcb', $datapelangganapp->merk_mcb) == 'MERLIN GERIN' ? 'selected' : '' }}>
                                MERLIN GERIN</option>
                            <option value="OSAKI"
                                {{ old('merk_mcb', $datapelangganapp->merk_mcb) == 'OSAKI' ? 'selected' : '' }}>OSAKI
                            </option>
                            <option value="SCHNEIDER"
                                {{ old('merk_mcb', $datapelangganapp->merk_mcb) == 'SCHNEIDER' ? 'selected' : '' }}>
                                SCHNEIDER</option>
                        </select>
                        @error('merk_mcb')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Ukuran MCB</label>
                        <select class="form-control @error('ukuran_mcb') is-invalid @enderror" name="ukuran_mcb"
                            id="ukuran_mcb">
                            <option value="" disabled {{ old('ukuran_mcb') === null ? 'selected' : '' }}>--- Pilih
                                Ukuran MCB ---</option>
                                <option value="2" {{ old('ukuran_mcb', $datapelangganapp->ukuran_mcb) == '2' ? 'selected' : '' }}>2</option>
                                <option value="4" {{ old('ukuran_mcb', $datapelangganapp->ukuran_mcb) == '4' ? 'selected' : '' }}>4</option>
                                <option value="6" {{ old('ukuran_mcb', $datapelangganapp->ukuran_mcb) == '6' ? 'selected' : '' }}>6</option>
                                <option value="10" {{ old('ukuran_mcb', $datapelangganapp->ukuran_mcb) == '10' ? 'selected' : '' }}>10</option>
                                <option value="16" {{ old('ukuran_mcb', $datapelangganapp->ukuran_mcb) == '16' ? 'selected' : '' }}>16</option>
                                <option value="20" {{ old('ukuran_mcb', $datapelangganapp->ukuran_mcb) == '20' ? 'selected' : '' }}>20</option>
                                <option value="25" {{ old('ukuran_mcb', $datapelangganapp->ukuran_mcb) == '25' ? 'selected' : '' }}>25</option>
                                <option value="35" {{ old('ukuran_mcb', $datapelangganapp->ukuran_mcb) == '35' ? 'selected' : '' }}>35</option>
                                <option value="50" {{ old('ukuran_mcb', $datapelangganapp->ukuran_mcb) == '50' ? 'selected' : '' }}>50</option>                                
                        </select>
                        @error('ukuran_mcb')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">NO Segel</label>
                        <input class="form-control @error('no_segel') is-invalid @enderror" name="no_segel"
                            id="no_segel" type="text" value="{{ old('no_segel', $datapelangganapp->no_segel) }}">
                        @error('no_segel')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">NO Gardu</label>
                        <input class="form-control @error('no_gardu') is-invalid @enderror" name="no_gardu"
                            id="no_gardu" type="text" value="{{ old('no_gardu', $datapelangganapp->no_gardu) }}">
                        @error('no_gardu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Tarikan ke ......</label>
                        <input class="form-control @error('sr_deret') is-invalid @enderror" name="sr_deret"
                            id="sr_deret" type="text" inputmode="numeric" pattern="[0-9]*"
                            value="{{ old('sr_deret', $datapelangganapp->sr_deret) }}">
                        @error('sr_deret')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Catatan</label>
                        <textarea class="form-control" name="catatan" id="catatan" cols="30" rows="10">{{ old('catatan', $datapelangganapp->catatan) }}</textarea>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success mb-4">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
      document.getElementById("tarif").addEventListener("change", function() {
          updateDayaOptions();
      });
  
      function updateDayaOptions() {
          var dayaSelected = document.getElementById("daya");
          var selectedTarif = document.getElementById("tarif").value;
          var oldDaya = "{{ old('daya', $datapelangganapp->daya) }}";
  
          dayaSelected.innerHTML = "<option selected disabled>--- Pilih Daya ---</option>";
  
          if (selectedTarif === "R1" || selectedTarif === "R1T") {
              addOption(dayaSelected, "450 VA", oldDaya);
              addOption(dayaSelected, "900 VA", oldDaya);
              addOption(dayaSelected, "1300 VA", oldDaya);
              addOption(dayaSelected, "2200 VA", oldDaya);
          } else if (selectedTarif === "R1M" || selectedTarif === "R1MT") {
              addOption(dayaSelected, "900 VA", oldDaya);
          } else if (selectedTarif === "R2" || selectedTarif === "R2T") {
              addOption(dayaSelected, "3500 VA", oldDaya);
              addOption(dayaSelected, "4400 VA", oldDaya);
              addOption(dayaSelected, "5500 VA", oldDaya);
          } else if (selectedTarif === "R3" || selectedTarif === "R3T") {
              addOption(dayaSelected, "7700 VA", oldDaya);
              addOption(dayaSelected, "11000 VA", oldDaya);
          } else if (selectedTarif === "B1" || selectedTarif === "B1T") {
              addOption(dayaSelected, "450 VA", oldDaya);
              addOption(dayaSelected, "900 VA", oldDaya);
              addOption(dayaSelected, "1300 VA", oldDaya);
              addOption(dayaSelected, "2200 VA", oldDaya);
              addOption(dayaSelected, "3500 VA", oldDaya);
              addOption(dayaSelected, "4400 VA", oldDaya);
              addOption(dayaSelected, "5500 VA", oldDaya);
          } else if (selectedTarif === "B2" || selectedTarif === "B2T") {
              addOption(dayaSelected, "7700 VA", oldDaya);
              addOption(dayaSelected, "11000 VA", oldDaya);
          } else if (selectedTarif === "S2" || selectedTarif === "S2T") {
              addOption(dayaSelected, "450 VA", oldDaya);
              addOption(dayaSelected, "900 VA", oldDaya);
              addOption(dayaSelected, "1300 VA", oldDaya);
              addOption(dayaSelected, "2200 VA", oldDaya);
              addOption(dayaSelected, "3500 VA", oldDaya);
              addOption(dayaSelected, "4400 VA", oldDaya);
              addOption(dayaSelected, "5500 VA", oldDaya);
              addOption(dayaSelected, "7700 VA", oldDaya);
              addOption(dayaSelected, "11000 VA", oldDaya);
          } else if (selectedTarif === "P1" || selectedTarif === "P1T") {
              addOption(dayaSelected, "450 VA", oldDaya);
              addOption(dayaSelected, "900 VA", oldDaya);
              addOption(dayaSelected, "1300 VA", oldDaya);
              addOption(dayaSelected, "2200 VA", oldDaya);
              addOption(dayaSelected, "3500 VA", oldDaya);
              addOption(dayaSelected, "4400 VA", oldDaya);
              addOption(dayaSelected, "5500 VA", oldDaya);
              addOption(dayaSelected, "7700 VA", oldDaya);
              addOption(dayaSelected, "11000 VA", oldDaya);
          } else if (selectedTarif === "P3" || selectedTarif === "P3T") {
              addOption(dayaSelected, "450 VA", oldDaya);
              addOption(dayaSelected, "900 VA", oldDaya);
              addOption(dayaSelected, "1300 VA", oldDaya);
              addOption(dayaSelected, "2200 VA", oldDaya);
              addOption(dayaSelected, "3500 VA", oldDaya);
              addOption(dayaSelected, "4400 VA", oldDaya);
              addOption(dayaSelected, "5500 VA", oldDaya);
              addOption(dayaSelected, "7700 VA", oldDaya);
              addOption(dayaSelected, "11000 VA", oldDaya);
          } else {
              dayaSelected.innerHTML += '<option value="other">Pilihan Daya Tidak Ada</option>';
          }
      }
  
      function addOption(selectElement, value, oldDaya) {
          var option = document.createElement("option");
          option.value = value;
          option.text = value;
          if (value === oldDaya) {
              option.selected = true;
          }
          selectElement.appendChild(option);
      }
  
      document.addEventListener("DOMContentLoaded", function() {
          updateDayaOptions();
      });
  </script>
  
@endsection
