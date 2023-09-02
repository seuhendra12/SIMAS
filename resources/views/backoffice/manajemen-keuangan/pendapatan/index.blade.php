@extends('layouts.index')
@section('title','Data Pendapatan')
@section('container')

<!-- MAIN CONTENT -->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
  <div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
      <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
          <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Pendapatan</h1>
          <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7">
            <li class="breadcrumb-item text-muted">
              <a href="{{url('pendapatan')}}" class="text-muted text-hover-primary">Home</a>
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
                      <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Pendapatan</h1>
                      <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                          <p class="text-muted text-hover-primary">Data Pendapatan Pada Sistem Informasi Manajemen Sampah (SIMAS) Kelurahan Koto Luar</p>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="mt-3">
                    <div class="row">
                      <div class="col-6 my-auto">
                        <form>
                          <div class="d-flex d-inline">
                            <span class="fw-bold mt-4">Tampilkan</span>
                            <div class="col-2 px-3">
                              <input type="number" name="perPage" class="form-control mx-3 rounded-0" value="{{$perPage}}" onchange="this.form.submit()">
                            </div>
                            <span class="fw-bold mt-4 ms-6">entri</span>
                          </div>
                        </form>
                      </div>
                      <div class="col-6 d-grid d-md-flex justify-content-md-end mb-3">
                        <form method="get" action="{{ url('pendapatan') }}">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="startDate">Tanggal Mulai:</label>
                                <input type="date" name="startDate" id="startDate" class="form-control" value="{{ $startDate }}">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="endDate">Tanggal Berakhir:</label>
                                <input type="date" name="endDate" id="endDate" class="form-control" value="{{ $endDate }}">
                              </div>
                            </div>
                            <div class="col-md-4 mt-5">
                              <div class="form-group d-flex">
                                <button type="submit" class="btn btn-primary btn-sm me-2 rounded-0 fw-bold">Filter</button>
                                <a href="{{ url('pendapatan') }}" class="btn btn-secondary rounded-0 fw-bold">Reset</a>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <table class="table table-bordered table-striped">
                      <thead class="fw-bold text-center">
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Tanggal</th>
                          <th scope="col">Jenis Sampah</th>
                          <th scope="col">Total Pendapatan</th>
                        </tr>
                      </thead>
                      <tbody class="text-center">
                        @forelse ($pendapatans as $pendapatan)
                        <tr>
                          <td class="align-middle">{{$loop->iteration}}</td>
                          <td class="align-middle">{{$pendapatan->tanggal->format('d/m/Y')}}</td>
                          <td class="align-middle">{{$pendapatan->jenis_sampah->name}}</td>
                          <td class="align-middle">Rp {{number_format($pendapatan->total_pendapatan,0,'.','.')}},-</td>
                        </tr>
                        @empty
                        <td colspan="4" class="text-center bg-danger">-- Data Tidak Ada --</td>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="mb-5">
                  {{$pendapatans->appends(['perPage' => $perPage])->links('pagination::bootstrap-5')}}
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