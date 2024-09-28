<?php
session_start();
//JIKA TIDAK DITEMUKAN $_SESSION['status'] (USER/ADMIN TIDAK MELIWATI TAHAP LOGIN) MAKA LEMBAR ADMIN/USER KEHALAMAN LOGIN 
if (!isset($_SESSION['status'])) {
  header("Location: ../index.php?pesan=logindahulu");
  exit;
}

require '../functions.php';

//MEMBUKA SEMUA DATA YG ADA DI TABLE ALTERNATIF
$data_guru = tampilguru("SELECT * FROM alternatif");

// Mengambil Semua Data dari table kriteria
$data_kriteria = get_all_kriteria();
//MEMBUKU KEMBALI UNTUK MEMBACA TOTAL DATA YANG ADA
$data_guru1 = mysqli_query($con, "SELECT * FROM alternatif");

//JIKA DI KLIK BUTTON CARI MAKA
if (isset($_POST['cari'])) {
  $input = $_POST['input'];
  //TAMPILKAN DATA YANG DI INPUTKAN 
  $data_guru = tampilguru("SELECT * FROM alternatif WHERE nama LIKE '%$input%' OR id_alternatif LIKE '%$input%' ");
}


?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <style>
    body {
      background-color: #f0f0f0;
    }

    .container {
      min-height: calc(100vh - 211px - -60px);
    }

    @media (min-width: 1050px) {

      .hitung {
        display: none;
      }

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

    tr:hover {
      -webkit-transform: scale(1.03);
      transform: scale(1.03);
      font-weight: bold;
    }
  </style>

  <title>DATA GURU</title>
</head>

<body bgcolor="f0f0f0">
  <form method="post" action="perhitungan.php">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand" href="#"><img src="../img/logo.png" width="50"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav" style="margin: 10px;">
          <a class="nav-link active" href="index.php">
            <font size="4"><b>Home</b> </font>
          </a>
          <a class="nav-link" href="data_kriteria.php">
            <font size="4"><b>Data Kritria</b></font>
          </a>
          <a class="nav-link" href="data_guru.php">
            <font size="4"><b>Data Guru</b></font>
          </a>
          <a class="nav-link" href="#">
            <font size="4"><b><button type="submit" name="perhitungan" class="btn btn-primary"
                  style="font-size: 20px; margin-top: -10px;"><b>Perhitungan</b></button></b></font>
          </a>
          <a class="nav-link" href="laporan.php">
            <font size="4"><b>Laporan</b></font>
          </a>
          <a class="nav-link" href="setting_akun.php">
            <font size="4"><b>Setting Akun</b></font>
          </a>

        </div>

        <div class="navbar-nav ms-auto" style="margin: 10px;">
          <a href="" type="button" class="log nav-link m-auto" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            <font size="4"><b>Logout</b></font>
            <img src="../img/logout.png" width="30">
          </a>
        </div>
      </div>
    </nav>

    <br>
    <div class="container bg-light shadow p-3 mb-5">
      <div class="alert alert-info">
        <center><b>DATA GURU</b></center>
      </div>
  </form>

  <div class="form-inline">
    <form method="POST" action="" class="form-group">
      <input type="text" name="input" autofocus autocomplete="off" class="form-control shadow">
      <button type="submit" name="cari" class="btn btn-primary shadow">Cari</button>
    </form>

  </div>
  <br>
  <a href="tambah_data_guru.php" class="btn btn-success">Tambah Data</a>
  <br><br>
  <div class="hitung">
    <button type="submit" name="perhitungan" class="btn btn-primary"
      style=" margin-top: -10px;"><b>hitung</b></button>
  </div>

  <script>
    function checkAll(ele) {
      var checkboxes = document.getElementsByTagName('input');
      if (ele.checked) {
        for (var i = 0; i < checkboxes.length; i++) {
          if (checkboxes[i].type == 'checkbox') {
            checkboxes[i].checked = true;
          }
        }
      } else {
        for (var i = 0; i < checkboxes.length; i++) {
          if (checkboxes[i].type == 'checkbox') {
            checkboxes[i].checked = false;
          }
        }
      }
    }
  </script>

  <div class="table-responsive p-4">
    <table class="table table-striped shadow p-3 mb-5">
      <?php $tot = mysqli_num_rows($data_guru1);
      echo "Total Data : <b>" . $tot . "</b>";
      ?>
      <tr class="bg-info">
        <th>Pilih <br> (semua) <br>
          <input type="checkbox" onChange="checkAll(this)" name="chk[]">
        </th>
        <!-- <th>Id Alternatif</th> -->
        <th>Nama Alternatif</th>

        <?php foreach ($data_kriteria as $kriteria) { ?>
          <th> <?= $kriteria['kriteria'] ?> (C<?= $kriteria["id_kriteria"] ?>) </th>

        <?php } ?>
        <th>Aksi</th>
      </tr>

      <?php foreach ($data_guru as $guru) {

        if (has_nilai($guru['id_alternatif'])) {

      ?>
          <tr>
            <td><input type="checkbox" name="id_alternatif[]" id="pilih" value="<?= $guru['id_alternatif']; ?>">
            </td>
            <!-- <td><?= $guru['id_alternatif']; ?></td> -->
            <td><?= $guru['nama']; ?></td>
            <?php
            $data_nilai = get_nilai_alternatif($guru['id_alternatif']);

            foreach ($data_nilai as $nilai) {

            ?>
              <td><?= $nilai['nilai']; ?></td>

            <?php } ?>

            <td>
              <a href="edit_data_guru.php?id_alternatif=<?= $guru['id_alternatif']; ?>"
                class="btn btn-warning">Edit</a>
              <a href="edit_guru.php?id_alternatif=<?= $guru['id_alternatif']; ?>" class="btn btn-info">Edit
                Guru</a>
              <a href="hapus_data_guru.php?id_alternatif=<?= $guru['id_alternatif']; ?>"
                class="btn btn-danger">Delete Data</a>
            </td>
          </tr>

      <?php }
      } ?>


    </table>
  </div>


  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Apakah anda yakin ingin keluar ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a href="../logout.php" type="button" class="btn btn-danger">Keluar</a>
        </div>
      </div>
    </div>
  </div>

  </div>

  <div class="col-md-12 bg-primary">
    <div class="copyright">
      <h6>MI AL HUDA</h6>
    </div>
  </div>


  <!-- 
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
   -->
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