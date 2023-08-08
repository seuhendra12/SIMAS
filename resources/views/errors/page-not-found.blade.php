<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>404 Not Found</title>

  <!-- CSS (load bootstrap from a CDN) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    html,

    body {
      height: 100%;
      background-image: url("{!! asset('img/background/notfound.png') !!}");
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }

    @media (max-width: 480px) {
      html,

      body {
        height: 100%;
        background-image: url("{!! asset('img/images/notfoundmobile.png') !!}")!important;
        /* Gambar latar belakang untuk layar HP */
      }
    }
  </style>
</head>

<body>

</body>

</html>