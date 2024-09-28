<?php
session_start();
if (!isset($_SESSION['status'])) {
    header("Location: ../index.php?pesan=logindahulu");
    exit;
}

require '../functions.php';

$data_kriteria = get_all_kriteria();

if (isset($_POST['simpan'])) {
    if (tambah_nilai($_POST) > 0) {
        echo "<script>
          alert ('Data Berhasil Di Tambah')
          document.location.href='data_guru.php'
          </script>";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <center><b>TAMBAH DATA GURU</b></center>
        </div>

        <div class="col-md-7">
            <form method="post" class="form-group">
                <div class="table-responsive">
                    <table class="table">

                        <tr>
                            <td><label>Nama Alternatif</label></td>
                            <td> : </td>
                            <td width="500"> <input type="text" name="nama" class="form-control" autocomplete="off">
                            </td>
                        </tr>

                        <?php foreach ($data_kriteria as $kriteria) { ?>
                            <tr>
                                <td><label>
                                        <?= $kriteria['kriteria'] ?> (C<?= $kriteria["id_kriteria"] ?>)
                                    </label></td>
                                <td> : </td>
                                <td width="500">

                                    <?php if ($kriteria['id_kriteria'] == 1) { ?>
                                        <div>
                                            <label>Izin:</label>
                                            <input type="number" name="c1_izin_value" id="c1_izin_value" value="0"
                                                class="form-control mt-2" placeholder="Masukkan jumlah izin"
                                                oninput="calculateSumForC1()">
                                        </div>
                                        <div>
                                            <label>Absen:</label>
                                            <input type="number" name="c1_absen_value" id="c1_absen_value" value="0"
                                                class="form-control mt-2" placeholder="Masukkan jumlah absen"
                                                oninput="calculateSumForC1()">
                                        </div>

                                        <label>
                                            <input type="checkbox" name="c<?= $kriteria['id_kriteria'] ?>[]" value="1"
                                                id="c1_tech_checkbox" onchange="toggleAbsenceFields(this)"> Tidak pernah
                                            absen/izin
                                        </label><br>
                                        <input type="hidden" id="c1_sum" name="c1_sum" value="0">
                                    <?php } ?>



                                    <?php if ($kriteria['id_kriteria'] == 2) { ?>
                                        <small class="text-muted">* Tahun.</small>
                                        <input type="number" name="c<?= $kriteria['id_kriteria'] ?>" class="form-control"
                                            autocomplete="off">
                                    <?php } ?>

                                    <?php if ($kriteria['id_kriteria'] == 3) { ?>
                                        <div>
                                            <label><input type="checkbox" name="c<?= $kriteria['id_kriteria'] ?>[]" value="3"
                                                    onchange="calculateSumForC3()"> Kooperatif menggunakan Teknologi</label><br>
                                            <label><input type="checkbox" name="c<?= $kriteria['id_kriteria'] ?>[]" value="2"
                                                    onchange="calculateSumForC3()"> Kooperatif</label><br>
                                            <label><input type="checkbox" name="c<?= $kriteria['id_kriteria'] ?>[]" value="1"
                                                    onchange="calculateSumForC3()"> Tradisional</label><br>
                                        </div>
                                        <input type="hidden" id="c3_sum" name="c3_sum" value="0">
                                    <?php } else if ($kriteria['id_kriteria'] == 5) { ?>
                                        <div>
                                            <label>Juara 1 tingkat Nasional sebagai guru pembimbing:</label>
                                            <input type="number" name="c5_juara1_nasional" id="c5_juara1_nasional" value="0"
                                                class="form-control mt-2" placeholder="Masukkan jumlah juara"
                                                oninput="calculateSumForC5()"><br>

                                            <label>Juara 2 tingkat Nasional sebagai guru pembimbing:</label>
                                            <input type="number" name="c5_juara2_nasional" id="c5_juara2_nasional" value="0"
                                                class="form-control mt-2" placeholder="Masukkan jumlah juara"
                                                oninput="calculateSumForC5()"><br>

                                            <label>Juara 3 tingkat Nasional sebagai guru pembimbing:</label>
                                            <input type="number" name="c5_juara3_nasional" id="c5_juara3_nasional" value="0"
                                                class="form-control mt-2" placeholder="Masukkan jumlah juara"
                                                oninput="calculateSumForC5()"><br>

                                            <label>Juara 1 tingkat Provinsi sebagai guru pembimbing:</label>
                                            <input type="number" name="c5_juara1_provinsi" id="c5_juara1_provinsi" value="0"
                                                class="form-control mt-2" placeholder="Masukkan jumlah juara"
                                                oninput="calculateSumForC5()"><br>

                                            <label>Juara 2 tingkat Provinsi sebagai guru pembimbing:</label>
                                            <input type="number" name="c5_juara2_provinsi" id="c5_juara2_provinsi" value="0"
                                                class="form-control mt-2" placeholder="Masukkan jumlah juara"
                                                oninput="calculateSumForC5()"><br>

                                            <label>Juara 3 tingkat Provinsi sebagai guru pembimbing:</label>
                                            <input type="number" name="c5_juara3_provinsi" id="c5_juara3_provinsi" value="0"
                                                class="form-control mt-2" placeholder="Masukkan jumlah juara"
                                                oninput="calculateSumForC5()"><br>

                                            <label>Juara 1 tingkat Kabupaten sebagai guru pembimbing:</label>
                                            <input type="number" name="c5_juara1_kabupaten" id="c5_juara1_kabupaten" value="0"
                                                class="form-control mt-2" placeholder="Masukkan jumlah juara"
                                                oninput="calculateSumForC5()"><br>

                                            <label>Juara 2 tingkat Kabupaten sebagai guru pembimbing:</label>
                                            <input type="number" name="c5_juara2_kabupaten" id="c5_juara2_kabupaten" value="0"
                                                class="form-control mt-2" placeholder="Masukkan jumlah juara"
                                                oninput="calculateSumForC5()"><br>

                                            <label>Juara 3 tingkat Kabupaten sebagai guru pembimbing:</label>
                                            <input type="number" name="c5_juara3_kabupaten" id="c5_juara3_kabupaten" value="0"
                                                class="form-control mt-2" placeholder="Masukkan jumlah juara"
                                                oninput="calculateSumForC5()"><br>


                                            <label>
                                                <input type="checkbox" name="c5_tech_checkbox" id="c5_tech_checkbox"
                                                    onchange="toggleAllC5Fields(this)"> Belum pernah mendapatkan Juara di
                                                berbagai tingkat
                                            </label><br>

                                            <input type="hidden" id="c5_sum" name="c5_sum" value="0">
                                        </div>

                                    <?php } else if ($kriteria['id_kriteria'] == 4) { ?>
                                        <select name="c4" class="form-control">
                                            <option value="1">SMA</option>
                                            <option value="2">S1</option>
                                            <option value="3">S2</option>
                                        </select>


                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>

                        <td></td>
                        <td></td>
                        <td><button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                            &nbsp;&nbsp;&nbsp;
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

    <script>
        function calculateSumForC1() {
            const izinField = document.getElementById('c1_izin_value');
            const absenField = document.getElementById('c1_absen_value');
            const checkbox = document.getElementById('c1_tech_checkbox');

            // Ambil nilai izin dan absen
            const izinValue = parseInt(izinField.value) || 0; // Nilai izin
            const absenValue = parseInt(absenField.value) || 0; // Nilai absen

            // Faktor pengali
            const izinMultiplier = 2; // Izin dikali 3
            const absenMultiplier = 3; // Absen dikali 2

            // Hitung izin * 3 + absen * 2 hanya jika checkbox tidak tercentang
            let totalSum = (izinValue * izinMultiplier) + (absenValue * absenMultiplier);

            // Jika checkbox tercentang, totalSum akan diatur ke 1
            if (checkbox.checked) {
                totalSum = 1; // Checkbox dicentang, jadi totalnya jadi 1
            }

            // Set nilai c1_sum ke totalSum yang dihitung
            document.getElementById('c1_sum').value = totalSum;
        }

        function toggleAbsenceFields(checkbox) {
            const izinField = document.getElementById('c1_izin_value');
            const absenField = document.getElementById('c1_absen_value');

            if (checkbox.checked) {
                // Jika checkbox dicentang, nonaktifkan field izin dan absen, atur nilai mereka ke 0
                izinField.disabled = true;
                absenField.disabled = true;
                izinField.value = 0;
                absenField.value = 0;
                document.getElementById('c1_sum').value = 1; // Set total sum ke 1
            } else {
                // Jika checkbox tidak dicentang, aktifkan kembali field izin dan absen
                izinField.disabled = false;
                absenField.disabled = false;
                calculateSumForC1(); // Kalkulasi ulang sum saat checkbox tidak dicentang
            }
        }




        function calculateSumForC3() {
            let sum = 0;
            const checkboxes = document.querySelectorAll('input[name="c3[]"]:checked');
            checkboxes.forEach(function(checkbox) {
                sum += parseInt(checkbox.value);
            });
            document.getElementById('c3_sum').value = sum;
        }

        function calculateSumForC5() {
            const juara1Nasional = parseInt(document.getElementById('c5_juara1_nasional').value) || 0;
            const juara2Nasional = parseInt(document.getElementById('c5_juara2_nasional').value) || 0;
            const juara3Nasional = parseInt(document.getElementById('c5_juara3_nasional').value) || 0;
            const juara1Provinsi = parseInt(document.getElementById('c5_juara1_provinsi').value) || 0;
            const juara2Provinsi = parseInt(document.getElementById('c5_juara2_provinsi').value) || 0;
            const juara3Provinsi = parseInt(document.getElementById('c5_juara3_provinsi').value) || 0;
            const juara1Kabupaten = parseInt(document.getElementById('c5_juara1_kabupaten').value) || 0;
            const juara2Kabupaten = parseInt(document.getElementById('c5_juara2_kabupaten').value) || 0;
            const juara3Kabupaten = parseInt(document.getElementById('c5_juara3_kabupaten').value) || 0;


            const juara1NasionalMultiplier = 10;
            const juara2NasionalMultiplier = 9;
            const juara3NasionalMultiplier = 8;
            const juara1ProvinsiMultiplier = 7;
            const juara2ProvinsiMultiplier = 6;
            const juara3ProvinsiMultiplier = 5;
            const juara1KabupatenMultiplier = 4;
            const juara2KabupatenMultiplier = 3;
            const juara3KabupatenMultiplier = 2;


            let totalSum = (juara1Nasional * juara1NasionalMultiplier) +
                (juara2Nasional * juara2NasionalMultiplier) +
                (juara3Nasional * juara3NasionalMultiplier) +
                (juara1Provinsi * juara1ProvinsiMultiplier) +
                (juara2Provinsi * juara2ProvinsiMultiplier) +
                (juara3Provinsi * juara3ProvinsiMultiplier) +
                (juara1Kabupaten * juara1KabupatenMultiplier) +
                (juara2Kabupaten * juara2KabupatenMultiplier) +
                (juara3Kabupaten * juara3KabupatenMultiplier);

            // Jika checkbox dicentang, set totalSum menjadi 1
            if (document.getElementById('c5_tech_checkbox').checked) {
                totalSum = 1;
            }

            // Set nilai c5_sum
            document.getElementById('c5_sum').value = totalSum;
        }

        function toggleAllC5Fields(checkbox) {
            const fields = [
                'c5_juara1_nasional', 'c5_juara2_nasional', 'c5_juara3_nasional',
                'c5_juara1_provinsi', 'c5_juara2_provinsi', 'c5_juara3_provinsi',
                'c5_juara1_kabupaten', 'c5_juara2_kabupaten', 'c5_juara3_kabupaten'

            ];

            if (checkbox.checked) {
                // Nonaktifkan semua field dan set nilainya ke 0
                fields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    field.disabled = true;
                    field.value = 0;
                });
                document.getElementById('c5_sum').value = 1; // Set total sum ke 1
            } else {
                // Aktifkan kembali semua field
                fields.forEach(fieldId => {
                    document.getElementById(fieldId).disabled = false;
                });
                calculateSumForC5(); // Kalkulasi ulang saat checkbox tidak dicentang
            }
        }
    </script>
</body>

</html>