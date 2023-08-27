@extends('layouts.index')
@section('title','Tambah Data Jenis Sampah')
@section('container')

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
  <div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
      <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
          <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Jenis Sampah</h1>
          <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7">
            <li class="breadcrumb-item text-muted">
              <a href="{{url('jenis-sampah')}}" class="text-muted text-hover-primary">Home</a>
            </li>
            <li class="breadcrumb-item">
              <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted">Tambah Data Jenis Sampah</li>
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
                  <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0 text-center">Form Tambah Data Jenis Sampah</h1>
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
                  <form class="form" action="{{url('jenis-sampah')}}" method="POST">
                    @csrf
                    <div class="d-flex flex-column mb-3 fv-row">
                      <label for="kategoriSampah" class="fs-6 fw-semibold mb-2 required">Kategori Sampah</label>
                      <select class="form-select rounded-0" data-control="select2" data-hide-search="true" data-placeholder="Pilih Kategori Sampah" name="kategori_sampah" id="kategoriSampah">
                        <option value="">Pilih Kategori Sampah</option>
                        @foreach ($kategoriSampahs as $kategoriSampah)
                        @if (old('kategoriSampah_id')===$kategoriSampah->id)
                        <option value="{{$kategoriSampah->id}}" selected>{{$kategoriSampah->name}}</option>
                        @else
                        <option value="{{$kategoriSampah->id}}">{{$kategoriSampah->name}}</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                    <div class="d-flex flex-column mb-3 fv-row">
                      <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Jenis Sampah</span>
                      </label>
                      <input type="text" class="form-control rounded-0" placeholder="Masukkan Jenis Sampah" name="name" value="{{old('name')}}"/>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                      <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span>Point Per Kilogram</span>
                      </label>
                      <input type="text" class="form-control rounded-0" placeholder="Masukkan Jumlah Point per Kilogram" name="point_perkg" value="{{old('point_perkg')}}"/>
                    </div>
                    <div class="mb-10">
                      <button type="submit" class="btn btn-primary rounded-0 fw-bold">Simpan</button>
                      <button type="reset" class="btn btn-secondary me-5 rounded-0 fw-bold">Batal</button>
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