<?php
session_start();
//JIKA TIDAK DITEMUKAN $_SESSION['status'] (USER/ADMIN TIDAK MELIWATI TAHAP LOGIN) MAKA LEMBAR ADMIN/USER KEHALAMAN LOGIN 
if (!isset($_SESSION['status'])) {
  header("Location: ../xml_get_current_byte_index(parser).php?pesan=logindahulu");
  exit;
}
require '../functions.php';

$data_kriteria = get_all_kriteria();



// JIKA TIDAK MENERIMA DATA ID ALTERNATIF MAKA LEMPAR KEMBALI KE data_alternatif.php
if (!isset($_POST['id_alternatif'])) {
  echo "<script>
  alert('Pilih Data Guru Dahulu ! ')
  document.location.href='data_guru.php'
  </script>";
} else {

  //JIKA MENERIMA DATA ID ALTERNATIF MAKA JALANKAN HALAMAN perhitungan.php

  $sum_nilai = sum_bobot_kriteria();
  $sum_kriteria = [
    1 => 0, // Untuk kriteria 1
    2 => 0, // Untuk kriteria 2
    3 => 0, // Untuk kriteria 3
    4 => 0, // Untuk kriteria 4
    5 => 0, // Untuk kriteria 5
  ];

  foreach ($data_kriteria as $kriteria) {
    // Menambahkan kriteria kuadrat ke jumlah yang sesuai dengan id_kriteria
    $sum_kriteria[$kriteria['id_kriteria']] =  intval($kriteria['bobot']) / $sum_nilai;
  }

  //JIKA TOMBOL SIMPAN DITEKAN MAKA
  if (isset($_POST['simpan'])) {
    if (insert_hasil_perankingan($_POST) > 0) {
      echo "<script>
          alert('data tersimpan')
          document.location.href='laporan.php'
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

        .hidden {
            display: none;
        }

        .col-md-12 {
            padding: 8px;
        }

        .copyright {
            text-align: center;
            color: #CDD0D4;
        }

        .navbar-nav a:hover {
            font-weight: bold;
            color: darkblue;
        }

        tr:hover {
            -webkit-transform: scale(1.03);
            transform: scale(1.03);
            font-weight: bold;
        }
    </style>

    <title>PERHITUNGAN</title>
</head>

<body bgcolor="f0f0f0">
    <?php require("navigasi.php") ?>


    <br>
    <div  class="container bg-light shadow mb-5" >

        <div cid="content"class="alert alert-info content hidden">
            <center><b>DATA GURU TERPILIH</b></center>
        </div>

        <div id="content"class="table-responsive p-4 content hidden">
            <table class="table table-striped shadow">
                <tr class="bg-info">
                    <th width="150">Id Alternatif</th>
                    <th>Nama Alternatif</th>
                    <?php foreach ($data_kriteria as $kriteria) {
            ?>
                    <th> <?= $kriteria['kriteria'] ?> (C<?= $kriteria["id_kriteria"] ?>) </th>
                    <?php } ?>
                </tr>

                <?php
          $id_alternatifs = $_POST['id_alternatif'];
          foreach ($id_alternatifs as $id_alternatif) {
            // $data = mysqli_query($con, "SELECT * FROM nilai WHERE id_alternatif = '$id_alternatif' ");
            $guru = tampilguru("SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ")[0];

          ?>
                <tr>
                    <td><?= $guru['id_alternatif']; ?></td>
                    <td><?= $guru['nama']; ?></td>
                    <?php
              $data_nilai = get_nilai_alternatif($guru['id_alternatif']);

              foreach ($data_nilai as $nilai) {

              ?>
                    <td><?= $nilai['nilai']; ?></td>

                    <?php } ?>
                </tr>


                <?php
          }

          ?>

                </form>
            </table>
        </div>


        <br id="content"  class="content hidden"><br>
        <h1 id="content"  style="border-bottom:3px dodgerblue solid " class="content hidden"></h1>
        <br id="content"  class="content hidden"><br>

        <div id="content"class="alert alert-info content hidden">
            <center><b>NORMALISASI</b></center>
        </div>

        <div id="content" class="table-responsive p-4 content hidden" >
            <table class="table table-striped shadow">
                <tr class="bg-info">
                    <th width="150">Id Alternatif</th>
                    <th>Nama Alternatif</th>
                    <?php foreach ($data_kriteria as $kriteria) { ?>
                    <th> <?= $kriteria['kriteria'] ?> (C<?= $kriteria["id_kriteria"] ?>) </th>
                    <?php } ?>
                </tr>

                <?php
          $sum_c = [
            1 => 0, // Untuk kriteria dengan id_kriteria 1
            2 => 0, // Untuk kriteria dengan id_kriteria 2
            3 => 0, // Untuk kriteria dengan id_kriteria 3
            4 => 0, // Untuk kriteria dengan id_kriteria 4
            5 => 0, // Untuk kriteria dengan id_kriteria 5
          ];

          $id_alternatifs = $_POST['id_alternatif'];
          foreach ($id_alternatifs as $id_alternatif) {
            $guru = tampilguru("SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ")[0];

            $data_nilai = get_nilai_alternatif($guru['id_alternatif']);

            foreach ($data_nilai as $nilai) {
              // Menambahkan nilai kuadrat ke jumlah yang sesuai dengan id_kriteria
              $sum_c[$nilai['id_kriteria']] += pow($nilai['nilai'], 2);
            }
          }

          foreach ($id_alternatifs as $id_alternatif) {
            $guru = tampilguru("SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ")[0];

          ?>

                <tr>
                    <td><?= $guru['id_alternatif']; ?></td>
                    <td><?= $guru['nama']; ?></td>
                    <?php
              $data_nilai = get_nilai_alternatif($guru['id_alternatif']);

              foreach ($data_nilai as $nilai) {

              ?>
                    <td><?= round($nilai['nilai'] / sqrt($sum_c[$nilai['id_kriteria']]), 4) ?></td>

                    <?php } ?>

                </tr>


                <?php
          }
          ?>
            </table>

        </div>
        <div id="content"class="card mt-4 content hidden">
            <div id="content "class="card-header bg-info text-white content hidden">
                Keterangan
            </div>
            <div id="content"class="card-body content hidden">
                <h5 class="card-title">Normalisasi</h5>
                <p class="card-text">
                    <!-- Tambahkan keterangan terkait hasil perhitungan di sini -->
                    Normalisasi adalah proses perhitungan nilai asli alternatif (guru) di bagi dengan akar dari total nilai 
                    alternatif (guru) yang telah di kaudratkan di setiap kriteria. Normalisasi ini mengubah
                    data mentah menjadi skala yang seragam antara 0 dan 1, membuat perbandingan antar-kriteria lebih
                    valid.
                </p>
            </div>
        </div>



        <br id="content"  class="content hidden"><br>
        <h1 id="content"  style="border-bottom:3px dodgerblue solid " class="content hidden"></h1>
        <br id="content"  class="content hidden"><br>

        <div id="content"class="alert alert-info content hidden">
            <center><b>TERBOBOT</b></center>
        </div>

        <div id="content"class="table-responsive p-4 content hidden">
            <table class="table table-striped shadow">
                <tr class="bg-info">
                    <th width="150">Id Alternatif</th>
                    <th>Nama Alternatif</th>
                    <?php foreach ($data_kriteria as $kriteria) { ?>
                    <th> <?= $kriteria['kriteria'] ?> (C<?= $kriteria["id_kriteria"] ?>) </th>
                    <?php } ?>
                </tr>

                <?php
          $id_alternatifs = $_POST['id_alternatif'];
          foreach ($id_alternatifs as $id_alternatif) {
            $guru = tampilguru("SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ")[0];
          ?>
                <tr>
                    <td><?= $guru['id_alternatif']; ?></td>
                    <td><?= $guru['nama']; ?></td>
                    <?php
              $data_nilai = get_nilai_alternatif($guru['id_alternatif']);

              foreach ($data_nilai as $nilai) {

              ?>
                    <td><?= round(($nilai['nilai'] / sqrt($sum_c[$nilai['id_kriteria']]) * $sum_kriteria[$nilai['id_kriteria']]), 4) ?>
                    </td>

                    <?php } ?>

                </tr>


                <?php

          }

          ?>

            </table>
        </div>
        <div id="content" class="card mt-4 content hidden">
            <div class="card-header bg-info text-white">
                Keterangan
            </div>
            <div  id="content" class="card-body content hidden">
                <h5 class="card-title">Terbobot</h5>
                <p class="card-text">
                    <!-- Tambahkan keterangan terkait hasil perhitungan di sini -->
                    Setelah nilai alternatif dinormalisasi, selanjutnya setiap nilai dalam alternatif normalisasi
                    dikalikan dengan
                    bobot kriteria pada setiap kriteria yang bersangkutan. Bobot ini mencerminkan pentingnya relatif kriteria tersebut
                    dalam proses pengambilan keputusan.
                </p>
            </div>
        </div>



        <br id="content"  class="content hidden"><br>
        <h1 id="content" style="border-bottom:3px dodgerblue solid" class="content hidden"></h1>
        <br id="content"  class="content hidden"><br>

        <?php
      if (isset($_POST['simpan'])) {
        $id_alternatifs = $_POST['id_alternatif'];
        $total_hasil = $_POST['total_hasil'];

        // Loop untuk menyimpan setiap hasil ke database
        for ($i = 0; $i < count($id_alternatifs); $i++) {
          $id_alternatif = $id_alternatifs[$i];
          $total = $total_hasil[$i];

          // Simpan ke tabel hasil (sesuaikan dengan tabel yang Anda miliki)
          $query = "INSERT INTO hasil (id_alternatif, total) VALUES ('$id_alternatif', '$total')";
          mysqli_query($koneksi, $query);
        }

        // Berikan pesan bahwa data berhasil disimpan
        echo '<div class="alert alert-success">Data berhasil disimpan!</div>';
      }
      ?>
       <div class="alert alert-info">
            <center><b>HASIL AKHIR</b></center>
        </div>

        <div class="table-responsive p-4">
            <table class="table table-striped shadow">
                <tr class="bg-info">
                    <th width="150">Id Alternatif</th>
                    <th>Nama Alternatif</th>
                    <th>Total</th>
                    <th>Rank</th>
                </tr>

                <?php
          $hasil_akhir = []; // Array untuk menyimpan hasil akhir

          $id_alternatifs = $_POST['id_alternatif'];
          foreach ($id_alternatifs as $id_alternatif) {
            $guru = tampilguru("SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ")[0];

            $kriteria = [
              1 => ["type" => "", "nilai" => 0],
              2 => ["type" => "", "nilai" => 0],
              3 => ["type" => "", "nilai" => 0],
              4 => ["type" => "", "nilai" => 0],
              5 => ["type" => "", "nilai" => 0],
            ];

            $data_nilai = get_nilai_alternatif($guru['id_alternatif']);
            foreach ($data_kriteria as $bobot) {
              $kriteria[$bobot['id_kriteria']]['type'] = $bobot['type'];
            }
            foreach ($data_nilai as $nilai) {
              $kriteria[$nilai['id_kriteria']]['nilai'] = round(($nilai['nilai'] / sqrt($sum_c[$nilai['id_kriteria']]) * $sum_kriteria[$nilai['id_kriteria']]), 4);
            }

            $total = 0;
            foreach ($kriteria as $index => $data) {
              if ($kriteria[$index]['type'] === 'Benefit') {
                $total += $kriteria[$index]['nilai'];
              } else {
                $total -= $kriteria[$index]['nilai'];
              }
            }

            // Simpan hasil akhir ke array untuk ditampilkan dan disimpan
            $hasil_akhir[] = [
              'id_alternatif' => $guru['id_alternatif'],
              'nama' => $guru['nama'],
              'total' => $total
            ];
          }

          // Urutkan hasil akhir dari yang terbesar ke terkecil
          usort($hasil_akhir, function ($a, $b) {
            return $b['total'] <=> $a['total'];
          });

          // Tampilkan hasil akhir
          $i = 1;
          foreach ($hasil_akhir as $hasil) {
          ?>
                <tr>
                    <td><?= $hasil['id_alternatif']; ?></td>
                    <td><?= $hasil['nama']; ?></td>
                    <td><?= $hasil['total']; ?></td>
                    <td><?= $i++; ?></td>
                </tr>
                <?php } ?>

            </table>
        </div>

     <!-- Tombol Simpan dan Show/Hide -->
     <form method="POST" class="form-group">
            <?php foreach ($hasil_akhir as $hasil) { ?>
            <input type="hidden" name="id_alternatif[]" value="<?= $hasil['id_alternatif']; ?>">
            <input type="hidden" name="total_hasil[]" value="<?= $hasil['total']; ?>">
            <?php } ?>
            <button type="submit" name="simpan" class="btn btn-success" style="float: right;">Simpan</button>
            <button type="button" id="toggleButton" class="btn btn-primary" style="float: right; margin-right: 10px;">Show</button>
            <br><br>
        </form>

        <div class="card mt-4">
            <div class="card-header bg-info text-white">
                Keterangan
            </div>
            <div class="card-body">
                <h5 class="card-title">Hasil Akhir</h5>
                <p class="card-text">
                    Hasil akhir adalah untuk menentukan peringkat setiap alternatif.
                    Alternatif dengan nilai tertinggi dianggap sebagai pilihan guru terfavorit.
                </p>
            </div>
        </div>

        <div class="col-md-12 bg-primary">
            <div class="copyright">
                <h6>MI AL HUDA</h6>
            </div>
        </div>
        <?php } ?>


        <script>
       const toggleButton = document.getElementById('toggleButton');
const contentElements = document.querySelectorAll('.content'); // Pilih semua elemen dengan class "content"

toggleButton.addEventListener('click', function() {
  contentElements.forEach(element => {  // Loop melalui setiap elemen
    element.classList.toggle('hidden'); // Toggle class "hidden"
  });

  // Ubah teks tombol berdasarkan status elemen pertama
  if (contentElements[0].classList.contains('hidden')) { 
    toggleButton.textContent = 'Show All';
  } else {
    toggleButton.textContent = 'Hide All';
  }
});
    </script>
 

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>

</body>

</html>
