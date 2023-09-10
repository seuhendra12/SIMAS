<section>
  <div class="jumbotron jumbotron-fluid bg-aliceblue">
    <img src="{!! asset('/img/background/background.png') !!}" alt="" class="background">
  </div>
</section>
@if(Session::has('success'))
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center w-50 mx-auto">
      <div class="modal-body text-center">
        <div class="mb-1">
          <img alt="Logo" src="{!! asset('/img/icon/success.png') !!}" class="icons-pop-up" />
          <H5 class="mt-1 fw-bold">SUKSES</H5>
        </div class="mb-2">
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
@if(session()->has('errorMessage'))
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center w-50 mx-auto">
      <div class="modal-body text-center">
        <div class="mb-1">
          <img alt="Logo" src="{!! asset('/img/icon/wrong.png') !!}" class="icons-pop-up" />
          <H5 class="mt-1 fw-bold">ERROR</H5>
        </div class="mb-2">
        {{ session('errorMessage') }}
        <div>
          <button type="button" class="btn btn-primary btn-sm rounded-0 mt-2" data-bs-dismiss="modal" aria-label="Close">
            OK
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var myModal = new bootstrap.Modal(document.getElementById('errorModal'));
    myModal.show();
  });
</script>
@endif