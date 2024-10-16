<?php


$con = mysqli_connect("localhost", "root", "", "db_moora_improve");

function login($data)
{
	global $con;

	$username = $data['username'];
	$password = $data['password'];

	$login = mysqli_query($con, "SELECT * FROM user WHERE username = '$username' AND password = '$password' ");

	return mysqli_affected_rows($con);
}

function query($query)
{

	global $con;

	$data = mysqli_query($con, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($data)) {
		$rows[] = $row;
	}
	return $rows;
}

function tampilkriteria($query)
{

	global $con;

	$data = mysqli_query($con, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($data)) {
		$rows[] = $row;
	}
	return $rows;
}

function edit_kriteria($data)
{
	global $con;
	$id_kriteria = $data['id_kriteria'];
	$kriteria = $data['kriteria'];
	$bobot = $data['bobot'];
	$type = $data['type'];

	mysqli_query($con, "UPDATE kriteria SET 
		kriteria = '$kriteria',
		bobot = '$bobot',
		type = '$type'
		WHERE id_kriteria = '$id_kriteria'
		");

	return mysqli_affected_rows($con);
}

function tampilguru($query)
{

	global $con;

	$data = mysqli_query($con, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($data)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah_guru($data)
{
	global $con;
	$nama_alternatif = $data['nama'];
	mysqli_query($con, "INSERT INTO alternatif (nama,username) VALUES ('$nama_alternatif','admin')");

	return mysqli_affected_rows($con);
}

// Function untuk mengambil semua data dari table kriteria
function get_all_alternatif()
{
	global $con;

	$data = mysqli_query($con, "SELECT * FROM alternatif");
	$rows = [];
	while ($row = mysqli_fetch_assoc($data)) {
		$rows[] = $row;
	}
	return $rows;
}

function edit_guru($data)
{
	global $con;

	$nama_alternatif =  $data['nama'];
	$id_alternatif = $data['id_alternatif'];


	mysqli_query($con, "UPDATE alternatif SET nama = '$nama_alternatif' WHERE id_alternatif = '$id_alternatif'");

	return mysqli_affected_rows($con);
}

function edit_data_guru($data)
{
	global $con;

	$id_alternatif = $data['id_alternatif'];

	for ($i = 1; $i <= 5; $i++) {
		// Jika kriteria adalah 3, gunakan sum yang sudah dihitung dari frontend untuk id_kriteria 3
		if ($i == 1) {
			$c1_sum = $data['c1_sum'];
			mysqli_query($con, "UPDATE nilai SET nilai = '$c1_sum' WHERE id_alternatif = '$id_alternatif' AND id_kriteria = '$i'");
		} elseif ($i == 3) {
			$c3_sum = $data['c3_sum'];
			mysqli_query($con, "UPDATE nilai SET nilai = '$c3_sum' WHERE id_alternatif = '$id_alternatif' AND id_kriteria = '$i'");
		}
		// Jika kriteria adalah 5, gunakan sum yang sudah dihitung dari frontend untuk id_kriteria 5
		elseif ($i == 5) {
			$c5_sum = $data['c5_sum'];
			mysqli_query($con, "UPDATE nilai SET nilai = '$c5_sum' WHERE id_alternatif = '$id_alternatif' AND id_kriteria = '$i'");
		}
		// Untuk kriteria lain, gunakan nilai yang langsung diterima dari form
		else {
			$c = $data['c' . $i];
			mysqli_query($con, "UPDATE nilai SET nilai = '$c' WHERE id_alternatif = '$id_alternatif' AND id_kriteria = '$i'");
		}
	}

	return mysqli_affected_rows($con);
}


function hapus_guru($id_alternatif)
{
    global $con;

    // Validasi $id_alternatif (misalnya, pastikan $id_alternatif adalah integer)
    if (!is_numeric($id_alternatif)) {
        return false; // Atau throw exception
    }

    // Escape $id_alternatif untuk mencegah SQL Injection
    $id_alternatif = mysqli_real_escape_string($con, $id_alternatif);

    // Hapus data dari tabel nilai
    $query1 = "DELETE FROM nilai WHERE id_alternatif = '$id_alternatif'";
    $result1 = mysqli_query($con, $query1);
    if (!$result1) {
        error_log("Error query pertama: " . mysqli_error($con));
        return false;
    }

    // Hapus data dari tabel hasil_akhir
    $query2 = "DELETE FROM hasil_akhir WHERE id_alternatif = '$id_alternatif'";
    $result2 = mysqli_query($con, $query2);
    if (!$result2) {
        error_log("Error query kedua: " . mysqli_error($con));
        return false;
    }

    // Hapus data dari tabel alternatif
    $query3 = "DELETE FROM alternatif WHERE id_alternatif = '$id_alternatif'";
    $result3 = mysqli_query($con, $query3);
    if (!$result3) {
        error_log("Error query ketiga: " . mysqli_error($con));
        return false;
    }

    // Jika semua query berhasil, return true
    return true;
}

function insert_hasil_perankingan($data)
{
	date_default_timezone_set('Asia/Jakarta');
	global $con;

	$id_alternatif = $data['id_alternatif'];
	$total_hasil = $data['total_hasil'];

	add_laporan();
	$id_laporan = get_laporan_terakhir();


	for ($i = 0; $i < count($id_alternatif); $i++) {
		mysqli_query($con, "INSERT INTO hasil_akhir (id_laporan, id_alternatif, total,username) VALUES('$id_laporan','$id_alternatif[$i]','$total_hasil[$i]','admin')");
	}

	return mysqli_affected_rows($con);
}


function hapus_laporan($kode)
{
    global $con;

    // Validasi $kode (misalnya, pastikan $kode adalah integer)
    if (!is_numeric($kode)) {
        return false; // Atau throw exception
    }

    // Escape $kode untuk mencegah SQL Injection
    $kode = mysqli_real_escape_string($con, $kode);

    // Hapus data dari tabel hasil_akhir
    $query1 = "DELETE FROM hasil_akhir WHERE id_laporan = '$kode'";
    $result1 = mysqli_query($con, $query1);
    if (!$result1) {
        // Tangani error query pertama (misalnya, log error atau tampilkan pesan error)
        error_log("Error query pertama: " . mysqli_error($con)); 
        return false;
    }

    // Hapus data dari tabel laporan_hasil
    $query2 = "DELETE FROM laporan_hasil WHERE id_laporan = '$kode'";
    $result2 = mysqli_query($con, $query2);
    if (!$result2) {
        // Tangani error query kedua
        error_log("Error query kedua: " . mysqli_error($con)); 
        return false;
    }

    // Jika kedua query berhasil, return true
    return true;
}

function edit_account($data)
{
	global $con;

	$password = $data['password'];


	mysqli_query($con, "UPDATE user SET
						 password = '$password'
						 WHERE username = 'admin'
						  ");

	return mysqli_affected_rows($con);
}

// Function untuk mengambil semua data dari table kriteria
function get_all_kriteria()
{
	global $con;

	$data = mysqli_query($con, "SELECT * FROM kriteria");
	$rows = [];
	while ($row = mysqli_fetch_assoc($data)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah_nilai($data)
{
	global $con;
	tambah_guru($data); // Tambah guru ke tabel alternatif
	$id_alternatif = get_alternatif_terakhir(); // Ambil ID alternatif yang baru ditambahkan

	// Looping untuk setiap kriteria (1 sampai 5)
	for ($i = 1; $i <= 5; $i++) {
		// Jika ID Kriteria 1 (C1), lakukan logika khusus
		if ($i == 1) {
			$c = $data['c1_sum'];  // Sesuaikan logika perhitungan untuk C1 jika perlu, misal:
			// $c = $data['c1'] * 2; // Contoh jika ingin melipatgandakan nilai C1
		}
		// Jika ID Kriteria 3, gunakan sum yang dihitung dari checkbox
		elseif ($i == 3) {
			$c = array_sum($data['c3']);  // Menghitung jumlah nilai dari checkbox untuk Kriteria 3
		}
		// Jika ID Kriteria 5, gunakan sum yang dihitung dari checkbox
		elseif ($i == 5) {
			$c = $data['c5_sum'];  // Menghitung jumlah nilai dari checkbox untuk Kriteria 5
		}
		// Untuk kriteria lainnya, gunakan nilai langsung dari form
		else {
			$c = $data['c' . $i];
		}

		// Insert nilai ke tabel nilai berdasarkan id_alternatif dan id_kriteria
		mysqli_query($con, "INSERT INTO nilai (id_alternatif, id_kriteria, nilai,username) VALUES ('$id_alternatif','$i','$c','admin')");
	}
	return mysqli_affected_rows($con);
}


function get_nilai_alternatif($id_alternatif)
{
	global $con;

	$data = mysqli_query($con, "SELECT * FROM nilai WHERE id_alternatif = '$id_alternatif' ");
	$rows = [];
	while ($row = mysqli_fetch_assoc($data)) {
		$rows[] = $row;
	}
	return $rows;
}

function has_nilai($id_alternatif)
{
	global $con;

	$data = mysqli_query($con, "SELECT * FROM nilai WHERE id_alternatif = '$id_alternatif'");
	$row = mysqli_fetch_assoc($data);
	return $row !== NULL;
}

function get_nilai_by_id($id_alternatif, $id_kriteria)
{
	global $con;

	$data = mysqli_query($con, "SELECT nilai FROM nilai WHERE id_alternatif = '$id_alternatif' AND id_kriteria = '$id_kriteria' ");
	$row = mysqli_fetch_assoc($data);
	return $row['nilai'];
}

function sum_bobot_kriteria()
{
	global $con;

	$data = mysqli_query($con, "SELECT SUM(bobot) from kriteria");
	$sum = mysqli_fetch_assoc($data);
	return intval($sum['SUM(bobot)']);
}

function add_laporan()
{
	global $con;
	$tanggal = date('d - M - Y | H : i : s');
	mysqli_query($con, "INSERT INTO laporan_hasil (tanggal,username) VALUES ('$tanggal','admin')");
	return mysqli_affected_rows($con);
}
function get_laporan_terakhir()
{
	global $con;

	$data = mysqli_query($con, "SELECT * FROM laporan_hasil ORDER BY id_laporan DESC LIMIT 1");
	$row = mysqli_fetch_assoc($data);
	return intval($row['id_laporan']);
}
function get_alternatif_terakhir()
{
	global $con;

	$data = mysqli_query($con, "SELECT * FROM alternatif ORDER BY id_alternatif DESC LIMIT 1");
	$row = mysqli_fetch_assoc($data);
	return intval($row['id_alternatif']);
}
function get_alternatif_by_id($id_alternatif)
{
	global $con;

	$data = mysqli_query($con, "SELECT nama FROM alternatif WHERE id_alternatif = '$id_alternatif' ");
	$row = mysqli_fetch_assoc($data);
	return $row['nama'];
}
