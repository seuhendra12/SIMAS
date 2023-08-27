<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIMAS KOTO LUAR</title>
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
  <section class="container bg-aliceblue py-5">
    <div class="card w-75 mx-auto bg-light">
      <div class="card-header text-center bg-green rounded-0">
        <span class="fw-bold text-white">Histori Transaksi</span>
      </div>
      <div class="card-body bg-light px-3">
        <div class="row justify-content-end">
          <div class="col-5">
            <form action="{{ url('histori-transaksi') }}" method="get">
              <div class="input-group mb-3">
                <select name="month" id="month" class="form-control rounded-0">
                  <option value="">Pilih Bulan</option>
                  <option value="1" {{ $selectedMonth == 1 ? 'selected' : '' }}>Januari</option>
                  <option value="2" {{ $selectedMonth == 2 ? 'selected' : '' }}>Februari</option>
                  <option value="3" {{ $selectedMonth == 3 ? 'selected' : '' }}>Maret</option>
                  <option value="4" {{ $selectedMonth == 4 ? 'selected' : '' }}>April</option>
                  <option value="5" {{ $selectedMonth == 5 ? 'selected' : '' }}>Mei</option>
                  <option value="6" {{ $selectedMonth == 6 ? 'selected' : '' }}>Juni</option>
                  <option value="7" {{ $selectedMonth == 7 ? 'selected' : '' }}>Juli</option>
                  <option value="8" {{ $selectedMonth == 8 ? 'selected' : '' }}>Agustus</option>
                  <option value="9" {{ $selectedMonth == 9 ? 'selected' : '' }}>September</option>
                  <option value="10" {{ $selectedMonth == 10 ? 'selected' : '' }}>Oktober</option>
                  <option value="11" {{ $selectedMonth == 11 ? 'selected' : '' }}>November</option>
                  <option value="12" {{ $selectedMonth == 12 ? 'selected' : '' }}>Desember</option>
                  <!-- Tambahkan opsi bulan lainnya di sini -->
                </select>
                <input type="number" name="year" id="year" class="form-control rounded-0" placeholder="Tahun" value="{{ $selectedYear }}">
                <button class="btn btn-outline-secondary rounded-0" type="submit">Filter</button>
              </div>
            </form>
          </div>
        </div>
        <div class="table-container">
          <table class="table table-bordered table-striped text-center">
            <thead class="fw-bold">
              <tr>
                <td>No</td>
                <td>Jenis Sampah</td>
                <td>Tanggal Transaksi</td>
                <td>Berat Sampah</td>
              </tr>
            </thead>
            <tbody>
              @forelse ($historiTransaksis as $historiTransaksi)
              <tr>
                <td class="align-top">{{$loop->iteration}}</td>
                <td class="align-top">{{$historiTransaksi->jenisSampah->name}}</td>
                <td class="align-top">{{$historiTransaksi->updated_at->format('d/m/Y')}}</td>
                <td class="align-top">{{$historiTransaksi->berat}} Kg</td>
              </tr>
              @empty
              <td colspan="4" class="text-center bg-danger">-- Data Tidak Ada --</td>
              @endforelse
            </tbody>
          </table>
          <a href="{{url('/')}}" class="btn btn-danger rounded-0">Kembali</a>
        </div>
      </div>
      <div class="mb-5">
        {{$historiTransaksis->appends(['perPage' => $perPage])->links('pagination::bootstrap-5')}}
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>