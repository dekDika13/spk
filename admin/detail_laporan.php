<?php
session_start();
// JIKA TIDAK DITEMUKAN $_SESSION['status'] (USER/ADMIN TIDAK MELIWATI TAHAP LOGIN) MAKA LEMBAR ADMIN/USER KEHALAMAN LOGIN 
if (!isset($_SESSION['status'])) {
  header("Location: ../index.php?pesan=logindahulu");
  exit;
}

require '../functions.php';

// MENGAMBIL DATA YG DI KLIK DARI LAPORAN
$kode = $_GET['kode'];

// TAMPILKAN SEMUA DATA DIMANA YANG kode_hasil NYA BERDASARKAN DARI $kode 
$data = query("SELECT * FROM hasil_akhir  WHERE id_laporan = '$kode' ORDER BY total DESC");

$kriterias = [];
$nilais = [];
foreach ($data as $row) {
  $kriterias[] = get_alternatif_by_id($row['id_alternatif']);
  $nilais[] = $row['total'];
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <style>
    body {
      background-color: #f0f0f0;
    }

    .container {
      min-height: calc(100vh - 211px - -60px);
    }

    .col-md-12 {
      padding: 8px;
    }

    .copyright {
      text-align: center;
      color: #CDD0D4
    }

    a font {
      color: whitesmoke;
    }

    .navbar-nav a:hover {
      color: darkblue;
    }

    tr:hover {
      -webkit-transform: scale(1.03);
      transform: scale(1.03);
      font-weight: bold;
    }
  </style>

  <title>Laporan</title>
</head>

<body bgcolor="f0f0f0">
  <?php require("navigasi.php") ?>


  <br>
  <div class="container bg-light shadow p-3 mb-5">
    <div class="alert alert-info">
      <center><b>DETAIL LAPORAN</b></center>
    </div>

    <a href="laporan.php" class="btn btn-primary mb-3">Kembali</a>

    <div class="table-responsive p-4">
      <table class="table table-striped shadow">
        <tr class="bg-info">
          <th>Kode</th>
          <th>Id Alternatif</th>
          <th>Nama Alternatif</th>
          <th>Total</th>
          <th>Rank</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($data as $detail_data) { ?>
          <tr>
            <td><?= $detail_data['id_laporan']; ?></td>
            <td><?= $detail_data['id_alternatif']; ?></td>
            <td><?= get_alternatif_by_id($detail_data['id_alternatif']) ?></td>
            <td><?= $detail_data['total']; ?></td>
            <td><?= $i++ ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>

  <div class="col-md-12 bg-primary">
    <div class="copyright">
      <h6>MI AL HUDA</h6>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>