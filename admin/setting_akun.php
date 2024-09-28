<?php

session_start();
require '../functions.php';
//JIKA TIDAK DITEMUKAN $_SESSION['status'] (USER/ADMIN TIDAK MELIWATI TAHAP LOGIN) MAKA LEMBAR ADMIN/USER KEHALAMAN LOGIN 
if (!isset($_SESSION['status'])) {
    header("Location: ../index.php?pesan=logindahulu");
    exit;
}



if (isset($_POST['edit'])) {
    //JIKA function edit_sepatu > 0 (sukses) MAKA JALANKAN FUNGSI
    if (edit_account($_POST) > 0) {
        echo "<script>
                alert ('Data Berhasil Di Edit')
                document.location.href='index.php'
                </script>";
    }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
            <center><b>SETTING AKUN</b></center>
        </div>
        <div>
            <form method="post">
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" name="edit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <div class="col-md-12 bg-primary">
        <div class="copyright">
            <h6>MI AL HUDA</h6>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
</body>

</html>