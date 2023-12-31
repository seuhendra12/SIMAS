@extends('layouts.index')
@section('title','Transaksi Sampah')
@section('container')

<!-- MAIN CONTENT -->
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
                  <div class="col-8">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                      <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Transaksi</h1>
                      <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                          <p class="text-muted text-hover-primary">Data Transaksi Pada Sistem Informasi Manajemen Sampah (SIMAS) Kelurahan Koto Luar</p>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="d-grid d-md-flex justify-content-md-end">
                      <a href="transaksi-sampah/create" class="btn btn-sm fw-bold btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-square icons" viewBox="0 0 16 16">
                          <path d="M0 6a6 6 0 1 1 12 0A6 6 0 0 1 0 6z" />
                          <path d="M12.93 5h1.57a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-1.57a6.953 6.953 0 0 1-1-.22v1.79A1.5 1.5 0 0 0 5.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 4h-1.79c.097.324.17.658.22 1z" />
                        </svg>
                      Data Baru</a>
                    </div>
                  </div>
                </div>
                <div>
                  @if(Session::has('success'))
                  <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content text-center w-50 mx-auto">
                        <div class="modal-body text-center">
                          <div class="mb-5">
                            <img alt="Logo" src="{!! asset('/img/icon/success.png') !!}" class="h-60px h-lg-75px" />
                            <H5 class="mt-1 fw-bold">SUKSES</H5>
                          </div class="mb-2">
                          {{ Session::get('success') }}
                          <div>
                            <button type="button" class="btn btn-primary mt-2" data-bs-dismiss="modal" aria-label="Close">
                              OK
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <script>
                    document.addEventListener('DOMContentLoaded', function() {
                      var myModal = new bootstrap.Modal(document.getElementById('successModal'));
                      myModal.show();
                    });
                  </script>
                  @endif
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
                        <form class="form" action="/transaksi-sampah">
                          <div class="d-flex d-inline">
                            <div class="input-group input-group-sm" style="width: 150px;">
                              <input type="text" name="search" class="form-control float-right rounded-0" id="search" placeholder="Search" value="{{ request('search') }}">
                              <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary rounded-0">
                                  <i class="fas fa-search"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="table-container">
                      <table class="table table-bordered table-striped text-center">
                        <thead class="fw-bold">
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Transaksi</th>
                            <th scope="col">Nama Nasabah</th>
                            <th scope="col">Terakhir Transaksi</th>
                            <th scope="col">Total Berat</th>
                            <th scope="col">Total Point</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($transaksiSampahs as $transaksiSampah)
                          <tr>
                            <td class="align-top">{{$loop->iteration}}</td>
                            <td class="align-middle">{{$transaksiSampah->kode_transaksi}}</td>
                            <td class="align-middle">{{$transaksiSampah->user->name}}</td>
                            <td class="align-middle">
                              {{ $transaksiSampah->tanggal_transaksi->format('d/m/Y') }}
                            </td>
                            <td class="align-middle">
                              {{ $transaksiSampah->total_berat !== null ? $transaksiSampah->total_berat : 0 }} Kg
                            </td>
                            <td class="align-middle">
                              {{ $transaksiSampah->total_point !== null ? $transaksiSampah->total_point : 0 }} Point
                            </td>
                            <td>
                              <a href="transaksi-sampah/{{$transaksiSampah->id}}" class="btn btn-purple btn-sm button-action" title="Detail" data-bs-toggle="tooltip">
                                <span>
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye icon-large icons" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 shh0 0 1-7 0z" />
                                  </svg>
                                </span>
                              </a>
                              <a href="item-transaksi/{{$transaksiSampah->id}}/create" class="btn btn-info btn-sm button-action" title="Transaksi" data-bs-toggle="tooltip">
                                <span>
                                  <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-shop icons" viewBox="0 0 16 16">
                                    <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z" />
                                  </svg>
                                </span>
                              </a>
                              <a href="histori-transaksi/{{$transaksiSampah->id}}" class="btn btn-warning btn-sm text-dark" title="Histori" data-bs-toggle="tooltip">
                                <span>
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history icons" viewBox="0 0 16 16">
                                    <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                                    <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                                    <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                                  </svg>
                                </span>
                              </a>
                            </td>
                          </tr>
                          @empty
                          <td colspan="7" class="text-center bg-danger">-- Data Tidak Ada --</td>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="mb-5">
                  {{$transaksiSampahs->appends(['perPage' => $perPage])->links('pagination::bootstrap-5')}}
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