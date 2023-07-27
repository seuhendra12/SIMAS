<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Halaman Dashboard Admin')</title>
  <link rel="icon" href="!! asset('/img/logo/logo_sim_min.png') !!}" type="image/png">
  <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
  <link href="{!! asset('/css/plugins.bundle.css') !!}" rel="stylesheet" type="text/css" />
  <link href="{!! asset('/css/style.bundle.css') !!}" rel="stylesheet" type="text/css" />
  <link href="{!! asset('/css/responsive.bundle.css') !!}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- ICON LOCALHOST -->
  <link rel="icon" type="image/x-icon" href="{{ asset('img/logo/logo_sim_min.png') }}">

  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->
  <style>
    .table-striped tbody tr:nth-of-type(odd) {
      background-color: #A1A5B7
    }

    body {
      background-image: url("{!! asset('img/background/background-login.png') !!}");
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }

    @media (max-width: 480px) {
      body {
        background-image: url("{!! asset('img/background/login-mobile.png') !!}");
        /* Gambar latar belakang untuk layar HP */
      }
    }
  </style>
</head>

<body>
  @yield('container')

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