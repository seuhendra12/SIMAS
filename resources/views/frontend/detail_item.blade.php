<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detail Transaksi Sampah</title>

  <!-- Styling tampilan dengan bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

  <!-- ICON LOCALHOST -->
  <link rel="icon" type="image/x-icon" href="{{ asset('img/logo/logo_sim_min.png') }}">

  <!-- Styling buatan sendiri -->
  <link href="{!! asset('/css/style.css') !!}" rel="stylesheet" type="text/css" />
  <link href="{!! asset('/css/responsive.bundle.css') !!}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    body {
      background-color: #e3f8ff;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-md bg-green">
    <div class="container-fluid">
      <div class="ms-3">
        <img src="{!! asset('/img/logo/logo_sim.png') !!}" alt="user" class="logo" />
      </div>
      <!-- Button responsive -->
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse offcanvas offcanvas-end bg-dark" data-bs-scroll="true" id="offcanvasWithBothOptions" tabindex="-1" id="navbarNav">
        <div class="offcanvas-header w-100 align-items-center">
          <h2 class="mb-0 text-white fw-bold">SIMAS</h2>
          <button type="button" class="btn-close text-reset bg-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <ul class="navbar-nav ms-auto mx-3">
          <div class="nav-link d-inline">
           <a href="{{url('petugas')}}" class="btn btn-danger btn-sm rounded-0 fw-semibold">Kembali</a>
          </div>
        </ul>
      </div>
    </div>
  </nav>
  <section class="px-5 bg-aliceblue py-2">
    <div class="row">
      <div class="col-12">
        <div class="card w-100 mx-auto bg-light">
          <div class="card-header text-center bg-green rounded-0">
            <span class="fw-bold text-white">Detail Transaksi</span>
          </div>
          <div class="card-body px-3">
            <div class="table-container">
              <table class="table table-bordered table-striped">
                <thead class="fw-bold text-center bg-white">
                  <tr>
                    <td class="align-middle">No</td>
                    <td class="align-middle">Tanggal</td>
                    <td class="align-middle">Jenis Sampah</td>
                    <td class="align-middle">Berat</td>
                    <td class="col-3 align-middle">Aksi</td>
                  </tr>
                </thead>
                <tbody class="text-center">
                  @forelse ($itemTransaksis as $item)
                  <tr>
                    <td class="align-top">{{$loop->iteration}}</td>
                    <td class="align-top">{{$item->updated_at->format('d/m/Y') ?? '-'}}</td>
                    <td class="align-top">{{$item->jenisSampah->name ?? '-'}}</td>
                    <td class="align-top">{{$item->berat ?? '0'}} Kg</td>
                    <td class="align-top">
                      <a href="#" class="btn btn-secondary btn-sm button-action rounded-0">
                        Detail
                      </a>
                      <a href="#" class="btn btn-primary btn-sm px-3 button-action rounded-0">
                        Pilih
                      </a>
                    </td>
                  </tr>
                  @empty
                  <td colspan="6" class="text-center bg-danger">-- Data Tidak Ada --</td>
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
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>