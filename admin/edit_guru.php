<?php
session_start();
//JIKA TIDAK DITEMUKAN $_SESSION['status'] (USER/ADMIN TIDAK MELIWATI TAHAP LOGIN) MAKA LEMBAR ADMIN/USER KEHALAMAN LOGIN 
if (!isset($_SESSION['status'])) {
    header("Location: ../index.php?pesan=logindahulu");
    exit;
}


require '../functions.php';
$id_alternatif = $_GET['id_alternatif'];

$data = tampilguru("SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ")[0];
//JIKA TOMBOL SIMPAN DITEKAN MAKA JALANKAN
if (isset($_POST['edit'])) {
    //JIKA function tambah_sepatu > 0 (sukses) MAKA JALANKAN FUNGSI
    edit_guru($_POST);
    echo "<script>
          alert ('Data Berhasil Di Edit')
          document.location.href='data_guru.php'
          </script>";
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
            color: #CDD0D4;
        }


        a font {
            color: whitesmoke;
        }

        .navbar-nav a:hover {
            color: darkblue;

        }
    </style>

    <title>TAMBAH DATA GURU</title>
</head>

<body bgcolor="f0f0f0">
    <?php require("navigasi.php") ?>


    <br>
    <div class="container bg-light shadow p-3 mb-5">
        <div class="alert alert-info">
            <center><b>EDIT GURU</b></center>
        </div>

        <div class="col-md-7">
            <form method="post" class="form-group">
                <div class="table-responsive">
                    <table class="table">
                        <input type="text" name="id_alternatif" value="<?= $data['id_alternatif']; ?>" readonly hidden class="form-control" autocomplete="off">
                        <tr>
                            <td><label>Nama Alternatif</label></td>
                            <td> : </td>
                            <td width="500"> <input type="text" name="nama" class="form-control" autocomplete="off" value="<?= $data['nama'] ?>"></td>
                        </tr>


                        <td></td>
                        <td></td>
                        <td><button type="submit" name="edit" class="btn btn-success">Simpan</button> &nbsp;&nbsp;&nbsp;
                            <a href="data_guru.php" class="btn btn-danger">Batal</a>
                        </td>
                        </tr>
                    </table>
                </div>

            </form>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>

</html>