<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIMAS KOTO LUAR</title>

  <!-- Styling tampilan dengan bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

  <!-- Styling untuk owl carousel -->
  <link rel="stylesheet" href="{!! asset('/owlcarousel/dist/assets/owl.carousel.min.css ') !!}">
  <link rel="stylesheet" href="{!! asset('/owlcarousel/dist/assets/owl.theme.default.min.css ') !!}">

  <!-- Styling buatan sendiri -->
  <link href="{!! asset('/css/style.css') !!}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  @include('frontend.navbar')
  @include('frontend.header')
  @include('frontend.main')
  @include('frontend.regulasi_peraturan')
  @include('frontend.statistik')
  @include('frontend.berita')
  @include('frontend.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

  <!-- Script buat owl carousel -->
  <script src=" {!! asset('/owlcarousel/docs/assets/vendors/jquery.min.js') !!}"></script>
  <script src=" {!! asset('/owlcarousel/dist/owl.carousel.min.js') !!}"></script>
  <script>
    $(document).ready(function() {
      $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 30,
        center: true,
        nav: true,
        navText: ["<img class='mt-5 me-3' src={!! asset('/img/icon/left.svg') !!}>", "<img class='mt-5' src={!! asset('/img/icon/right.svg') !!}>"],
        autoplay: true, // Menambahkan opsi autoplay
        autoplayTimeout: 3000, // Menentukan waktu perpindahan slide (dalam milidetik)
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 2
          },
          900: {
            items: 3
          },
          1200: {
            items: 4
          }
        }
      });
    });
  </script>
</body>