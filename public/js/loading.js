function showProgress() {
  document.getElementById('progress').style.display = 'block';
  document.querySelector('.indicator-progress').classList.add('show');
}

// Sembunyikan pesan "Please wait..." dan hapus kelas CSS
function hideProgress() {
  document.getElementById('progress').style.display = 'none';
  document.querySelector('.indicator-progress').classList.remove('show');
}

// Contoh penggunaan pada fungsi AJAX
function doAjaxRequest() {
  showProgress();
  // melakukan request AJAX
  // setelah selesai, panggil fungsi hideProgress() untuk menyembunyikan tampilan progress
}