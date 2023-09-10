<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Input Transaksi Sampah</title>

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
            <form action="/logout" method="POST">
              @csrf
              <button class="btn btn-danger btn-sm rounded-0 fw-semibold" type="submit" onclick="return confirm('Apakah yakin ingin keluar ?')"><i class="fas fa-power-off me-2"></i>Keluar</button>
            </form>
          </div>
        </ul>
      </div>
    </div>
  </nav>
  <section class="px-5 bg-aliceblue py-2">
    <div class="row">
      <div class="col-6 mb-3">
        <div class="card mx-auto">
          <div class="card-header text-center bg-green rounded-0">
            <span class="fw-bold text-white">Input Transaksi Sampah</span>
          </div>
          <div class="card-body bg-light">
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
            @if(Session::has('success'))
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered  w-25">
                <div class="modal-content text-center">
                  <div class="modal-body">
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
            <form action="{{url('petugas-proses')}}" method="POST">
              @csrf
              <div class="row container">
                <div class="col-12 pt-2">
                  <div class="mb-3 row">
                    <label for="kode_simas" class="col-sm-4 col-form-label">Kode SIMAS</label>
                    <div class="col-sm-8">
                      <input type="text" value="{{old('kode_simas')}}" class="form-control" id="kode_simas" placeholder="Masukkan kode aplikasi anda" name="kode_simas">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="user_id" class="col-sm-4 col-form-label">ID Pengguna</label>
                    <div class="col-sm-8">
                      <input type="text" name="user_id" value="{{old('user_id')}}" class="form-control bg-light" id="user_id" readonly>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="name" class="col-sm-4 col-form-label">Nama Pengguna</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control bg-light" id="name" readonly>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="tanggal_transaksi" class="col-sm-4 col-form-label">Tanggal Transaksi</label>
                    <div class="col-sm-8">
                      <input type="date" value="{{ date('Y-m-d') }}" placeholder="Tambahkan Tanggal Lahir" name="tanggal_transaksi" class="form-control" id="tanggal_transaksi">
                    </div>
                  </div>
                </div>
              </div>
              <div class="mx-auto text-center">
                <button class="btn btn-success rounded-0" name="submit" type="submit">Simpan</button>
              </div>
            </form>
            <script>
              document.getElementById('kode_simas').addEventListener('input', function() {
                var kodeSimas = this.value;

                // Lakukan permintaan AJAX ke server untuk mendapatkan data nama berdasarkan ID pengguna
                fetch(`/get-user-name?kode_simas=${kodeSimas}`)
                  .then(response => response.json())
                  .then(data => {
                    // Set data nama ke input "Nama Pengguna"
                    document.getElementById('user_id').value = data.user_id || 'ID Tidak Tersedia';
                    document.getElementById('name').value = data.name || 'Nama Pengguna Tidak Tersedia';
                  });
              });
            </script>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="card w-100 mx-auto bg-light">
          <div class="card-header text-center bg-green rounded-0">
            <span class="fw-bold text-white">Data Transaksi</span>
          </div>
          <div class="card-body px-3">
            <div class="col-12 d-grid d-md-flex justify-content-md-end mb-3">
              <form class="form" action="/petugas">
                <div class="d-flex d-inline">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="search" class="form-control float-right rounded-0" id="search" placeholder="Search" value="{{ request('search') }}">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-secondary rounded-0">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="table-container">
              <table class="table table-bordered table-striped">
                <thead class="fw-bold text-center bg-white">
                  <tr>
                    <td class="align-middle">No</td>
                    <td class="align-middle">Kode Transaksi</td>
                    <td class="align-middle">Nama</td>
                    <td class="align-middle">Total Berat</td>
                    <td class="align-middle">Total Point</td>
                    <td class="col-3 align-middle">Aksi</td>
                  </tr>
                </thead>
                <tbody class="text-center">
                  @forelse ($transaksiSampahs as $transaksi)
                  <tr>
                    <td class="align-top">{{$loop->iteration}}</td>
                    <td class="align-top">{{$transaksi->kode_transaksi ?? '-'}}</td>
                    <td class="align-top">{{$transaksi->user->name ?? '-'}}</td>
                    <td class="align-top">{{$transaksi->total_berat ?? '0'}} Kg</td>
                    <td class="align-top">{{$transaksi->total_point ?? '0'}}</td>
                    <td class="align-top">
                      <a href="{{url('detail-item')}}/{{$transaksi->id}}" class="btn btn-secondary btn-sm button-action rounded-0">
                        Detail
                      </a>
                      <a href="#" class="btn btn-primary btn-sm px-3 button-action rounded-0" title="Tambah Item" data-bs-toggle="modal" data-bs-target="#modalTambahItem" data-id_transaksi="{{$transaksi->id}}">
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
            {{$transaksiSampahs->appends(['perPage' => $perPage])->links('pagination::bootstrap-5')}}
          </div>
        </div>
      </div>

      <!-- Modal Tambah Item -->
      <div class="modal fade" id="modalTambahItem" tabindex="-1" aria-labelledby="modalTambahItemLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalTambahItemLabel">Tambah Item Transaksi</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="{{ url('tambah-item') }}">
                @csrf
                <div class="d-flex flex-column mb-3 fv-row">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">ID Transaksi</span>
                  </label>
                  <input type="text" class="form-control" value="{{old('transaksi_id')}}" name="transaksi_id" id="transaksi_id" readonly="true" />
                </div>
                <div class="d-flex flex-column mb-3 fv-row">
                  <label for="jenisSampah" class="fs-6 fw-semibold mb-2 required">Jenis Sampah</label>
                  <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jenis Sampah" name="jenis_sampah" id="jenisSampah">
                    @foreach ($jenisSampahs as $jenisSampah)
                    @if (old('jenisSampah_id')==$jenisSampah->id)
                    <option value="{{$jenisSampah->id}}" selected>{{$jenisSampah->name}}</option>
                    @else
                    <option value="{{$jenisSampah->id}}">{{$jenisSampah->name}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
                <div class="d-flex flex-column mb-8 fv-row">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">Berat Sampah</span>
                  </label>
                  <input type="text" class="form-control" placeholder="Masukkan Berat Sampah" name="berat" />
                </div>
                <button type="submit" class="btn btn-primary mt-3 rounded-0">Tambahkan Item</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const detailButtons = document.querySelectorAll('.detail-button');

      detailButtons.forEach(button => {
        button.addEventListener('click', function() {
          const idTransaksi = button.getAttribute('data-id_transaksi');
          const modalTitle = document.getElementById('modalDetailLabel');
          const modalBody = document.querySelector('#modalDetail .modal-body');

          // Mengatur judul modal
          modalTitle.textContent = 'Detail Transaksi ' + idTransaksi;

          // Mengambil dan menampilkan detail transaksi menggunakan AJAX atau sumber data lainnya
          // Contoh: fetch atau XMLHttpRequest untuk mengambil data dan mengisi modalBody
          // Anda harus mengganti bagian ini sesuai dengan cara Anda mengambil data detail transaksi
          fetch(`/petugas/${idTransaksi}`)
            .then(response => response.json())
            .then(data => {
              // Mengisi konten modal dengan data detail transaksi
              modalBody.innerHTML = `
              <p>Kode Transaksi: ${data.kode_transaksi}</p>
              <p>User: ${data.user.name}</p>
              <!-- ... detail lainnya ... -->
            `;
            });
        });
      });
    });


    $(document).ready(function() {
      $('#modalTambahItem').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var id_transaksi = button.data('id_transaksi'); // Ambil nilai data-id_transaksi

        var modal = $(this);
        modal.find('#transaksi_id').val(id_transaksi); // Isi nilai ke input transaksi_id
      });
    });
  </script>

  <script>
    function confirmLogout() {
      return confirm('Yakin ingin keluar?');
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>