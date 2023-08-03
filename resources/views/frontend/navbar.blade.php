<nav class="navbar navbar-expand-md bg-green fixed-top">
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
      <ul class="navbar-nav ms-auto mx-3 pt-2">
        <li class="nav-item py-2 me-3">
          <a class="nav-link text-white fw-bold" aria-current="page" href="/">Beranda</a>
        </li>
        <li class="nav-item py-2 me-3">
          <a class="nav-link text-white fw-bold" href="#regulasi_peraturan">Regulasi Peraturan</a>
        </li>
        <li class="nav-item py-2 me-3">
          <a class="nav-link text-white fw-bold" href="#statistik">Statistik</a>
        </li>
        <!-- <li class="nav-item py-2 me-3">
          <a class="nav-link text-white fw-bold" href="#berita">Berita</a>
        </li> -->
        <li class="nav-item py-2 me-4">
          <a class="nav-link text-white fw-bold" href="#kontak">Kontak</a>
        </li>
        @if (Auth::check())
        <!-- Button trigger modal -->
        <div class="d-flex align-items-center">
          <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#profile">
            <img src="{!! asset('/img/icon/icon_user.jpg') !!}" alt="User Image" class="rounded-circle me-2" style="width: 30px; height: 30px;">
            <span class="text-white fw-bold">{{ Auth::user()->name }}</span>
          </button>
        </div>
        @else
        <li class="nav-item">
          <div class="mb-2 text-white"></div>
          <div class="nav-link d-inline">
            <a href="/login" class="btn btn-light mb-3 rounded-0 fw-bold">Login</a>
            <a href="/registrasi" class="btn btn-success mb-3 rounded-0 fw-bold">Registrasi</a>
          </div>
        </li>
        @endif
      </ul>
    </div>
  </div>
</nav>

@if (Auth::check())
<!-- Modal -->
<div class="modal fade mt-4" id="profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <h1 class="modal-title fs-5 fw-bold text-white" id="exampleModalLabel">Profile</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-aliceblue">
        <div class="row">
          <div class="col-4 mx-auto text-center">
            <img src="{!! asset('/img/icon/icon_user.jpg') !!}" alt="User Image" class="rounded-circle me-2" style="width: 130px; height: 130px;">
          </div>
          <div class="col-8">
            <div class="modal-profile">
              <h5 class="text-dark fw-bold">{{ Auth::user()->name }}</h5>
              <p class="text-dark fw-bold">ID : {{ Auth::user()->profile->kode_simas ?? 'Belum Tersedia' }}</p>
            </div>
            <img src="{!! asset('/img/icon/koin.png') !!}" alt="User Image" class="rounded-circle me-2" style="width: 30px; height: 30px;">
            <span class="fw-bold">{{ Auth::user()->transaksi->total_point ?? '0' }} Points</span> <br>
            <img src="{!! asset('/img/icon/sampah.png') !!}" alt="User Image" class="rounded-circle me-2" style="width: 30px; height: 30px;">
            <span class="fw-bold">{{ Auth::user()->transaksi->total_berat ?? '0' }} Kg Sampah Dikumpulkan</span>
          </div>
        </div>
        @if(Auth::user()->role === 'SuperAdmin' || Auth::user()->role === 'Admin')
        <div class="mt-4 text-center">
          <a href="{{url('dashboard')}}" class="btn btn-success rounded-0"><i class="fas fa-home me-2"></i>Halaman Dashboard</a>
        </div>
        @else
         <div class="row mt-4">
          <div class="col text-center">
            <div class="btn-group">
              <a href="/profile/{{ Auth::user()->id }}" class="btn btn-success rounded-0 fw-semibold me-2"><i class="fas fa-eye me-2"></i>Detail</a>
              <a href="/tukar-poin/{{Auth::user()->id}}" class="btn btn-warning text-white rounded-0 fw-semibold me-2"><i class="fa-solid fa-coins me-2"></i>Tukar Poin</a>
              <a href="/histori-transaksi" class="btn btn-primary text-white rounded-0 fw-semibold me-2"><i class="fa-solid fa-clock-rotate-left me-2"></i>Histori</a>
              <form action="/logout" method="POST">
                @csrf
                <button class="btn btn-danger rounded-0 fw-semibold" type="submit" onclick="return confirm('Apakah yakin ingin keluar ?')"><i class="fas fa-power-off me-2"></i>Keluar</button>
              </form>
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endif
<script>
  function confirmLogout() {
    return confirm('Yakin ingin keluar?');
  }
</script>