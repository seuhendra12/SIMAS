@extends('layouts.index')
@section('title','Detail Data Pengguna')
@section('container')

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
            <li class="breadcrumb-item text-muted">Detail Data Pengguna</li>
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
                  <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0 text-center">Detail Data Pengguna</h1>
                </div>
                <hr>
                <div class="container">
                  <div class="row">
                    <div class="col-5 mx-auto text-center">
                      <img src="{!! asset('/img/icon/icon_user.jpg') !!}" alt="User Image" class="rounded-circle me-2" style="width: 150px; height: 150px;">
                    </div>
                    <div class="col-7">
                      <div class="row">
                      <div class="col-4">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <h4 class="fw-bold">Kode Pengguna</h4>
                          </label>
                        </div>
                        <div class="col-8">
                          <h4 class="fw-bold">: {{$user->profile->id_transaksi ?? ''}}</h4>
                        </div>
                        <div class="col-4">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <h4 class="fw-bold">Nama Lengkap</h4>
                          </label>
                        </div>
                        <div class="col-8">
                          <h4 class="fw-bold">: {{$user->name}}</h4>
                        </div>
                        <div class="col-4">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <h4 class="fw-bold">NIK</h4>
                          </label>
                        </div>
                        <div class="col-8">
                          <h4 class="fw-bold">: {{$user->profile->nik}}</h4>
                        </div>
                        <div class="col-4">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <h4 class="fw-bold">Tempat Lahir</h4>
                          </label>
                        </div>
                        <div class="col-8">
                          <h4 class="fw-bold">: {{$user->profile->tempat_lahir}}</h4>
                        </div>
                        <div class="col-4">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <h4 class="fw-bold">Tanggal Lahir</h4>
                          </label>
                        </div>
                        <div class="col-8">
                          <h4 class="fw-bold">: {{ \Carbon\Carbon::parse($user->profile->tanggal_lahir)->formatLocalized('%d %B %Y') }}</h4>
                        </div>
                        <div class="col-4">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <h4 class="fw-bold">Jenis Kelamin</h4>
                          </label>
                        </div>
                        <div class="col-8">
                          <h4 class="fw-bold">: {{ $user->profile->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</h4>
                        </div>
                        <div class="col-4">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <h4 class="fw-bold">No Telepon</h4>
                          </label>
                        </div>
                        <div class="col-8">
                          <h4 class="fw-bold">: {{$user->profile->no_telepon}}</h4>
                        </div>
                        <div class="col-4">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <h4 class="fw-bold">Alamat</h4>
                          </label>
                        </div>
                        <div class="col-8">
                          <h4 class="fw-bold">: {{ $user->profile->alamat ?? ' ' }}
                            RT {{ $user->profile->rt->name ?? '' }}
                            / RW {{ $user->profile->rw->name ?? '' }}</h4>
                        </div>
                        <div class="col-4">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <h4 class="fw-bold">Email</h4>
                          </label>
                        </div>
                        <div class="col-8">
                          <h4 class="fw-bold">: {{$user->email}}</h4>
                        </div>
                        <div class="col-4">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <h4 class="fw-bold">Terakhir Diupdate</h4>
                          </label>
                        </div>
                        <div class="col-8">
                          <h4 class="fw-bold">: {{ \Carbon\Carbon::parse($user->profile->updated_at)->formatLocalized('%d %B %Y') }}</h4>
                        </div>
                      </div>
                    </div>
                  </div>
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