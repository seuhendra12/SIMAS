<section>
  <div class="jumbotron jumbotron-fluid bg-aliceblue">
    <img src="{!! asset('/img/background/background.png') !!}" alt="" class="background">
  </div>
</section>
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