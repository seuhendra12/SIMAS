@extends('layouts.index')
@section('title','Item Transaksi Sampah')
@section('container')

<!-- MAIN CONTENT -->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
  <div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
      <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
          <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Item Transaksi</h1>
          <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7">
            <li class="breadcrumb-item text-muted">
              <a href="{{url('transaksi-sampah')}}" class="text-muted text-hover-primary">Home</a>
            </li>
            <li class="breadcrumb-item">
              <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted">Data Item Transaksi Sampah</li>
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
                      <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Item Transaksi</h1>
                      <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                          <p class="text-muted text-hover-primary">Data Item Transaksi Pada Sistem Informasi Manajemen Sampah (SIMAS) Kelurahan Koto Luar</p>
                        </li>
                      </ul>
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
                    <div class="row mb-4">
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
                    </div>
                    <table class="table table-bordered table-striped">
                      <thead class="fw-bold">
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Jenis Sampah</th>
                          <th scope="col">Berat Sampah</th>
                          <th scope="col">Jumlah Poin</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($itemTransaksis as $itemTransaksi)
                        <tr>
                          <td class="align-top">{{$loop->iteration}}</td>
                          <td class="align-top">{{$itemTransaksi->jenisSampah->name}}</td>
                          <td class="align-top">{{$itemTransaksi->jumlah_berat}} Kg</td>
                          <td class="align-top">{{$itemTransaksi->jumlah_point}} Poin</td>
                        </tr>
                        @empty
                        <td colspan="5" class="text-center bg-danger">-- Data Tidak Ada --</td>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="mb-5">
                  {{$itemTransaksis->appends(['perPage' => $perPage])->links('pagination::bootstrap-5')}}
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