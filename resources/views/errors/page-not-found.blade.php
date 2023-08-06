<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>404 Not Found</title>

  <!-- CSS (load bootstrap from a CDN) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <div class="container">
    <div class="row d-flex flex-column flex-lg-row">
      <div class="col-6 text-center">
        <div class="text-center mt-5 mx-auto">
          <img src="{!!asset('img/images/robot.png')!!}" width="100%">
        </div>
      </div>
      <div class="col-6 mt-4">
        <h1 class="text-center mt-5" style="font-size:300px;color: blue;">404</h1>
        <h5 class="text-center">...Oops! Something is missing</h5>
        <div class="text-center mt-5">
          <a href="{{url('/')}}" class="btn btn-success">Home</a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>