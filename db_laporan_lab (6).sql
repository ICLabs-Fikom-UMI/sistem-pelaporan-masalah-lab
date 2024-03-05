-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: my-mysql:3306
-- Waktu pembuatan: 05 Mar 2024 pada 23.51
-- Versi server: 8.2.0
-- Versi PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_laporan_lab`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_aset_lab`
--

CREATE TABLE `master_aset_lab` (
  `ID_Aset` int NOT NULL,
  `Nama_Aset` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `master_aset_lab`
--

INSERT INTO `master_aset_lab` (`ID_Aset`, `Nama_Aset`) VALUES
(1, 'PC'),
(2, 'Monitor'),
(3, 'Keyboard'),
(4, 'Mouse'),
(5, 'Mousepad'),
(6, 'Label'),
(7, 'Meja'),
(8, 'Kursi'),
(9, 'Tv'),
(10, 'Jaringan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_lab`
--

CREATE TABLE `master_lab` (
  `ID_Lab` int NOT NULL,
  `Nama_Lab` varchar(30) DEFAULT NULL,
  `ID_Lab_Detail` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `master_lab`
--

INSERT INTO `master_lab` (`ID_Lab`, `Nama_Lab`, `ID_Lab_Detail`) VALUES
(1, 'START UP', NULL),
(2, 'IOT', NULL),
(3, 'COMPUTER NETWORK', NULL),
(4, 'MULTIMEDIA', NULL),
(5, 'DATA SCIENCE', NULL),
(6, 'COMPUTER VISION', NULL),
(7, 'MICROCONTROLLER', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_lab_detail`
--

CREATE TABLE `master_lab_detail` (
  `ID_Lab_Detail` int NOT NULL,
  `Jumlah_Kursi` int DEFAULT NULL,
  `Jumlah_Tv` int DEFAULT NULL,
  `Deskripsi_Lab` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_roles`
--

CREATE TABLE `master_roles` (
  `ID_Peran` int NOT NULL,
  `Nama_Peran` varchar(20) DEFAULT NULL,
  `Deskripsi_Peran` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `master_roles`
--

INSERT INTO `master_roles` (`ID_Peran`, `Nama_Peran`, `Deskripsi_Peran`) VALUES
(1, 'Laboran', NULL),
(2, 'Korlab', NULL),
(3, 'Asisten', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_teknisi_task`
--

CREATE TABLE `master_teknisi_task` (
  `ID_Pengguna` int NOT NULL,
  `ID_Masalah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_user`
--

CREATE TABLE `master_user` (
  `ID_Pengguna` int NOT NULL,
  `Nama_Depan` varchar(20) DEFAULT NULL,
  `Nama_Belakang` varchar(20) DEFAULT NULL,
  `Nim` char(11) DEFAULT NULL,
  `Email` varchar(254) DEFAULT NULL,
  `Kata_Sandi` char(72) DEFAULT NULL,
  `ID_Peran` int DEFAULT NULL,
  `Foto_Path` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `master_user`
--

INSERT INTO `master_user` (`ID_Pengguna`, `Nama_Depan`, `Nama_Belakang`, `Nim`, `Email`, `Kata_Sandi`, `ID_Peran`, `Foto_Path`) VALUES
(1, 'fatimah', NULL, '13020100001', 'fatimah@gmail.com', '$2y$10$0lz8Gv2aoJjhy6zhORqms.PndM.1pwRsIfUNp2k32f.d4G/f3C2.6', 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `txn_lab_issues`
--

CREATE TABLE `txn_lab_issues` (
  `ID_Masalah` int NOT NULL,
  `Deskripsi_Masalah` text,
  `Tanggal_Pelaporan` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ID_Lab` int DEFAULT NULL,
  `ID_Aset` int DEFAULT NULL,
  `ID_Pelapor` int DEFAULT NULL,
  `Foto_Path` varchar(255) DEFAULT NULL,
  `Status_Masalah` enum('Diproses','Disetujui','Ditolak','Selesai') DEFAULT NULL,
  `Batas_Waktu` date DEFAULT NULL,
  `Deskripsi_Tambahan` text,
  `Nomor_Unit` varchar(20) DEFAULT NULL,
  `Komentar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `master_aset_lab`
--
ALTER TABLE `master_aset_lab`
  ADD PRIMARY KEY (`ID_Aset`);

--
-- Indeks untuk tabel `master_lab`
--
ALTER TABLE `master_lab`
  ADD PRIMARY KEY (`ID_Lab`),
  ADD KEY `ID_Lab_Detail` (`ID_Lab_Detail`);

--
-- Indeks untuk tabel `master_lab_detail`
--
ALTER TABLE `master_lab_detail`
  ADD PRIMARY KEY (`ID_Lab_Detail`);

--
-- Indeks untuk tabel `master_roles`
--
ALTER TABLE `master_roles`
  ADD PRIMARY KEY (`ID_Peran`);

--
-- Indeks untuk tabel `master_teknisi_task`
--
ALTER TABLE `master_teknisi_task`
  ADD PRIMARY KEY (`ID_Pengguna`,`ID_Masalah`),
  ADD KEY `ID_Masalah` (`ID_Masalah`);

--
-- Indeks untuk tabel `master_user`
--
ALTER TABLE `master_user`
  ADD PRIMARY KEY (`ID_Pengguna`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Nim` (`Nim`),
  ADD KEY `ID_Peran` (`ID_Peran`);

--
-- Indeks untuk tabel `txn_lab_issues`
--
ALTER TABLE `txn_lab_issues`
  ADD PRIMARY KEY (`ID_Masalah`),
  ADD KEY `ID_Lab` (`ID_Lab`),
  ADD KEY `ID_Aset` (`ID_Aset`),
  ADD KEY `ID_Pelapor` (`ID_Pelapor`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `master_aset_lab`
--
ALTER TABLE `master_aset_lab`
  MODIFY `ID_Aset` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `master_lab`
--
ALTER TABLE `master_lab`
  MODIFY `ID_Lab` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `master_lab_detail`
--
ALTER TABLE `master_lab_detail`
  MODIFY `ID_Lab_Detail` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `master_roles`
--
ALTER TABLE `master_roles`
  MODIFY `ID_Peran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `master_user`
--
ALTER TABLE `master_user`
  MODIFY `ID_Pengguna` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `txn_lab_issues`
--
ALTER TABLE `txn_lab_issues`
  MODIFY `ID_Masalah` int NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `master_lab`
--
ALTER TABLE `master_lab`
  ADD CONSTRAINT `master_lab_ibfk_1` FOREIGN KEY (`ID_Lab_Detail`) REFERENCES `master_lab_detail` (`ID_Lab_Detail`);

--
-- Ketidakleluasaan untuk tabel `master_teknisi_task`
--
ALTER TABLE `master_teknisi_task`
  ADD CONSTRAINT `master_teknisi_task_ibfk_1` FOREIGN KEY (`ID_Pengguna`) REFERENCES `master_user` (`ID_Pengguna`),
  ADD CONSTRAINT `master_teknisi_task_ibfk_2` FOREIGN KEY (`ID_Masalah`) REFERENCES `txn_lab_issues` (`ID_Masalah`);

--
-- Ketidakleluasaan untuk tabel `master_user`
--
ALTER TABLE `master_user`
  ADD CONSTRAINT `master_user_ibfk_1` FOREIGN KEY (`ID_Peran`) REFERENCES `master_roles` (`ID_Peran`);

--
-- Ketidakleluasaan untuk tabel `txn_lab_issues`
--
ALTER TABLE `txn_lab_issues`
  ADD CONSTRAINT `txn_lab_issues_ibfk_1` FOREIGN KEY (`ID_Lab`) REFERENCES `master_lab` (`ID_Lab`),
  ADD CONSTRAINT `txn_lab_issues_ibfk_2` FOREIGN KEY (`ID_Aset`) REFERENCES `master_aset_lab` (`ID_Aset`),
  ADD CONSTRAINT `txn_lab_issues_ibfk_3` FOREIGN KEY (`ID_Pelapor`) REFERENCES `master_user` (`ID_Pengguna`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
