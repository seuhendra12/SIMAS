<section class="container-fluid py-5 bg-young_green" id="statistik">
  <div class="row">
    <div class="col-12 text-center">
      <h1 class="mb-1 fw-bold mb-5">Statistik</h1>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-4">
        <div class="card mb-3 rounded-3 bg-old_green" style="max-width: 540px;">
          <div class="row g-0">
            <div class="col-md-4 my-2">
              <img src="{!! asset('/img/icon/icon_list.png') !!}" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h3 class="card-title mt-3 fw-bold">{{$jenis_sampah->count()}}</h3>
                <p class="card-text fw-bold text-white">Jenis Sampah</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="card mb-3 rounded-3 bg-old_green" style="max-width: 540px;">
          <div class="row g-0">
            <div class="col-md-4 my-2">
              <img src="{!! asset('/img/icon/icon_database.png') !!}" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h3 class="card-title mt-3 fw-bold">13.901.109 Ton</h3>
                <p class="card-text fw-bold text-white">Sampah Dikumpulkan</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="card mb-3 rounded-3 bg-old_green" style="max-width: 540px;">
          <div class="row g-0">
            <div class="col-md-4 my-2">
              <img src="{!! asset('/img/icon/icon_recycle.png') !!}" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h3 class="card-title mt-3 fw-bold">13.123 Ton</h3>
                <p class="card-text fw-bold text-white">Sampah Dimanfaatkan</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="card mb-3 rounded-3 bg-old_green" style="max-width: 540px;">
          <div class="row g-0">
            <div class="col-md-4 my-2">
              <img src="{!! asset('/img/icon/icon_internal.png') !!}" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h3 class="card-title mt-3 fw-bold">13.123 Ton</h3>
                <p class="card-text fw-bold text-white">Sampah Diolah Internal</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="card mb-3 rounded-3 bg-old_green" style="max-width: 540px;">
          <div class="row g-0">
            <div class="col-md-4 my-2">
              <img src="{!! asset('/img/icon/icon_eksternal.png') !!}" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h3 class="card-title mt-3 fw-bold">13.123 Ton</h3>
                <p class="card-text fw-bold text-white">Sampah Diolah Eksternal</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="card mb-3 rounded-3 bg-old_green" style="max-width: 540px;">
          <div class="row g-0">
            <div class="col-md-4 my-2">
              <img src="{!! asset('/img/icon/icon_trash.png') !!}" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h3 class="card-title mt-3 fw-bold">13.123 Ton</h3>
                <p class="card-text fw-bold text-white">Sampah Dibuang</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>