@extends('layouts.index')
@section('title','Tambah Data Transaksi')
@section('container')

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
  <div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
      <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
          <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Transaksi</h1>
          <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7">
            <li class="breadcrumb-item text-muted">
              <a href="{{url('transaksi-sampah')}}" class="text-muted text-hover-primary">Home</a>
            </li>
            <li class="breadcrumb-item">
              <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted">Tambah Data Transaksi</li>
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
                  <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0 text-center">Form Tambah Data Transaksi</h1>
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
                  <form class="form" action="{{url('transaksi-sampah')}}" method="POST">
                    @csrf
                    <div class="d-flex flex-column mb-3 fv-row">
                      <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span>Kode Transaksi</span>
                      </label>
                      <input type="text" class="form-control bg-secondary" id="kode_transaksi" name="kode_transaksi" readonly="true" />
                    </div>
                    <div class="d-flex flex-column mb-3 fv-row">
                      <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">ID Pengguna</span>
                      </label>
                      <input type="text" class="form-control" name="user_id" id="user_id" />
                    </div>
                    <div class="d-flex flex-column mb-3 fv-row">
                      <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span>Nama Pengguna</span>
                      </label>
                      <input type="text" class="form-control bg-secondary" name="name" id="name" readonly="true"/>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                      <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span>Tanggal Transaksi</span>
                      </label>
                      <input type="date" class="form-control" name="tanggal_transaksi" value="{{ date('Y-m-d') }}" />
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

                  <!-- Tambahkan bagian berikut di bawah formulir atau di bagian head tampilan jika Anda meletakkan skrip di bagian head -->
                  <script>
                    // Function untuk menghasilkan kode unik secara acak
                    function generateUniqueCode() {
                      var uniqueCode = Math.random().toString(36).substr(2, 6);
                      document.getElementById('kode_transaksi').value = uniqueCode;
                    }

                    // Panggil fungsi generateUniqueCode() saat halaman selesai dimuat
                    document.addEventListener('DOMContentLoaded', function() {
                      generateUniqueCode();
                    });
                  </script>

                  <script>
                    document.getElementById('user_id').addEventListener('input', function() {
                      var userId = this.value;

                      // Lakukan permintaan AJAX ke server untuk mendapatkan data nama berdasarkan ID pengguna
                      fetch(`/get-user-name?user_id=${userId}`)
                        .then(response => response.json())
                        .then(data => {
                          // Set data nama ke input "Nama Pengguna"
                          document.getElementById('name').value = data.name || '';
                        });
                    });
                  </script>

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