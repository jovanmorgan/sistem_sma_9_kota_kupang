-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jun 2024 pada 14.00
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_slbn_kota_kupang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi1`
--

CREATE TABLE `absensi1` (
  `id_absensi1` int(12) NOT NULL,
  `id_kelas` varchar(150) NOT NULL,
  `id_mapel` varchar(12) NOT NULL,
  `jenjang` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absensi1`
--

INSERT INTO `absensi1` (`id_absensi1`, `id_kelas`, `id_mapel`, `jenjang`) VALUES
(3, '3', '11', 'SD'),
(4, '2', '9', 'SD'),
(6, '2', '9', 'SMA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi2`
--

CREATE TABLE `absensi2` (
  `id_absensi2` int(12) NOT NULL,
  `id_absensi1` int(25) NOT NULL,
  `id_guru` int(25) NOT NULL,
  `hadir` text NOT NULL,
  `sakit` text NOT NULL,
  `ijin` text NOT NULL,
  `alpa` text NOT NULL,
  `jam_mengajar` varchar(150) NOT NULL,
  `jam_pulang` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absensi2`
--

INSERT INTO `absensi2` (`id_absensi2`, `id_absensi1`, `id_guru`, `hadir`, `sakit`, `ijin`, `alpa`, `jam_mengajar`, `jam_pulang`) VALUES
(27, 6, 6, '9', '7,8', '', '', '01:47', '01:49'),
(28, 3, 6, '', '10', '', '', '01:51', '01:49'),
(30, 6, 6, '', '7,9', '8', '', '02:31', '07:27'),
(34, 6, 6, '7', '8,9', '', '', '23:24', '23:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(25) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`, `foto`) VALUES
(1, 'admin', 'admin', '1', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(25) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `isi_kegiatan` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(25) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `nomor_telepon` varchar(25) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `foto` text NOT NULL,
  `jenjang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id_guru`, `nama`, `nip`, `jenis_kelamin`, `nomor_telepon`, `username`, `password`, `alamat`, `foto`, `jenjang`) VALUES
(6, 'guru1', '7777', 'Laki-laki', '6282339573409', 'guru', '1', 'jl.matani', '', 'SD'),
(11, 'guru2', '1321334', 'Laki-laki', '62768452', 'guru2', '2', 'jln.naikoten', '', 'SMP');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_kbm`
--

CREATE TABLE `jadwal_kbm` (
  `id_jadwal_kbm` int(12) NOT NULL,
  `id_mapel` int(12) NOT NULL,
  `id_kelas` int(12) NOT NULL,
  `id_guru` int(12) NOT NULL,
  `hari` varchar(35) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `jam_mengajar` varchar(25) NOT NULL,
  `jam_pulang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal_kbm`
--

INSERT INTO `jadwal_kbm` (`id_jadwal_kbm`, `id_mapel`, `id_kelas`, `id_guru`, `hari`, `tanggal`, `jam_mengajar`, `jam_pulang`) VALUES
(3, 11, 4, 11, '12', '2024-05-14', '07:35', '09:35'),
(4, 9, 2, 6, 'sdc', '2024-05-24', '19:36', '19:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kebutuhan_khusus`
--

CREATE TABLE `kebutuhan_khusus` (
  `id_kebutuhan_khusus` int(25) NOT NULL,
  `jenis_kebutuhan_khusus` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kebutuhan_khusus`
--

INSERT INTO `kebutuhan_khusus` (`id_kebutuhan_khusus`, `jenis_kebutuhan_khusus`, `deskripsi`) VALUES
(2, 'TUNARUNGU', 'Mo kermana le '),
(3, 'TUNANETRA', 'Tunanetra adalah gangguan penglihatan '),
(4, 'AUTIS', 'Tunarungu Gangguan pendengaran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(25) NOT NULL,
  `kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kelas`) VALUES
(2, 'X A'),
(3, 'X B'),
(4, 'X C'),
(5, 'X D');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kepalah_sekolah`
--

CREATE TABLE `kepalah_sekolah` (
  `id_kepalah_sekolah` int(25) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(20) NOT NULL,
  `nama_mapel` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `nama_mapel`) VALUES
(9, 'Bahasa Indonesia'),
(10, 'Mate-Matika'),
(11, 'Bahasa Ingris'),
(12, 'IPA'),
(13, 'IPS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(25) NOT NULL,
  `id_siswa` int(25) NOT NULL,
  `id_mapel` int(25) NOT NULL,
  `tahun_ajaran` varchar(150) NOT NULL,
  `nilai` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `report`
--

CREATE TABLE `report` (
  `id_report` int(25) NOT NULL,
  `id_absensi` int(25) NOT NULL,
  `id_siswa` int(25) NOT NULL,
  `id_mapel` int(25) NOT NULL,
  `id_nilai` int(25) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(25) NOT NULL,
  `nama` varchar(175) NOT NULL,
  `nis` int(150) NOT NULL,
  `id_kelas` int(25) NOT NULL,
  `id_kebutuhan_khusus` int(25) NOT NULL,
  `tempat_lahir` varchar(150) NOT NULL,
  `tanggal_lahir` varchar(25) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `jenjang` varchar(25) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama`, `nis`, `id_kelas`, `id_kebutuhan_khusus`, `tempat_lahir`, `tanggal_lahir`, `username`, `password`, `jenis_kelamin`, `alamat`, `jenjang`, `foto`) VALUES
(7, 'nuril', 241243423, 2, 2, '24', '21-May-2024', 'nuril', '1', 'Perempuan', 'jl.baringin', 'SMA', ''),
(8, 'ajhari', 12345, 2, 3, '1', '21-May-2024', 'ajhari', '1', 'Laki-laki', 'jl. baringin', 'SMA', ''),
(9, 'rifal', 1233456, 2, 4, 'rote', '15-May-2024', 'rifal', '1', 'Laki-laki', 'jl. walkot', 'SMA', ''),
(10, 'jovan', 121212, 3, 2, '12', '06-Dec-2002', 'jovan', '1', 'Laki-laki', 'jl.matani', 'SD', ''),
(11, 'RONALDO BOYS DILLAK', 541651, 2, 2, 'rote', '23-May-2024', 'ronal', '1', 'Laki-laki', 'jl.btn', 'SMP', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_ajar`
--

CREATE TABLE `tahun_ajar` (
  `id_tahun_ajar` int(11) NOT NULL,
  `data` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tahun_ajar`
--

INSERT INTO `tahun_ajar` (`id_tahun_ajar`, `data`) VALUES
(4, '2020/2021'),
(5, '2022/2023');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wali_kelas`
--

CREATE TABLE `wali_kelas` (
  `id_wali_kelas` int(25) NOT NULL,
  `id_guru` int(25) NOT NULL,
  `id_kelas` int(25) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `wali_kelas`
--

INSERT INTO `wali_kelas` (`id_wali_kelas`, `id_guru`, `id_kelas`, `username`, `password`, `foto`) VALUES
(2, 6, 2, 'asx', 'asx', ''),
(3, 11, 2, 'asd', 'asd', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi1`
--
ALTER TABLE `absensi1`
  ADD PRIMARY KEY (`id_absensi1`);

--
-- Indeks untuk tabel `absensi2`
--
ALTER TABLE `absensi2`
  ADD PRIMARY KEY (`id_absensi2`);

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indeks untuk tabel `jadwal_kbm`
--
ALTER TABLE `jadwal_kbm`
  ADD PRIMARY KEY (`id_jadwal_kbm`);

--
-- Indeks untuk tabel `kebutuhan_khusus`
--
ALTER TABLE `kebutuhan_khusus`
  ADD PRIMARY KEY (`id_kebutuhan_khusus`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `kepalah_sekolah`
--
ALTER TABLE `kepalah_sekolah`
  ADD PRIMARY KEY (`id_kepalah_sekolah`);

--
-- Indeks untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indeks untuk tabel `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id_report`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indeks untuk tabel `tahun_ajar`
--
ALTER TABLE `tahun_ajar`
  ADD PRIMARY KEY (`id_tahun_ajar`);

--
-- Indeks untuk tabel `wali_kelas`
--
ALTER TABLE `wali_kelas`
  ADD PRIMARY KEY (`id_wali_kelas`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi1`
--
ALTER TABLE `absensi1`
  MODIFY `id_absensi1` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `absensi2`
--
ALTER TABLE `absensi2`
  MODIFY `id_absensi2` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `jadwal_kbm`
--
ALTER TABLE `jadwal_kbm`
  MODIFY `id_jadwal_kbm` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kebutuhan_khusus`
--
ALTER TABLE `kebutuhan_khusus`
  MODIFY `id_kebutuhan_khusus` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kepalah_sekolah`
--
ALTER TABLE `kepalah_sekolah`
  MODIFY `id_kepalah_sekolah` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `report`
--
ALTER TABLE `report`
  MODIFY `id_report` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tahun_ajar`
--
ALTER TABLE `tahun_ajar`
  MODIFY `id_tahun_ajar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `wali_kelas`
--
ALTER TABLE `wali_kelas`
  MODIFY `id_wali_kelas` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
