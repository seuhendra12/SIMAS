<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Notifikasi')</title>
  <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
  <link href="{!! asset('/css/plugins.bundle.css') !!}" rel="stylesheet" type="text/css" />
  <link href="{!! asset('/css/style.bundle.css') !!}" rel="stylesheet" type="text/css" />
  <link href="{!! asset('/css/loading.css') !!}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

  <!-- ICON LOCALHOST -->
  <link rel="icon" type="image/x-icon" href="{{ asset('img/logo/logo_sim_min.png') }}">

  <!-- ICON FONT AWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">

  </style>
  <link href="{!! asset('/css/responsive_dashboard.bundle.css') !!}" rel="stylesheet" type="text/css" />
</head>

<body>

  <!-- HEADER & NAVBAR -->
  <div id="kt_app_header" class="app-header">
    <div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
      <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
        <a href="/" class="d-lg-none">
          <img alt="Logo" src="{!! asset('/img/logo/logo_sim_min.png') !!}" class="h-30px" />
        </a>
      </div>
      <div class="app-navbar flex-shrink-0">
        <div class="app-navbar-item ms-1 ms-md-3" id="kt_header_user_menu_toggle">
          <div class="me-5">
            <a href="{{url('notif')}}" class="notification-icon">
              <svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z" />
              </svg>
            </a>
          </div>
          <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
            <img src="{!! asset('/img/icon/icon_user.jpg') !!}" alt="user" />
            <span class="fw-bold me-3">{{Auth::user()->name}}</span>
          </div>
          <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
            <div class="menu-item px-3">
              <div class="menu-content d-flex align-items-center px-3">
                <div class="symbol symbol-50px me-5">
                  <img alt="Logo" src="{!! asset('/img/icon/icon_user.jpg') !!}" />
                  {{Auth::user()->name}}
                </div>
                <div class="d-flex flex-column">
                  <div class="fw-bold d-flex align-items-center fs-5">
                  </div>
                  <a href="#" class="fw-semibold text-muted text-hover-primary fs-7"></a>
                </div>
              </div>
            </div>
            <div class="separator my-2"></div>
            <div class="menu-item px-5">
              <a href="#" class="menu-link px-5" data-bs-toggle="modal" data-bs-target="#profil"><i class="fas fa-eye me-2"></i>Profilku</a>
            </div>
            <div class="menu-item px-5">
              <a href="{{url('/')}}" class="menu-link px-5"><i class="fas fa-home me-2"></i>Kunjungi Halaman Depan</a>
            </div>
            <div class="menu-item px-5">
              <form action="/logout" method="POST">
                @csrf
                <button class="btn border-0 menu-link px-5" type="submit" onclick="return confirm('Apakah yakin ingin keluar ?')"><i class="fas fa-power-off me-2"></i>Keluar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <div class="modal fade" id="profil" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-600px">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h2>Profil Pengguna</h2>
          <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
            <span class="svg-icon svg-icon-1">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
              </svg>
            </span>
          </div>
        </div>
        <div class="modal-body py-lg-10 px-lg-10">
          <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid" id="profil">
            <div class="d-flex justify-content-center justify-content-xl-start flex-row-auto w-100 w-xl-300px">
              <div class="stepper-nav ps-lg-10">
                <div class="stepper-item current" data-kt-stepper-element="nav">
                  <div class="stepper-wrapper">
                    <div class="stepper-label">
                      <h3 class="stepper-title">NIK</h3>
                      <div class="stepper-desc">{{Auth::user()->nik}}</div>
                    </div>
                  </div>
                  <div class="stepper-wrapper mt-5">
                    <div class="stepper-label">
                      <h3 class="stepper-title">Nama Lengkap</h3>
                      <div class="stepper-desc">{{Auth::user()->name}}</div>
                    </div>
                  </div>
                  <div class="stepper-wrapper mt-5">
                    <div class="stepper-label">
                      <h3 class="stepper-title">Role</h3>
                      <div class="stepper-desc">{{Auth::user()->role}}</div>
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
  <div class="container mt-5">
    <div class="card card-flush h-md-100">
      <div class="card-body d-flex flex-column justify-content-between bgi-no-repeat bgi-size-cover bgi-position-x-center pb-0">
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
        <div class="mb-4">
          <a href="{{url('data-pengguna')}}" class="btn btn-sm btn-danger rounded-0">Kembali</a>
        </div>
        <div class="table-container">
          <table class="table table-bordered table-striped text-center">
            <thead class="fw-bold bg-dark text-white">
              <tr>
                <th>No</th>
                <th class="col-2">NIK</th>
                <th class="col-2">Nama Lengkap</th>
                <th>KTP</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse($datas as $user)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$user->nik}}</td>
                <td>{{$user->name}}</td>
                <td>
                  <a href="{{ asset('img/foto_ktp/' . $user->profile->foto_ktp) }}" data-lightbox="foto-ktp" data-title="Foto KTP">
                    <img src="{{ asset('img/foto_ktp/' . $user->profile->foto_ktp) }}" style="width: 30%;" alt="KTP">
                  </a>
                </td>
                <td class="text-center">
                  <form action="notif/{{$user->id}}" method="POST">
                    @method('PATCH')
                    @csrf
                    <label class="form-check form-switch form-check-custom form-check-solid text-center">
                      <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $user['is_active'] == 1 ? 'checked' : '' }} onchange="this.form.submit()">
                    </label>
                  </form>
                </td>
              </tr>
              @empty
              <td colspan="7" class="text-center bg-danger">-- Data Tidak Ada --</td>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="mb-5">
          {{$datas->appends(['perPage' => $perPage])->links('pagination::bootstrap-5')}}
        </div>
      </div>
    </div>
  </div>


  @include('layouts.footer')
  <script src="{!! asset('/js/plugins.bundle.js') !!}"></script>
  <script src="{!! asset('/js/scripts.bundle.js') !!}"></script>
  <script src="{!! asset('/js/widgets.bundle.js') !!}"></script>
  <script src="{!! asset('/js/loading.js') !!}"></script>
  <script src="{!! asset('/js/custom_widgets.js') !!}"></script>
  <script src="{!! asset('/js/checkbox.js') !!}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
  <script>
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    });
  </script>

</body>

</html>