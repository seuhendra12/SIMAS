<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Halaman Dashboard Admin')</title>
  <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
  <link href="{!! asset('/css/plugins.bundle.css') !!}" rel="stylesheet" type="text/css" />
  <link href="{!! asset('/css/style.bundle.css') !!}" rel="stylesheet" type="text/css" />
  <link href="{!! asset('/css/loading.css') !!}" rel="stylesheet" type="text/css" />
  <link href="{!! asset('/css/background-login.css') !!}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->
  <style>
    .table-striped tbody tr:nth-of-type(odd) {
      background-color: #A1A5B7
    }
  </style>
</head>

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
  <script>
    var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
      if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
        themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
      } else {
        if (localStorage.getItem("data-bs-theme") !== null) {
          themeMode = localStorage.getItem("data-bs-theme");
        } else {
          themeMode = defaultThemeMode;
        }
      }
      if (themeMode === "system") {
        themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
      }
      document.documentElement.setAttribute("data-bs-theme", themeMode);
    }
  </script>

  <body>
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
      <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        @include('layouts.header')
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
          @include('layouts.sidebar')
          <div class="content-wrapper">
            @yield('container')
            @if(session()->has('messageLogin'))
            <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered  w-25">
                <div class="modal-content text-center">
                  <div class="modal-body">
                    <div class="mb-5">
                      <img alt="Logo" src="{!! asset('/img/icon/wrong.png') !!}" class="h-60px h-lg-75px" />
                      <H5 class="mt-1 fw-bold">ERROR</H5>
                    </div class="mb-2">
                    {{ session('messageLogin') }}
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
                var myModal = new bootstrap.Modal(document.getElementById('errorModal'));
                myModal.show();
              });
            </script>
            @endif
          </div>
          @include('layouts.footer')
        </div>
      </div>
    </div>

    <script src="{!! asset('/js/plugins.bundle.js') !!}"></script>
    <script src="{!! asset('/js/scripts.bundle.js') !!}"></script>
    <script src="{!! asset('/js/widgets.bundle.js') !!}"></script>
    <script src="{!! asset('/js/loading.js') !!}"></script>
    <script src="{!! asset('/js/custom_widgets.js') !!}"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> -->
    <!-- <script src="{!! asset('/js/chat.js') !!}"></script> -->
    <script src="{!! asset('/js/checkbox.js') !!}"></script>
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script> -->
    <!-- <script src="{!! asset('/js/ckeditor.js') !!}"></script> -->
  </body>


</html>