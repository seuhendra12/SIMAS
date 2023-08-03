<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIMAS KOTO LUAR</title>
  <!-- Styling tampilan dengan bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">



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
  <section class="container-fluid bg-aliceblue py-5">
    <div class="row">
      <div class="col-6">
        <div class="card w-100 mx-auto">
          <div class="card-header text-center bg-green rounded-0">
            <span class="fw-bold text-white">Tukar Poin</span>
          </div>
          <div class="card-body bg-light px-3">
            @if(Session::has('success'))
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center w-50 mx-auto">
                  <div class="modal-body text-center">
                    <div class="mb-2">
                      <img alt="Logo" src="{!! asset('/img/icon/success.png') !!}" style="width: 100px; height: 130px;" />
                      <H5 class="mt-1 fw-bold">SUKSES</H5>
                    </div>
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
            @if ($errors->any())
            <div id="notification" class="alert alert-danger" style="display: none;">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            <script>
              // Tampilkan notifikasi saat halaman dimuat
              document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('notification').style.display = 'block';

                // Atur waktu penghilangan notifikasi setelah 3 detik
                setTimeout(function() {
                  document.getElementById('notification').style.display = 'none';
                }, 5000);
              });
            </script>
            @endif
            <div class=" mx-auto text-center mb-4">
              <img src="{!! asset('/img/images/tukar_poin.png') !!}" alt="Image" class="image-point" style="width: 75%">
            </div>
            <div class="row">
              @foreach ($konversiPoin as $nilai)
              <div class="col-4 point">
                <div class="card mb-3 rounded-3 bg-light" style="max-width: 540px;">
                  <div class="card-body text-center">
                    <h5 class="card-title fw-bold">{{$nilai->angka_konversi}} Kg<br>= {{$nilai->nilai_konversi}} Poin</h5>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
            <form action="/simpan-tukar-poin/{{ Auth::user()->id }}" method="POST">
              @csrf
              <div class="table-container">
                <div class="d-flex flex-column mb-3 fv-row">
                  <label for="tukarPoin" class="fs-6 fw-semibold mb-2 required">Pilih Tukar Poin</label>
                  <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jenis Sampah" name="konversiPoin" id="tukarPoin">
                    @foreach ($konversiPoin as $konversiPoin)
                    @if (old('konvers$konversiPoin_id')==$konversiPoin->id)
                    <option value="{{$konversiPoin->id}}" selected>{{$konversiPoin->nilai_konversi}}</option>
                    @else
                    <option value="{{$konversiPoin->id}}">{{$konversiPoin->nilai_konversi}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="mx-auto text-center">
                <a href="{{url('/')}}" class="btn btn-danger rounded-0">Kembali</a>
                <button class="btn btn-success rounded-0" name="submit" type="submit">Tukar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="card w-100 mx-auto">
          <div class="card-header text-center bg-green rounded-0">
            <span class="fw-bold text-white">Histori Tukar Poin</span>
          </div>
          <div class="card-body bg-light px-3">
            <div class="table-container">
              <table class="table table-bordered table-striped">
                <thead class="fw-bold">
                  <tr>
                    <td>No</td>
                    <td>Total Konversi</td>
                    <td>Tanggal Pengajuan</td>
                    <td>Status</td>
                    <td>Aksi</td>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($tukarPoins as $tukarPoin)
                  <tr>
                    <td class="align-top">{{$loop->iteration}}</td>
                    <td class="align-top">{{$tukarPoin->total_konversi}} Poin</td>
                    <td class="align-top">{{$tukarPoin->tanggal_transaksi->format('d M Y')}}</td>
                    <td class="align-top">
                      @if ($tukarPoin->status == 'tunda')
                      <h5 class="badge text-bg-danger">Tunda</h5>
                      @elseif ($tukarPoin->status == 'proses')
                      <h5 class="badge text-bg-primary">Proses</h5>
                      @elseif ($tukarPoin->status == 'selesai')
                      <h5 class="badge text-bg-success">Selesai</h5>
                      @endif
                    </td>
                    <td class="align-top">
                      <a href="{{ url('cetak-struk', ['id' => $tukarPoin->id]) }}" class="btn btn-success btn-sm rounded-0" target="_blank">Unduh</a>
                    </td>
                  </tr>
                  @empty
                  <td colspan="5" class="text-center bg-danger">-- Data Tidak Ada --</td>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>