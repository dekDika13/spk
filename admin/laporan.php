<?php

session_start();
//JIKA TIDAK DITEMUKAN $_SESSION['status'] (USER/ADMIN TIDAK MELIWATI TAHAP LOGIN) MAKA LEMBAR ADMIN/USER KEHALAMAN LOGIN 
if (!isset($_SESSION['status'])) {
  header("Location: ../index.php?pesan=logindahulu");
  exit;
}

require '../functions.php';

//BUKA SEMUA DATA YANG ADA DI TABLE hasil_akhir DAN URUTKAN KODE TERBARU TAMPIL DIATAS
$data = query("SELECT * FROM laporan_hasil ORDER BY id_laporan DESC");

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
      color: #CDD0D4;

    }

    a font {
      color: whitesmoke;
    }

    .navbar-nav a:hover {
      color: darkblue;
    }

    .text-riwayat {
      width: 100%;
      color: grey;
      text-align: center;
      border-bottom: 1px solid grey;
      line-height: 0.1em;
      margin: 10px 0 20px;
    }

    h6 span {
      padding: 0 10px;
    }

    tr:hover {
      -webkit-transform: scale(1.03);
      transform: scale(1.03);
      font-weight: bold;
    }
  </style>

  <title>LAPORAN</title>
</head>

<body bgcolor="f0f0f0">
  <?php require("navigasi.php") ?>


  <br>
  <div class="container bg-light shadow p-3 mb-5">

    <div class="alert alert-info">
      <center><b>LAPORAN GURU TERFAVORIT</b></center>
    </div>

    <div class="table-responsive p-4">
      <table class="table table-striped shadow">
        <tr class="bg-info">
          <th width="150">Kode</th>
          <th width="300">Tanggal</th>
          <th>Total Data</th>
          <th>Aksi</th>
        </tr>

        <?php $no = 1; ?>
        <?php
        foreach ($data as $hasil_akhir) {
        ?>

          <?php
          //memanggil kode yang ada di table hasil_akhir
          $id_laporan = $hasil_akhir["id_laporan"];
          //menghitung total data dari data masing masing kode
          $total = mysqli_query($con, "SELECT COUNT(id_laporan) AS TOTAL FROM hasil_akhir WHERE id_laporan = '$id_laporan'");
          $totaldata = mysqli_fetch_assoc($total);
          ?>

          <tr>
            <td><?= $hasil_akhir['id_laporan']; ?></td>
            <td><?= $hasil_akhir['tanggal']; ?></td>
            <td><?= $totaldata['TOTAL']; ?></td>
            <td>
              <a href="detail_laporan.php?kode=<?= $hasil_akhir['id_laporan']; ?>"
                class="btn btn-info">Lihat</a>
              <a href="hapus_laporan.php?kode=<?= $hasil_akhir['id_laporan']; ?>"
                class="btn btn-danger">Hapus</a>
              <a href="export_pdf.php?kode=<?= $hasil_akhir['id_laporan']; ?>" class="btn btn-success">Download</a>

            </td>

          </tr>

        <?php } ?>
      </table>
    </div>


    <br><br>
    <h6 class="text-riwayat"><span class="bg-light">Riwayat Laporan</span></h6>

    <br><br>
  </div>

  <div class="col-md-12 bg-primary">
    <div class="copyright">
      <h6>MI AL HUDA</h6>
    </div>
  </div>



  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
  </script>

</body>

</html>