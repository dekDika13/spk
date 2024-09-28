<?php

session_start();
//JIKA TIDAK DITEMUKAN $_SESSION['status'] (USER/ADMIN TIDAK MELIWATI TAHAP LOGIN) MAKA LEMBAR ADMIN/USER KEHALAMAN LOGIN 
if (!isset($_SESSION['status'])) {
  header("Location: ../index.php?pesan=logindahulu");
  exit;
}


?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <!-- <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"> -->
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <style>
    body {
      background-color: #f0f0f0;
    }

    .gambar {
      max-width: 70%;
      height: auto;
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

    @media (max-width: 1000px) {
      .judul {
        font-size: 3vh;
      }
    }
  </style>

  <title>Home</title>
</head>

<body bgcolor="f0f0f0">

  <?php require("navigasi.php") ?>

  <br>
  <div class="container bg-light shadow p-3 mb-5">
    <div class="alert alert-info">
      <center><b>SELAMAT DATANG ADMIN</b></center>
    </div>
    <br>
    <center>
      <font size="5" class="judul"><b>Sistem Pendukung Keputusan Dalam Merekomendasikan Guru Terfavorit </b></font>
    </center>

    <br><br>

    <center>

      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../img/galeri/f1.jpeg" width="300" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../img/galeri/f2.jpeg" width="300" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../img/galeri/f3.jpeg" width="300" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item ">
            <img src="../img/galeri/f5.jpeg" width="300" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../img/galeri/f4.jpeg" width="300" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../img/galeri/f6.jpeg" width="300" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../img/galeri/f7.jpeg" width="300" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item ">
            <img src="../img/galeri/f8.jpeg" width="300" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../img/galeri/f9.jpeg" width="300" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../img/galeri/f10.jpeg" width="300" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../img/galeri/f11.jpeg" width="300" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

    </center>

    <br>
  </div>

  <div class="col-md-12 bg-primary">
    <div class="copyright">
      <h6>MI AL HUDA</h6>
    </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>