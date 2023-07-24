@extends('layouts.index')
@section('title','Ubah Data Sampah Dimanfaatkan')
@section('container')

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
  <div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
      <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
          <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Sampah Dimanfaatkan</h1>
          <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7">
            <li class="breadcrumb-item text-muted">
              <a href="{{url('sampah-dimanfaatkan')}}" class="text-muted text-hover-primary">Home</a>
            </li>
            <li class="breadcrumb-item">
              <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted">Ubah Data Sampah Dimanfaatkan</li>
          </ul>
        </div>
      </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
      <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
          <div class="col-xxl-6">
            <div class="card card-flush h-md-100">
              <div class="card-body d-flex flex-column justify-content-between bgi-no-repeat bgi-size-cover bgi-position-x-center pb-0">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                  <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0 text-center">Form Ubah Data Sampah Dimanfaatkan</h1>
                </div>
                <hr>
                <div>
                  <!-- NOTIFIKASI ERROR -->
                  @if ($errors->any())
                  <div id="notification" class="alert alert-danger" style="display: none;">
                    <ul>
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                  <script>
                    // Tampilkan notifikasi saat halaman dimuat
                    document.addEventListener('DOMContentLoaded', function() {
                      document.getElementById('notification').style.display = 'block';

                      // Atur waktu penghilangan notifikasi setelah 3 detik
                      setTimeout(function() {
                        document.getElementById('notification').style.display = 'none';
                      }, 5000);
                    });
                  </script>
                  @endif
                  <form class="form" action="/sampah-dimanfaatkan/{{$sampahDimanfaatkan->id}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="d-flex flex-column mb-3 fv-row">
                      <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">ID Petugas</span>
                      </label>
                      <input type="number" class="form-control bg-secondary" placeholder="00" name="petugas" value="{{Auth::user()->id}}" readonly="true" />
                    </div>
                    <div class="d-flex flex-column mb-3 fv-row">
                      <label for="jenisSampah" class="fs-6 fw-semibold mb-2 required">Jenis Sampah</label>
                      <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jenis Sampah" name="jenis_sampah" id="jenisSampah">
                        @foreach ($jenisSampahs as $jenisSampah)
                        <option value="{{$jenisSampah->id}}" {{ $jenisSampah->kategori_sampah_id == $jenisSampah->id ? 'selected' : '' }}>
                          {{$jenisSampah->name}}
                        </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="d-flex flex-column mb-3 fv-row">
                      <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Berat (Kg)</span>
                      </label>
                      <input type="number" class="form-control" placeholder="00" name="berat" value="{{old('berat',$sampahDimanfaatkan->berat)}}" />
                    </div>
                    <div class="d-flex flex-column mb-3 fv-row">
                      <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Tanggal Dimanfaatkan</span>
                      </label>
                      <input type="date" class="form-control" name="tanggal_dimanfaatkan" value="{{ date('Y-m-d') }}" />
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                      <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Keterangan</span>
                      </label>
                      <textarea name="keterangan" id="keterangan" cols="10" rows="10" class="form-control" placeholder="Tambahkan Keterangan">{{old('keterangan',$sampahDimanfaatkan->keterangan)}}</textarea>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                      <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Status</span>
                      </label>
                      <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Pilih Status Sampah" name="status" id="status">
                        @if (old('status', $sampahDimanfaatkan->status) == 'Dalam proses')
                        <option value="Dalam proses" selected>Dalam proses</option>
                        <option value="Ditolak">Ditolak</option>
                        <option value="Selesai">Selesai</option>
                        @elseif (old('status', $sampahDimanfaatkan->status) == 'Proses')
                        <option value="Dalam proses">Dalam proses</option>
                        <option value="Ditolak" selected>Ditolak</option>
                        <option value="Selesai">Selesai</option>
                        @elseif (old('status', $sampahDimanfaatkan->status) == 'selesai')
                        <option value="Dalam proses">Dalam proses</option>
                        <option value="Ditolak">Ditolak</option>
                        <option value="Selesai" selected>Selesai</option>
                        @endif
                      </select>
                    </div>
                    <div class="mb-10">
                      <button type="submit" class="btn btn-primary btn-sm">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">Please wait...
                          <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                      </button>
                      <button type="reset" class="btn btn-secondary me-5 btn-sm">Batal</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection