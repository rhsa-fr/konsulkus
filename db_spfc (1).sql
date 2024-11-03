-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Okt 2024 pada 08.42
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spfc`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `basis_aturan`
--

CREATE TABLE `basis_aturan` (
  `idaturan` int(11) NOT NULL,
  `idpenyakit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `basis_aturan`
--

INSERT INTO `basis_aturan` (`idaturan`, `idpenyakit`) VALUES
(3, 0),
(4, 0),
(5, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(10, 0),
(11, 0),
(12, 0),
(13, 0),
(14, 0),
(15, 0),
(16, 0),
(19, 3),
(20, 1),
(21, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_basis_aturan`
--

CREATE TABLE `detail_basis_aturan` (
  `idaturan` int(11) DEFAULT NULL,
  `idgejala` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `detail_basis_aturan`
--

INSERT INTO `detail_basis_aturan` (`idaturan`, `idgejala`) VALUES
(3, 5),
(3, 10),
(3, 4),
(3, 7),
(19, 10),
(19, 4),
(19, 7),
(19, 9),
(20, 5),
(20, 8),
(20, 4),
(21, 10),
(21, 13),
(21, 12),
(21, 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_konsultasi`
--

CREATE TABLE `detail_konsultasi` (
  `idkonsultasi` int(11) DEFAULT NULL,
  `idgejala` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `detail_konsultasi`
--

INSERT INTO `detail_konsultasi` (`idkonsultasi`, `idgejala`) VALUES
(4, 5),
(4, 8),
(4, 10),
(4, 11),
(4, 12),
(4, 13),
(5, 4),
(5, 5),
(5, 7),
(5, 8),
(5, 9),
(5, 10),
(5, 13),
(6, 5),
(6, 8),
(7, 5),
(7, 7),
(7, 9),
(7, 11),
(8, 4),
(8, 5),
(8, 7),
(8, 8),
(8, 9),
(8, 10),
(8, 11),
(8, 12),
(8, 13),
(9, 4),
(9, 5),
(9, 7),
(9, 12),
(10, 4),
(10, 5),
(10, 7),
(10, 8),
(10, 9),
(10, 10),
(10, 11),
(10, 12),
(10, 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penyakit`
--

CREATE TABLE `detail_penyakit` (
  `idkonsultasi` int(11) DEFAULT NULL,
  `idpenyakit` int(11) DEFAULT NULL,
  `persentase` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `detail_penyakit`
--

INSERT INTO `detail_penyakit` (`idkonsultasi`, `idpenyakit`, `persentase`) VALUES
(4, 1, 63),
(5, 1, 75),
(6, 1, 25),
(7, 1, 50),
(8, 1, 100),
(9, 1, 67),
(9, 3, 50),
(9, 4, 25),
(10, 1, 100),
(10, 3, 100),
(10, 4, 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala`
--

CREATE TABLE `gejala` (
  `idgejala` int(11) NOT NULL,
  `nmgejala` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `gejala`
--

INSERT INTO `gejala` (`idgejala`, `nmgejala`) VALUES
(4, 'Apakah bercak kurang rasa /matirasa(baal)?'),
(5, 'Apakah ada bercak kemerah merahan?'),
(7, 'Apakah bercak tidak gatal?'),
(8, 'Apakah ada bercak keputih putihan ?'),
(9, 'Apakah bercak tidak sembuh dengan obat kulit?'),
(10, 'Apakah ada kelemahan pada tangan/kaki?'),
(11, 'Apakah kelopak mata tidak menutup sempurna?'),
(12, 'Apakah jari jari tangan tidak bisa menutup/membuka?'),
(13, 'Apakah jari jari kaki tidak bisa mengambil kertas dilantai?');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsultasi`
--

CREATE TABLE `konsultasi` (
  `idkonsultasi` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyakit`
--

CREATE TABLE `penyakit` (
  `idpenyakit` int(11) NOT NULL,
  `nmpenyakit` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `solusi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `penyakit`
--

INSERT INTO `penyakit` (`idpenyakit`, `nmpenyakit`, `keterangan`, `solusi`) VALUES
(1, 'Kusta Pausibasiler (Ringan)', 'Kusta pausibasiler adalah jenis kusta yang ringan, ditandai dengan sedikitnya jumlah bakteri di tubuh.Pausibasiler berasal dari kata pauci yang berarti sedikit, dan bacillus yang merujuk pada bakteri.', 'Pengobatan biasanya dilakukan dengan kombinasi antibiotik (seperti rifampisin dan dapson) selama 6 bulan.'),
(3, 'Kusta Multibasiler Awal(Sedang)', 'Kusta multibasiler awal adalah fase menengah dari penyakit kusta. Pada tahap ini, jumlah bakteri lebih banyak daripada pada kusta pausibasiler, tetapi belum menyebabkan kerusakan yang luas pada saraf dan jaringan tubuh.', ' Pengobatan dengan kombinasi antibiotik lebih lama, yaitu selama 12 bulan,atau kunjungi klinik yang sudah kita rekomendasikan di halaman home'),
(4, 'Kusta Multibasiler Lanjut(Berat)', 'Kusta multibasiler lanjut adalah tahap paling parah dari kusta. Pada tahap ini, tubuh sudah terinfeksi oleh jumlah bakteri yang sangat banyak, dan ini menyebabkan kerusakan yang lebih luas pada saraf, kulit, dan organ lain.', 'Pengobatan antibiotik jangka panjang, biasanya lebih dari 12 bulan,sebaiknya lakukan pemeriksaan dengan dr spesialis kulit,yang tertera di home page');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `idusers` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`idusers`, `username`, `pass`, `role`) VALUES
(1, 'Aqil', '4c73cfb5eb27c056048f752cf99f9290', 'Admin'),
(4, 'Lyra', '65a8843209dde9b736d0aff93f14c0cf', 'Konsultan'),
(5, 'Rahesa', 'b25adbf7f572a0d9f89bf62d8140992e', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `basis_aturan`
--
ALTER TABLE `basis_aturan`
  ADD PRIMARY KEY (`idaturan`) USING BTREE;

--
-- Indeks untuk tabel `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`idgejala`) USING BTREE;

--
-- Indeks untuk tabel `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`idkonsultasi`) USING BTREE;

--
-- Indeks untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`idpenyakit`) USING BTREE;

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `basis_aturan`
--
ALTER TABLE `basis_aturan`
  MODIFY `idaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `gejala`
--
ALTER TABLE `gejala`
  MODIFY `idgejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `idkonsultasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `idpenyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
