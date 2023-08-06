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
  <h3 style="text-align: center;">Laporan Sampah Dimanfaatkan</h3>
  <hr>
  <table>
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Jenis Sampah</th>
        <th scope="col">Berat</th>
        <th scope="col">Tanggal</th>
        <th scope="col" class="col-2">Keterangan</th>
        <th scope="col">Petugas</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      @forelse($sampahDimanfaatkans as $sampahDimanfaatkan)
      <tr>
        <td class="align-top">{{$loop->iteration}}</td>
        <td class="align-top">{{$sampahDimanfaatkan->jenisSampah->name}}</td>
        <td class="align-top">{{$sampahDimanfaatkan->berat}} Kg</td>
        <td class="align-top">{{$sampahDimanfaatkan->tanggal_dimanfaatkan->format('d/m/Y')}}</td>
        <td class="align-top">{{$sampahDimanfaatkan->keterangan}}</td>
        <td class="align-top">{{$sampahDimanfaatkan->user->name}}</td>
        <td class="align-top">
          @if ($sampahDimanfaatkan->status == 'ditolak')
          <h5 class="badge badge-light-danger">Ditolak</h5>
          @elseif ($sampahDimanfaatkan->status == 'dalam proses')
          <h5 class="badge badge-light-primary">Dalam proses</h5>
          @elseif ($sampahDimanfaatkan->status == 'selesai')
          <h5 class="badge badge-light-success">Selesai</h5>
          @endif
        </td>
      </tr>
      @empty
      <td colspan="7">--Data Tidak Ada--</td>
      @endforelse
    </tbody>
  </table>

  <h3 style="text-align: center;">Laporan Sampah Diolah Internal</h3>
  <hr>
  <table>
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Jenis Sampah</th>
        <th scope="col" class="col-1">Berat</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Lokasi</th>
        <th scope="col" class="col-2">Keterangan</th>
        <th scope="col">Petugas</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      @forelse($sampahDiolahInternals as $sampahDiolahInternal)
      <tr>
        <td class="align-top">{{$loop->iteration}}</td>
        <td class="align-top">{{$sampahDiolahInternal->jenisSampah->name}}</td>
        <td class="align-top">{{$sampahDiolahInternal->berat}} Kg</td>
        <td class="align-top">{{$sampahDiolahInternal->tanggal_diolah->format('d/m/Y')}}</td>
        <td class="align-top">{{$sampahDiolahInternal->lokasi_diolah}}</td>
        <td class="align-top">{{$sampahDiolahInternal->keterangan}}</td>
        <td class="align-top">{{$sampahDiolahInternal->user->name}}</td>
        <td class="align-top">
          @if ($sampahDiolahInternal->status == 'ditolak')
          <h5 class="badge badge-light-danger">Ditolak</h5>
          @elseif ($sampahDiolahInternal->status == 'dalam proses')
          <h5 class="badge badge-light-primary">Dalam proses</h5>
          @elseif ($sampahDiolahInternal->status == 'selesai')
          <h5 class="badge badge-light-success">Selesai</h5>
          @endif
        </td>
      </tr>
      @empty
      <td colspan="8">--Data Tidak Ada--</td>
      @endforelse
    </tbody>
  </table>

  <h3 style="text-align: center;">Laporan Sampah Diolah Eksternal</h3>
  <hr>
  <table>
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Jenis Sampah</th>
        <th scope="col" class="col-1">Berat</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Lokasi</th>
        <th scope="col" class="col-2">Keterangan</th>
        <th scope="col">Petugas</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      @forelse($sampahDiolahEksternals as $sampahDiolahEksternal)
      <tr>
        <td class="align-top">{{$loop->iteration}}</td>
        <td class="align-top">{{$sampahDiolahEksternal->jenisSampah->name}}</td>
        <td class="align-top">{{$sampahDiolahEksternal->berat}} Kg</td>
        <td class="align-top">{{$sampahDiolahEksternal->tanggal_diolah->format('d/m/Y')}}</td>
        <td class="align-top">{{$sampahDiolahEksternal->lokasi_diolah}}</td>
        <td class="align-top">{{$sampahDiolahEksternal->keterangan}}</td>
        <td class="align-top">{{$sampahDiolahEksternal->user->name}}</td>
        <td class="align-top">
          @if ($sampahDiolahEksternal->status == 'ditolak')
          <h5 class="badge badge-light-danger">Ditolak</h5>
          @elseif ($sampahDiolahEksternal->status == 'dalam proses')
          <h5 class="badge badge-light-primary">Dalam proses</h5>
          @elseif ($sampahDiolahEksternal->status == 'selesai')
          <h5 class="badge badge-light-success">Selesai</h5>
          @endif
        </td>
      </tr>
      @empty
      <td colspan="8">--Data Tidak Ada--</td>
      @endforelse
    </tbody>
  </table>

  <h3 style="text-align: center;">Laporan Sampah Dibuang Ke TPA</h3>
  <hr>
  <table>
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Jenis Sampah</th>
        <th scope="col">Berat Sampah</th>
      </tr>
    </thead>
    <tbody>
      @forelse($sampahDibuangs as $sampahDibuang)
      <tr>
        <td class="align-top">{{$loop->iteration}}</td>
        <td class="align-top">{{$sampahDibuang->jenisSampah->name}}</td>
        <td class="align-middle">{{$sampahDibuang->jumlah_berat}} Kg</td>
      </tr>
      @empty
      <td colspan="3">--Data Tidak Ada--</td>
      @endforelse
    </tbody>
  </table>

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