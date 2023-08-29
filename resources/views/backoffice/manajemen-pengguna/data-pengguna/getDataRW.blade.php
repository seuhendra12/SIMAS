@extends('layouts.index')
@section('title','Data Ketua RW')
@section('container')

<!-- MAIN CONTENT -->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
  <div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
      <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
          <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Ketua RW</h1>
          <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7">
            <li class="breadcrumb-item text-muted">
              <a href="{{url('getDataPengguna')}}" class="text-muted text-hover-primary">Home</a>
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
                      <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Ketua RW</h1>
                      <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                          <p class="text-muted text-hover-primary">Data Ketua RW Pada Sistem Informasi Manajemen Sampah (SIMAS) Kelurahan Koto Luar</p>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="d-grid d-md-flex justify-content-md-end">
                      <a href="data-pengguna/create" class="btn btn-sm fw-bold btn-primary rounded-0 fw-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icons" width="16" height="16" fill="currentColor" class="bi bi-circle-square" viewBox="0 0 16 16">
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
                      <div class="modal-content text-center w-50 mx-auto rounded-0 fw-bold">
                        <div class="modal-body text-center">
                          <div class="mb-5">
                            <img alt="Logo" src="{!! asset('/img/icon/success.png') !!}" class="h-60px h-lg-75px" />
                            <H5 class="mt-1 fw-bold">SUKSES</H5>
                          </div class="mb-2">
                          {{ Session::get('success') }}
                          <div>
                            <button type="button" class="btn btn-primary mt-2 rounded-0 fw-bold" data-bs-dismiss="modal" aria-label="Close">
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
                      <div class="col-7">
                        <form>
                          <div class="d-flex d-inline">
                            <span class="fw-bold mt-4 ms-2">Tampilkan</span>
                            <div class="col-2 index">
                              <input type="number" name="perPage" class="form-control mx-3" value="{{$perPage}}" onchange="this.form.submit()">
                            </div>
                            <span class="fw-bold mt-4 ms-8">entri</span>
                          </div>
                        </form>
                      </div>
                      <div class="col-5 d-grid d-md-flex justify-content-md-end mb-3">
                        <form class="form" action="/getDataRW">
                          <div class="input-group input-group-sm">
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
                      <table class="table table-bordered table-striped text-center">
                        <thead class="fw-bold">
                          <tr>
                            <th>No</th>
                            <th>Kode Aplikasi</th>
                            <th>NIK</th>
                            <th>Nama Lengkap</th>
                            <th>Terakhir Login</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($datas as $user)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$user->profile->kode_simas ?? '-'}}</td>
                            <td>{{$user->nik}}</td>
                            <td>{{$user->name}}</td>
                            <td>
                              @if ($user->loginHistory->first())
                              {{\Carbon\Carbon::parse($user->loginHistory->first()->login_time)->format('d/m/Y | H:i')}} WIB
                              @else
                              -
                              @endif
                            </td>
                            <td>
                              <a href="data-pengguna/{{$user->id}}" class="btn btn-purple btn-sm button-action rounded-0 fw-bold" title="Detail" data-bs-toggle="tooltip">
                                <span>
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye icon-large" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                  </svg>
                                </span>
                              </a>
                              <a href="data-pengguna/{{$user->id}}/edit" class="btn btn-yellow btn-sm button-action rounded-0 fw-bold" title="Edit" data-bs-toggle="tooltip">
                                <span>
                                  <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                  </svg>
                                </span>
                              </a>
                              @if(Auth::user()->role === 'SuperAdmin')
                              <a href="#" class="btn btn-red btn-sm rounded-0 fw-bold" data-bs-toggle="modal" data-bs-target="#confirm-delete-modal" data-user-id="{{ $user->id }}">
                                <span>
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                  </svg>
                                </span>
                              </a>
                              @endif
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
                  {{$datas->appends(['perPage' => $perPage])->links('pagination::bootstrap-5')}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- MODAL HAPUS BARU -->

  <div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content rounded-0 fw-bold">
        <div class="modal-header">
          <h5 class="modal-title" id="confirm-delete-modal-label">Hapus Pengguna </h5>
          <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
            <span class="svg-icon svg-icon-1">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
              </svg>
            </span>
          </div>
        </div>
        <div class="modal-body">Apakah kamu yakin ingin menghapus pengguna ini ?</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary rounded-0 fw-bold" data-bs-dismiss="modal">Batal</button>
          <form action="{{ url('data-pengguna', '__user_id') }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger rounded-0 fw-bold">Hapus</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#confirm-delete-modal").on("show.bs.modal", function(e) {
        var userId = $(e.relatedTarget).data("user-id");
        console.log(userId);
        $(this)
          .find("form")
          .attr("action", function(index, value) {
            return value.replace("__user_id", userId);
          });
      });
    });
  </script>


</div>
@endsection