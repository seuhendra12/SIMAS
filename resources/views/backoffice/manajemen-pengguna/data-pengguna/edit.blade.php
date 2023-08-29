@extends('layouts.index')
@section('title','Ubah Data Pengguna')
@section('container')

<!-- MAIN CONTENT -->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
  <div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
      <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
          <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Pengguna</h1>
          <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7">
            <li class="breadcrumb-item text-muted">
              <a href="{{url('data-pengguna')}}" class="text-muted text-hover-primary">Home</a>
            </li>
            <li class="breadcrumb-item">
              <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted">Ubah Data Pengguna</li>
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
                  <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0 text-center">Form Ubah Data Pengguna</h1>
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
                  <form class="form" action="/data-pengguna/{{$user->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="d-flex flex-column mb-3 fv-row">
                      <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Nomor Induk Keluarga</span>
                      </label>
                      <input type="text" class="form-control rounded-0" placeholder="Masukkan NIK" name="nik" value="{{ old('nik', $user->nik) }}" />
                    </div>
                    <div class="d-flex flex-column mb-3 fv-row">
                      <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Nama Lengkap</span>
                      </label>
                      <input type="text" class="form-control rounded-0" placeholder="Masukkan Nama Lengkap" name="name" value="{{ old('name', $user->name) }}" />
                    </div>
                    <div class="d-flex flex-column mb-3 fv-row">
                      <div class="row">
                        <div class="col-6">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Tempat Lahir</span>
                          </label>
                          <input type="text" class="form-control rounded-0" placeholder="Masukkan Tempat Lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $user->profile->tempat_lahir) }}" />
                        </div>
                        <div class="col-6">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Tanggal Lahir</span>
                          </label>
                          <input type="date" class="form-control rounded-0" placeholder="Masukkan Tempat Lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $user->profile->tanggal_lahir) }}" />
                        </div>
                      </div>
                    </div>
                    <div class="g-9 mb-3">
                      <label class="required fs-6 fw-semibold mb-2">Jenis Kelamin</label>
                      <select class="form-select rounded-0" data-control="select2" data-hide-search="true" name="jenis_kelamin">
                        <option value="L" {{ (old('jenis_kelamin', $user->profile->jenis_kelamin) === 'L') ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ (old('jenis_kelamin', $user->profile->jenis_kelamin) === 'P') ? 'selected' : '' }}>Perempuan</option>
                      </select>
                    </div>
                    <div class="g-9 mb-3">
                      <label class="required fs-6 fw-semibold mb-2">Role</label>
                      <select class="form-select rounded-0" data-control="select2" data-hide-search="true" data-placeholder="Pilih Level Akses Pengguna" name="role">
                        @if(Auth::user()->role === 'SuperAdmin')
                        <option value="Admin" {{ (old('role', $user->role) === 'Admin') ? 'selected' : '' }}>Admin</option>
                        @endif
                        <option value="Petugas" {{ (old('role', $user->role) === 'Petugas') ? 'selected' : '' }}>Petugas</option>
                        <option value="Kelurahan" {{ (old('role', $user->role) === 'Kelurahan') ? 'selected' : '' }}>Kelurahan</option>
                        <option value="User" {{ (old('role', $user->role) === 'User') ? 'selected' : '' }}>User</option>
                        <option value="RW" {{ (old('role', $user->role) === 'RW') ? 'selected' : '' }}>RW</option>
                        <option value="RT" {{ (old('role', $user->role) === 'RT') ? 'selected' : '' }}>RT</option>
                      </select>
                    </div>
                    <div class="d-flex flex-column mb-3 fv-row">
                      <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">No Telepon</span>
                      </label>
                      <input type="text" class="form-control rounded-0" placeholder="Masukan No Telepon" name="no_telepon" value="{{ old('no_telepon', $user->profile->no_wa) }}" />
                    </div>
                    <div class="d-flex flex-column mb-3 fv-row">
                      <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Alamat</span>
                      </label>
                      <textarea name="alamat" id="alamat" cols="10" rows="2" class="form-control rounded-0" placeholder="Tambahkan Alamat">{{ old('alamat', $user->profile->alamat) }}</textarea>
                    </div>
                    <div class="d-flex flex-column mb-3 fv-row">
                      <div class="row">
                        <div class="col-2">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">No Rumah</span>
                          </label>
                          <input type="text" class="form-control rounded-0" placeholder="00" name="no_rumah" value="{{ old('no_rumah', $user->profile->no_rumah) }}" />
                        </div>
                        <div class="col-2">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">RT</span>
                          </label>
                          <select class="form-select rounded-0" data-control="select2" data-hide-search="true" data-placeholder="Pilih RT Pengguna" name="rt">
                            @foreach ($rts as $rt)
                            <option value="{{ $rt->id }}" {{ (old('rt', $user->profile->rt_id) == $rt->id) ? 'selected' : '' }}>
                              {{ $rt->name }}
                            </option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-2">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">RW</span>
                          </label>
                          <select class="form-select rounded-0" data-control="select2" data-hide-search="true" data-placeholder="Pilih RW Pengguna" name="rw">
                            @foreach ($rws as $rw)
                            <option value="{{ $rw->id }}" {{ (old('rw', $user->profile->rw_id) == $rw->id) ? 'selected' : '' }}>
                              {{ $rw->name }}
                            </option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex flex-column mb-3 fv-row">
                      <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Kata Sandi</span>
                      </label>
                      <input type="password" class="form-password rounded-0" placeholder="Minimal 8 karakter" name="password" value="" />
                    </div>
                    <div class="row">
                      <div class="col-auto mt-1">
                        <input type="checkbox" class="form-checkbox mb-4 d-inline rounded-0">
                      </div>
                      <div class="col-10">
                        <div class="fw-semibold fs-6"> Tampilkan Kata Sandi</div>
                      </div>
                    </div>
                    <div class="d-flex flex-stack mb-3">
                      <label class="form-check form-switch form-check-custom form-check-solid">
                        <input name="is_active" class="form-check-input" type="checkbox" value="1" {{ $user['is_active'] == 1 ? 'checked' : '' }} />
                        <span class="form-check-label fw-semibold text-muted">Aktif</span>
                      </label>
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