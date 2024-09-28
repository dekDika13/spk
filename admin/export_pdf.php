<?php
require '../vendor/autoload.php'; // Pastikan path ini benar jika menggunakan Composer
use Dompdf\Dompdf;
use Dompdf\Options;

session_start();
if (!isset($_SESSION['status'])) {
  header("Location: ../index.php?pesan=logindahulu");
  exit;
}

require '../functions.php';

// MENGAMBIL DATA YANG DI KLIK DARI LAPORAN
$kode = $_GET['kode'];

// TAMPILKAN SEMUA DATA DIMANA YANG kode_hasil NYA BERDASARKAN DARI $kode 
$data = query("SELECT * FROM hasil_akhir WHERE id_laporan = '$kode' ORDER BY total DESC");

// Inisialisasi dompdf
$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// Mulai buffer output
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan - PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Laporan Guru Terfavorit</h2>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Id Alternatif</th>
                <th>Nama Alternatif</th>
                <th>Total</th>
                <th>Rank</th>
            </tr>
        </thead>
        <tbody>
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
        </tbody>
    </table>
</body>
</html>

<?php
// Ambil output HTML
$html = ob_get_clean();

// Load HTML ke dompdf
$dompdf->loadHtml($html);

// Set ukuran dan orientasi halaman PDF (optional)
$dompdf->setPaper('A4', 'portrait');

// Render PDF
$dompdf->render();

// Output file PDF ke browser
$dompdf->stream("detail_laporan_$kode.pdf", ["Attachment" => true]);
?>
