<!DOCTYPE html>
<html>

<head>
  <title>Struk Tukar Poin</title>
  <style>
    @page {
      size: 100mm 170mm;
      /* Atur ukuran kertas cetakannya di sini */
      margin: 0;
      /* Hilangkan margin untuk mencetak struk tanpa border */
    }

    body {
      font-family: Arial, sans-serif;
      margin: 5mm;
      /* Beri sedikit margin pada konten agar tidak terlalu dekat dengan tepi kertas */
    }

    .container {
      border: 1px solid #000;
      padding: 10px;
    }

    .header {
      text-align: center;
      margin-bottom: 10px;
    }

    .content {
      font-size: 12px;
    }

    .footer {
      font-size: 10px;
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <h2>Struk Tukar Poin</h2>
    </div>
    <div class="content">
      <p><strong>ID Transaksi:</strong> {{ $tukarPoin->transaksi->kode_transaksi }}</p>
      <p><strong>Kode Aplikasi:</strong> {{ $tukarPoin->transaksi->user->profile->kode_simas }}</p>
      <p><strong>Nama Pengguna:</strong> {{ $tukarPoin->transaksi->user->name }}</p>
      <p><strong>Total Konversi:</strong> {{ $tukarPoin->total_konversi }} Poin</p>
      <p><strong>Tanggal Transaksi:</strong> {{ $tukarPoin->tanggal_transaksi->format('d M Y') }}</p>
      <p>
        <strong>Status:</strong>
        @if ($tukarPoin->status == 'Tunda')
        Tunda
        @elseif ($tukarPoin->status == 'Proses')
        Proses
        @elseif ($tukarPoin->status == 'Selesai')
        Selesai
        @endif
      </p>
    </div>
    <div class="footer">
      <p>Terima kasih telah melakukan transaksi</p>
    </div>
  </div>
</body>

</html>