-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Sep 2024 pada 14.43
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_moora_improve`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama`) VALUES
(1, 'Masyniah'),
(2, 'Siti Aisyah'),
(3, 'Zaenah'),
(4, 'Syahrizal Aldi'),
(5, 'Nur Jannah'),
(6, 'Ardiana'),
(7, 'Hey Syafruddin'),
(8, 'Nita Wahyuni'),
(22, 'abc'),
(23, 'bca'),
(24, 'cab');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_akhir`
--

CREATE TABLE `hasil_akhir` (
  `id_hasil_akhir` int(11) NOT NULL,
  `id_laporan` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hasil_akhir`
--

INSERT INTO `hasil_akhir` (`id_hasil_akhir`, `id_laporan`, `id_alternatif`, `total`) VALUES
(54, 10, 1, 0.1515),
(55, 10, 2, 0.1385),
(56, 10, 3, 0.133),
(57, 10, 4, 0.2179),
(58, 10, 5, 0.0811),
(59, 10, 6, 0.1868),
(60, 10, 7, 0.087),
(61, 10, 8, 0.0292),
(62, 11, 1, 0.2401),
(63, 11, 2, 0.2383),
(64, 11, 3, 0.2046),
(65, 11, 5, 0.1139),
(66, 11, 8, 0.0816),
(67, 12, 1, 0.1515),
(68, 12, 2, 0.1385),
(69, 12, 3, 0.133),
(70, 12, 4, 0.2179),
(71, 12, 5, 0.0811),
(72, 12, 6, 0.1868),
(73, 12, 7, 0.087),
(74, 12, 8, 0.0292),
(84, 14, 22, 0.2309),
(85, 14, 23, 0.2309),
(86, 14, 24, 0.2309);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kriteria` varchar(255) NOT NULL,
  `bobot` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kriteria`, `bobot`, `type`) VALUES
(1, 'Absensi', 30, 'Cost'),
(2, 'Lama Mengajar', 15, 'Benefit'),
(3, 'Metode Pembelajaran', 25, 'Benefit'),
(4, 'Pendidikan Terakhir', 10, 'Benefit'),
(5, 'Prestasi', 20, 'Benefit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_hasil`
--

CREATE TABLE `laporan_hasil` (
  `id_laporan` int(11) NOT NULL,
  `tanggal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laporan_hasil`
--

INSERT INTO `laporan_hasil` (`id_laporan`, `tanggal`) VALUES
(10, '20 - Aug - 2024 | 20 : 59 : 52'),
(11, '21 - Aug - 2024 | 14 : 15 : 47'),
(12, '27 - Aug - 2024 | 05 : 52 : 34'),
(14, '05 - Sep - 2024 | 17 : 53 : 19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_kriteria`, `id_alternatif`, `nilai`) VALUES
(6, 1, 1, 3),
(7, 2, 1, 20),
(8, 3, 1, 4),
(9, 4, 1, 2),
(10, 5, 1, 2),
(11, 1, 2, 4),
(12, 2, 2, 15),
(13, 3, 2, 6),
(14, 4, 2, 2),
(15, 5, 2, 2),
(16, 1, 3, 2),
(17, 2, 3, 18),
(18, 3, 3, 4),
(19, 4, 3, 2),
(20, 5, 3, 1),
(21, 1, 4, 4),
(22, 2, 4, 3),
(23, 3, 4, 12),
(24, 4, 4, 2),
(25, 5, 4, 3),
(26, 1, 5, 3),
(27, 2, 5, 22),
(28, 3, 5, 1),
(29, 4, 5, 2),
(30, 5, 5, 1),
(36, 1, 6, 5),
(37, 2, 6, 18),
(38, 3, 6, 8),
(39, 4, 6, 2),
(40, 5, 6, 3),
(41, 1, 7, 5),
(42, 2, 7, 18),
(43, 3, 7, 6),
(44, 4, 7, 2),
(45, 5, 7, 1),
(46, 1, 8, 7),
(47, 2, 8, 15),
(48, 3, 8, 6),
(49, 4, 8, 2),
(50, 5, 8, 1),
(97, 1, 22, 1),
(98, 2, 22, 1),
(99, 3, 22, 8),
(100, 4, 22, 1),
(101, 5, 22, 10),
(102, 1, 23, 1),
(103, 2, 23, 1),
(104, 3, 23, 8),
(105, 4, 23, 1),
(106, 5, 23, 10),
(107, 1, 24, 1),
(108, 2, 24, 1),
(109, 3, 24, 8),
(110, 4, 24, 1),
(111, 5, 24, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indeks untuk tabel `hasil_akhir`
--
ALTER TABLE `hasil_akhir`
  ADD PRIMARY KEY (`id_hasil_akhir`),
  ADD KEY `hasil_akhir_id_laporan_foreign` (`id_laporan`),
  ADD KEY `hasil_akhir_id_alternatif_foreign` (`id_alternatif`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `laporan_hasil`
--
ALTER TABLE `laporan_hasil`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `nilai_id_alternatif_foreign` (`id_alternatif`),
  ADD KEY `nilai_id_kriteria_foreign` (`id_kriteria`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `hasil_akhir`
--
ALTER TABLE `hasil_akhir`
  MODIFY `id_hasil_akhir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `laporan_hasil`
--
ALTER TABLE `laporan_hasil`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hasil_akhir`
--
ALTER TABLE `hasil_akhir`
  ADD CONSTRAINT `hasil_akhir_id_alternatif_foreign` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`),
  ADD CONSTRAINT `hasil_akhir_id_laporan_foreign` FOREIGN KEY (`id_laporan`) REFERENCES `laporan_hasil` (`id_laporan`);

--
-- Ketidakleluasaan untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_id_alternatif_foreign` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`),
  ADD CONSTRAINT `nilai_id_kriteria_foreign` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
