<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Sampah Dikumpulkan Per RW</title>
  <style>
    /* Tambahkan style CSS yang diinginkan untuk format tabel di sini */
    /* Contoh CSS untuk tabel: */
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: center;
    }

    th {
      background-color: #f2f2f2;
    }
    /* Tambahkan style untuk footer */
    footer {
      position: absolute;
      bottom: 0;
      width: 100%;
      text-align: center;
      font-size: 12px;
      color: #888;
    }
  </style>
</head>

<body>
  <h3 style="text-align: center;">Laporan Sampah Dikumpulkan Per RW</h3>
  <hr>
  @foreach ($dataPerRW as $rwId => $dataRW)
  <h4 style="margin-top: 20px;">RW {{ $rwId }}</h3>
    <table>
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama RT</th>
          <th scope="col">Total Berat Sampah (Kg)</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; ?>
        @foreach ($dataRW as $rtId => $data)
        <?php
        $totalBerat = $data->sum('total_berat');
        ?>
        <tr>
          <td>{{ $no++ }}</td>
          <td>RT {{ $rtId }}</td>
          <td>{{ $totalBerat }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endforeach
    <!-- Tampilkan tanggal di footer -->
    <footer>
      Laporan ini dihasilkan pada: {{ date('d F Y') }}
    </footer>
</body>

</html>