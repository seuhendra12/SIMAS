@extends('layouts.index')
@section('title','Laporan Sampah Diolah Eksternal')
@section('container')

<!-- MAIN CONTENT -->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
  <div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
      <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
          <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Laporan Sampah Diolah Eksternal</h1>
          <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7">
            <li class="breadcrumb-item text-muted">
              <a href="{{url('laporan-sampah-diolah-eksternal')}}" class="text-muted text-hover-primary">Home</a>
            </li>
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
                <div class="row">
                  <div class="col-12">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                      <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Laporan Sampah Diolah Eksternal</h1>
                      <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                          <p class="text-muted text-hover-primary">Laporan Sampah Diolah Eksternal Pada Sistem Informasi Manajemen Sampah (SIMAS) Kelurahan Koto Luar</p>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="mt-3">
                    <div class="row">
                      <div class="col-6">
                        <form>
                          <div class="d-flex d-inline">
                            <span class="fw-bold mt-4">Tampilkan</span>
                            <div class="col-2 px-3">
                              <input type="number" name="perPage" class="form-control mx-3" value="{{$perPage}}" onchange="this.form.submit()">
                            </div>
                            <span class="fw-bold mt-4 ms-6">entri</span>
                          </div>
                        </form>
                      </div>
                      <div class="col-6 d-grid d-md-flex justify-content-md-end mb-3">
                        <form class="form" action="/laporan-sampah-diolah-eksternal">
                          <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="search" class="form-control float-right rounded-0" id="search" placeholder="Search" value="{{ request('search') }}">
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-secondary rounded-0">
                                <i class="fas fa-search"></i>
                              </button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="table-container">
                      <table class="table table-bordered table-striped">
                        <thead class="fw-bold">
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Jenis Sampah</th>
                            <th scope="col" class="col-1">Berat</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col" class="col-2">Keterangan</th>
                            <th scope="col">Petugas</th>
                            <th scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($sampahDiolahEksternals as $sampahDiolahEksternal)
                          <tr>
                            <td class="align-top">{{$loop->iteration}}</td>
                            <td class="align-top">{{$sampahDiolahEksternal->jenisSampah->name}}</td>
                            <td class="align-top">{{$sampahDiolahEksternal->berat}} Kg</td>
                            <td class="align-top">{{$sampahDiolahEksternal->tanggal_diolah->format('d M Y')}}</td>
                            <td class="align-top">{{$sampahDiolahEksternal->lokasi_diolah}}</td>
                            <td class="align-top">{{$sampahDiolahEksternal->keterangan}}</td>
                            <td class="align-top">{{$sampahDiolahEksternal->user->name}}</td>
                            <td class="align-top">
                              @if ($sampahDiolahEksternal->status == 'ditolak')
                              <h5 class="badge badge-light-danger">Ditolak</h5>
                              @elseif ($sampahDiolahEksternal->status == 'dalam proses')
                              <h5 class="badge badge-light-primary">Dalam proses</h5>
                              @elseif ($sampahDiolahEksternal->status == 'selesai')
                              <h5 class="badge badge-light-success">Selesai</h5>
                              @endif
                            </td>
                          </tr>
                          @empty
                          <td colspan="8" class="text-center bg-danger">-- Data Tidak Ada --</td>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="mb-5">
                  {{$sampahDiolahEksternals->appends(['perPage' => $perPage])->links('pagination::bootstrap-5')}}
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