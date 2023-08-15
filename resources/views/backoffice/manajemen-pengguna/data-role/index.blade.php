@extends('layouts.index')
@section('title','Data Role')
@section('container')

<!-- MAIN CONTENT -->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
  <div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
      <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
          <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Role</h1>
          <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7">
            <li class="breadcrumb-item text-muted">
              <a href="{{url('data-role')}}" class="text-muted text-hover-primary">Home</a>
            </li>
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
                      <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Role</h1>
                      <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                          <p class="text-muted text-hover-primary">Data Role Pada Sistem Informasi Manajemen Sampah (SIMAS) Kelurahan Koto Luar</p>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="mt-3">
                    <table class="table table-bordered table-striped">
                      <thead class="fw-bold text-center">
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Nama Role</th>
                        </tr>
                      </thead>
                      <tbody class="text-center">
                        <tr>
                          <td>1</td>
                          <td>Superadmin</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Admin</td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Kelurahan</td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>RW</td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>RT</td>
                        </tr>
                        <tr>
                          <td>6</td>
                          <td>User</td>
                        </tr>
                      </tbody>
                    </table>
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