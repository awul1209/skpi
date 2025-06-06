-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jun 2025 pada 08.58
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skpi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `fakultas`
--

CREATE TABLE `fakultas` (
  `id_fakultas` int(11) NOT NULL,
  `nama_fakultas` varchar(100) NOT NULL,
  `dekan` varchar(100) DEFAULT NULL,
  `kontak` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `fakultas`
--

INSERT INTO `fakultas` (`id_fakultas`, `nama_fakultas`, `dekan`, `kontak`) VALUES
(1, 'Teknik', '-', '0847853935'),
(2, 'Pertanian', 'Putri Wulan', '243255325325');

-- --------------------------------------------------------

--
-- Struktur dari tabel `khp`
--

CREATE TABLE `khp` (
  `id` int(11) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `npm` varchar(15) NOT NULL,
  `nama_b_indo` text NOT NULL,
  `nama_b_inggris` text NOT NULL,
  `tgl_sertifikat` date NOT NULL,
  `no_sertifikat` varchar(255) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `periode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `file` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `khp`
--

INSERT INTO `khp` (`id`, `kode`, `npm`, `nama_b_indo`, `nama_b_inggris`, `tgl_sertifikat`, `no_sertifikat`, `tahun`, `periode`, `created_at`, `updated_at`, `file`, `status`) VALUES
(15, 'WU001', '721520055', 'Pelatihan Komputer 2022, Universitas Wiraraja', 'Pelatihan Komputer 2022, Universitas Wiraraja', '2025-05-16', 'asdf', '2024/2025', 'GANJIL', '2025-05-04 07:19:52', '2025-05-04 07:19:52', '68281d9cc5246.jpg', 'diterima'),
(17, 'OR066', '721520055', 'Workshop Moderasi Beragama &quot;Menelusuri Jalan Moderasi Beragama di Kalangan Mahasiswa Pada Era Digital&quot; 2024', 'Religious Moderation Workshop &quot;Tracing the Way of Religious Moderation among Students in the Digital Era&quot; 2024', '2025-05-01', 'qweuwghd', '2024/2025', 'GENAP', '2025-05-04 12:10:10', '2025-05-04 12:10:10', '6817592225107.png', 'diterima'),
(21, 'WU001', '7230520014', 'PKKMB Sertifikat', 'Certifacate PKKMB', '2025-06-01', '23453453', '2025/2026', 'GANJIL', '2025-06-05 04:56:29', '2025-06-05 04:56:29', '6841237dac486.jpg', 'diterima');

-- --------------------------------------------------------

--
-- Struktur dari tabel `krp`
--

CREATE TABLE `krp` (
  `id` int(11) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bobot` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `krp`
--

INSERT INTO `krp` (`id`, `kode`, `nama`, `bobot`, `kategori`) VALUES
(1, 'WU001', 'PKKMB (Peserta)', 25, 'Wajib Universitas'),
(2, 'WU002', 'Dies Natalies (Peserta)', 10, 'Wajib Universitas'),
(3, 'OR001', 'Pengurus Organisasi Tingkat Internasional (Ketua)', 80, 'Organisasi dan Kepemimpinan'),
(4, 'OR002', 'Pengurus Organisasi Tingkat Internasional (Wakil Ketua)', 70, 'Organisasi dan Kepemimpinan'),
(5, 'OR003', 'Pengurus Organisasi Tingkat Internasional (Sekretaris)', 60, 'Organisasi dan Kepemimpinan'),
(6, 'OR004', 'Pengurus Organisasi Tingkat Internasional (Pengurus inti lainnya)', 50, 'Organisasi dan Kepemimpinan'),
(7, 'OR005', 'Pengurus Organisasi Tingkat Internasional (Anggota Pengurus)', 30, 'Organisasi dan Kepemimpinan'),
(8, 'OR006', 'Pengurus Organisasi Tingkat Nasional (Ketua)', 60, 'Organisasi dan Kepemimpinan'),
(9, 'OR007', 'Pengurus Organisasi Tingkat Nasional (Wakil Ketua)', 50, 'Organisasi dan Kepemimpinan'),
(10, 'OR008', 'Pengurus Organisasi Tingkat Nasional (Sekretaris)', 40, 'Organisasi dan Kepemimpinan'),
(11, 'OR009', 'Pengurus Organisasi Tingkat Nasional (Pengurus inti lainnya)', 30, 'Organisasi dan Kepemimpinan'),
(12, 'OR010', 'Pengurus Organisasi Tingkat Nasional (Anggota Pengurus)', 20, 'Organisasi dan Kepemimpinan'),
(13, 'OR011', 'Pengurus Organisasi Tingkat Regional (Ketua)', 55, 'Organisasi dan Kepemimpinan'),
(14, 'OR012', 'Pengurus Organisasi Tingkat Regional (Wakil Ketua)', 45, 'Organisasi dan Kepemimpinan'),
(15, 'OR013', 'Pengurus Organisasi Tingkat Regional (Sekretaris)', 35, 'Organisasi dan Kepemimpinan'),
(16, 'OR014', 'Pengurus Organisasi Tingkat Regional (Pengurus inti lainnya)', 25, 'Organisasi dan Kepemimpinan'),
(17, 'OR015', 'Pengurus Organisasi Tingkat Regional (Anggota Pengurus)', 15, 'Organisasi dan Kepemimpinan'),
(18, 'OR016', 'Pengurus Organisasi Tingkat Lokal (Ketua)', 50, 'Organisasi dan Kepemimpinan'),
(19, 'OR017', 'Pengurus Organisasi Tingkat Lokal (Wakil Ketua)', 40, 'Organisasi dan Kepemimpinan'),
(20, 'OR018', 'Pengurus Organisasi Tingkat Lokal (Sekretaris)', 30, 'Organisasi dan Kepemimpinan'),
(21, 'OR019', 'Pengurus Organisasi Tingkat Lokal (Pengurus inti lainnya)', 20, 'Organisasi dan Kepemimpinan'),
(22, 'OR020', 'Pengurus Organisasi Tingkat Lokal (Anggota Pengurus)', 10, 'Organisasi dan Kepemimpinan'),
(23, 'OR021', 'Pengurus Organisasi Tingkat Universitas (Ketua)', 40, 'Organisasi dan Kepemimpinan'),
(24, 'OR022', 'Pengurus Organisasi Tingkat Universitas (Wakil Ketua)', 30, 'Organisasi dan Kepemimpinan'),
(25, 'OR023', 'Pengurus Organisasi Tingkat Universitas (Sekretaris)', 25, 'Organisasi dan Kepemimpinan'),
(26, 'OR024', 'Pengurus Organisasi Tingkat Universitas (Pengurus inti lainnya)', 15, 'Organisasi dan Kepemimpinan'),
(27, 'OR025', 'Pengurus Organisasi Tingkat Universitas (Anggota Pengurus)', 10, 'Organisasi dan Kepemimpinan'),
(28, 'OR026', 'Pengurus Organisasi Tingkat Fakultas (Ketua)', 30, 'Organisasi dan Kepemimpinan'),
(29, 'OR027', 'Pengurus Organisasi Tingkat Fakultas (Wakil Ketua)', 25, 'Organisasi dan Kepemimpinan'),
(30, 'OR028', 'Pengurus Organisasi Tingkat Fakultas (Sekretaris)', 20, 'Organisasi dan Kepemimpinan'),
(31, 'OR029', 'Pengurus Organisasi Tingkat Fakultas (Pengurus inti lainnya)', 10, 'Organisasi dan Kepemimpinan'),
(32, 'OR030', 'Pengurus Organisasi Tingkat Fakultas (Anggota Pengurus)', 5, 'Organisasi dan Kepemimpinan'),
(33, 'OR031', 'Pengurus Organisasi Tingkat Program Studi (Ketua)', 20, 'Organisasi dan Kepemimpinan'),
(34, 'OR032', 'Pengurus Organisasi Tingkat Program Studi (Wakil Ketua)', 15, 'Organisasi dan Kepemimpinan'),
(35, 'OR033', 'Pengurus Organisasi Tingkat Program Studi (Sekretaris)', 10, 'Organisasi dan Kepemimpinan'),
(36, 'OR034', 'Pengurus Organisasi Tingkat Program Studi (Pengurus inti lainnya)', 6, 'Organisasi dan Kepemimpinan'),
(37, 'OR035', 'Pengurus Organisasi Tingkat Program Studi (Anggota Pengurus)', 3, 'Organisasi dan Kepemimpinan'),
(38, 'OR036', 'Pengurus Organisasi Tingkat UKM (Ketua)', 30, 'Organisasi dan Kepemimpinan'),
(39, 'OR037', 'Pengurus Organisasi Tingkat UKM (Wakil Ketua)', 25, 'Organisasi dan Kepemimpinan'),
(40, 'OR038', 'Pengurus Organisasi Tingkat UKM (Sekretaris)', 20, 'Organisasi dan Kepemimpinan'),
(41, 'OR039', 'Pengurus Organisasi Tingkat UKM (Pengurus inti lainnya)', 10, 'Organisasi dan Kepemimpinan'),
(42, 'OR040', 'Pengurus Organisasi Tingkat UKM (Anggota Pengurus)', 5, 'Organisasi dan Kepemimpinan'),
(43, 'OR041', 'Anggota Aktif Organisasi Tingkat Internasional', 20, 'Organisasi dan Kepemimpinan'),
(44, 'OR042', 'Anggota Aktif Organisasi Tingkat Nasional', 15, 'Organisasi dan Kepemimpinan'),
(45, 'OR043', 'Anggota Aktif Organisasi Tingkat Regional', 10, 'Organisasi dan Kepemimpinan'),
(46, 'OR044', 'Anggota Aktif Organisasi Tingkat Lokal', 6, 'Organisasi dan Kepemimpinan'),
(47, 'OR045', 'Anggota Aktif Organisasi Tingkat Universitas', 5, 'Organisasi dan Kepemimpinan'),
(48, 'OR046', 'Anggota Aktif Organisasi Tingkat Fakultas', 3, 'Organisasi dan Kepemimpinan'),
(49, 'OR047', 'Anggota Aktif Organisasi Tingkat Program Studi', 2, 'Organisasi dan Kepemimpinan'),
(50, 'OR048', 'Anggota Aktif Organisasi Tingkat Lainnya', 1, 'Organisasi dan Kepemimpinan'),
(51, 'OR049', 'Mengikuti pelatihan kepemimpinan (LDK) Universitas Wiraraja Tingkat Lanjut', 20, 'Organisasi dan Kepemimpinan'),
(52, 'OR050', 'Mengikuti pelatihan kepemimpinan (LDK) Universitas Wiraraja Tingkat Menengah', 15, 'Organisasi dan Kepemimpinan'),
(53, 'OR051', 'Mengikuti pelatihan kepemimpinan (LDK) Universitas Wiraraja Tingkat Dasar', 10, 'Organisasi dan Kepemimpinan'),
(54, 'OR052', 'Latihan kepemimpinan lainnya Tingkat', 10, 'Organisasi dan Kepemimpinan'),
(55, 'OR053', 'Panitia dalam suatu kegiatan kemahasiswaan Tingkat Internasional', 20, 'Organisasi dan Kepemimpinan'),
(56, 'OR054', 'Panitia dalam suatu kegiatan kemahasiswaan Tingkat Nasional', 15, 'Organisasi dan Kepemimpinan'),
(57, 'OR055', 'Panitia dalam suatu kegiatan kemahasiswaan Tingkat Regional', 13, 'Organisasi dan Kepemimpinan'),
(58, 'OR056', 'Panitia dalam suatu kegiatan kemahasiswaan Tingkat Lokal', 10, 'Organisasi dan Kepemimpinan'),
(59, 'OR057', 'Panitia dalam suatu kegiatan kemahasiswaan Tingkat Universitas', 10, 'Organisasi dan Kepemimpinan'),
(60, 'OR058', 'Panitia dalam suatu kegiatan kemahasiswaan Tingkat Fakultas', 5, 'Organisasi dan Kepemimpinan'),
(61, 'OR059', 'Panitia dalam suatu kegiatan kemahasiswaan Tingkat Program Studi', 3, 'Organisasi dan Kepemimpinan'),
(62, 'OR060', 'Mencalonkan diri sebagai calon ketua /anggota organisasi mahasiswa (Universitas)', 15, 'Organisasi dan Kepemimpinan'),
(63, 'OR061', 'Mencalonkan diri sebagai calon ketua /anggota organisasi mahasiswa (Fakultas)', 10, 'Organisasi dan Kepemimpinan'),
(64, 'OR062', 'Mencalonkan diri sebagai calon ketua /anggota organisasi mahasiswa(Program Studi)', 5, 'Organisasi dan Kepemimpinan'),
(65, 'OR063', 'Berpartisipasi dalam pemilihan ormawa (Universitas)', 7, 'Organisasi dan Kepemimpinan'),
(66, 'OR064', 'Berpartisipasi dalam pemilihan ormawa (Fakultas)', 5, 'Organisasi dan Kepemimpinan'),
(67, 'OR065', 'Berpartisipasi dalam pemilihan ormawa (Program Studi)', 3, 'Organisasi dan Kepemimpinan'),
(68, 'OR066', 'Terlibat dalam Laboratorium Fakultas Ekonomi dan Bisnis (Pengurus Harian)', 5, 'Organisasi dan Kepemimpinan'),
(69, 'OR067', 'Terlibat dalam Laboratorium Fakultas Ekonomi dan Bisnis (Anggota Lab)', 3, 'Organisasi dan Kepemimpinan'),
(70, 'OR068', 'Terlibat dalam Laboratorium Fakultas Ekonomi dan Bisnis (Nasabah BPRS Mini Bank)', 3, 'Organisasi dan Kepemimpinan'),
(71, 'OR069', 'Terlibat dalam Laboratorium Fakultas Ekonomi dan Bisnis - Akun Saham (GIS BEI)', 3, 'Organisasi dan Kepemimpinan'),
(72, 'OR070', 'Terlibat dalam Laboratorium Fakultas Ekonomi dan Bisnis - Relawan Pajak', 3, 'Organisasi dan Kepemimpinan'),
(73, 'PI001', 'Lomba karya Tulis Ilmiah Tingkat Internasional (Juara I)', 120, 'Penalaran dan Keilmuan'),
(74, 'PI002', 'Lomba karya Tulis Ilmiah Tingkat Internasional (Juara II)', 110, 'Penalaran dan Keilmuan'),
(75, 'PI003', 'Lomba karya Tulis Ilmiah Tingkat Internasional (Juara III)', 100, 'Penalaran dan Keilmuan'),
(76, 'PI004', 'Lomba karya Tulis Ilmiah Tingkat Internasional (Finalis)', 90, 'Penalaran dan Keilmuan'),
(77, 'PI005', 'Lomba karya Tulis Ilmiah Tingkat Internasional (Peserta terpilih)', 60, 'Penalaran dan Keilmuan'),
(78, 'PI006', 'Lomba karya Tulis Ilmiah Tingkat Nasional (Juara I)', 100, 'Penalaran dan Keilmuan'),
(79, 'PI007', 'Lomba karya Tulis Ilmiah Tingkat Nasional (Juara II)', 90, 'Penalaran dan Keilmuan'),
(80, 'PI008', 'Lomba karya Tulis Ilmiah Tingkat Nasional (Juara III)', 80, 'Penalaran dan Keilmuan'),
(81, 'PI009', 'Lomba karya Tulis Ilmiah Tingkat Nasional (Finalis)', 70, 'Penalaran dan Keilmuan'),
(82, 'PI010', 'Lomba karya Tulis Ilmiah Tingkat Nasional (Peserta terpilih)', 50, 'Penalaran dan Keilmuan'),
(83, 'PI011', 'Lomba karya Tulis Ilmiah Tingkat Regional (Juara I)', 70, 'Penalaran dan Keilmuan'),
(84, 'PI012', 'Lomba karya Tulis Ilmiah Tingkat Regional (Juara II)', 60, 'Penalaran dan Keilmuan'),
(85, 'PI013', 'Lomba karya Tulis Ilmiah Tingkat Regional (Juara III)', 50, 'Penalaran dan Keilmuan'),
(86, 'PI014', 'Lomba karya Tulis Ilmiah Tingkat Regional (Finalis)', 40, 'Penalaran dan Keilmuan'),
(87, 'PI015', 'Lomba karya Tulis Ilmiah Tingkat Regional (Peserta terpilih)', 30, 'Penalaran dan Keilmuan'),
(88, 'PI016', 'Lomba karya Tulis Ilmiah Tingkat Lokal (Juara I)', 60, 'Penalaran dan Keilmuan'),
(89, 'PI017', 'Lomba karya Tulis Ilmiah Tingkat Lokal (Juara II)', 50, 'Penalaran dan Keilmuan'),
(90, 'PI018', 'Lomba karya Tulis Ilmiah Tingkat Lokal (Juara III)', 40, 'Penalaran dan Keilmuan'),
(91, 'PI019', 'Lomba karya Tulis Ilmiah Tingkat Lokal (Finalis)', 30, 'Penalaran dan Keilmuan'),
(92, 'PI020', 'Lomba karya Tulis Ilmiah Tingkat Lokal (Peserta terpilih)', 20, 'Penalaran dan Keilmuan'),
(93, 'PI021', 'Lomba karya Tulis Ilmiah Tingkat Universitas (Juara I)', 50, 'Penalaran dan Keilmuan'),
(94, 'PI022', 'Lomba karya Tulis Ilmiah Tingkat Universitas (Juara II)', 45, 'Penalaran dan Keilmuan'),
(95, 'PI023', 'Lomba karya Tulis Ilmiah Tingkat Universitas (Juara III)', 40, 'Penalaran dan Keilmuan'),
(96, 'PI024', 'Lomba karya Tulis Ilmiah Tingkat Universitas (Finalis)', 30, 'Penalaran dan Keilmuan'),
(97, 'PI025', 'Lomba karya Tulis Ilmiah Tingkat Universitas (Peserta terpilih)', 20, 'Penalaran dan Keilmuan'),
(98, 'PI026', 'Lomba karya Tulis Ilmiah Tingkat Fakultas (Juara I)', 30, 'Penalaran dan Keilmuan'),
(99, 'PI027', 'Lomba karya Tulis Ilmiah Tingkat Fakultas (Juara II)', 28, 'Penalaran dan Keilmuan'),
(100, 'PI028', 'Lomba karya Tulis Ilmiah Tingkat Fakultas (Juara III)', 25, 'Penalaran dan Keilmuan'),
(101, 'PI029', 'Lomba karya Tulis Ilmiah Tingkat Fakultas (Finalis)', 20, 'Penalaran dan Keilmuan'),
(102, 'PI030', 'Lomba karya Tulis Ilmiah Tingkat Fakultas (Peserta terpilih)', 15, 'Penalaran dan Keilmuan'),
(103, 'PI031', 'Lomba karya Tulis Ilmiah Tingkat Program Studi (Juara I)', 15, 'Penalaran dan Keilmuan'),
(104, 'PI032', 'Lomba karya Tulis Ilmiah Tingkat Program Studi (Juara II)', 12, 'Penalaran dan Keilmuan'),
(105, 'PI033', 'Lomba karya Tulis Ilmiah Tingkat Program Studi (Juara III)', 10, 'Penalaran dan Keilmuan'),
(106, 'PI034', 'Lomba karya Tulis Ilmiah Tingkat Program Studi (Finalis)', 8, 'Penalaran dan Keilmuan'),
(107, 'PI035', 'Lomba karya Tulis Ilmiah Tingkat Program Studi (Peserta terpilih)', 5, 'Penalaran dan Keilmuan'),
(108, 'PI036', 'Mengikuti kegiatan lomba ilmiah Tingkat Internasional', 50, 'Penalaran dan Keilmuan'),
(109, 'PI037', 'Mengikuti kegiatan lomba ilmiah Tingkat Nasional', 40, 'Penalaran dan Keilmuan'),
(110, 'PI038', 'Mengikuti kegiatan lomba ilmiah Tingkat Regional', 30, 'Penalaran dan Keilmuan'),
(111, 'PI039', 'Mengikuti kegiatan lomba ilmiah Tingkat Lokal', 25, 'Penalaran dan Keilmuan'),
(112, 'PI040', 'Mengikuti kegiatan lomba ilmiah Tingkat Universitas', 20, 'Penalaran dan Keilmuan'),
(113, 'PI041', 'Mengikuti kegiatan lomba ilmiah Tingkat Fakultas', 15, 'Penalaran dan Keilmuan'),
(114, 'PI042', 'Mengikuti kegiatan lomba ilmiah Tingkat Prodi', 10, 'Penalaran dan Keilmuan'),
(115, 'PI043', 'Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Internasional (Pembicara)', 100, 'Penalaran dan Keilmuan'),
(116, 'PI044', 'Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Internasional (Moderator)', 50, 'Penalaran dan Keilmuan'),
(117, 'PI045', 'Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Internasional (Peserta)', 25, 'Penalaran dan Keilmuan'),
(118, 'PI046', 'Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Nasional (Pembicara)', 60, 'Penalaran dan Keilmuan'),
(119, 'PI047', 'Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Nasional (Moderator)', 30, 'Penalaran dan Keilmuan'),
(120, 'PI048', 'Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Nasional (Peserta)', 15, 'Penalaran dan Keilmuan'),
(121, 'PI049', 'Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Regional (Pembicara)', 50, 'Penalaran dan Keilmuan'),
(122, 'PI050', 'Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Regional (Moderator)', 20, 'Penalaran dan Keilmuan'),
(123, 'PI051', 'Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Regional (Peserta)', 10, 'Penalaran dan Keilmuan'),
(124, 'PI052', 'Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Lokal (Pembicara)', 40, 'Penalaran dan Keilmuan'),
(125, 'PI053', 'Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Lokal (Moderator)', 15, 'Penalaran dan Keilmuan'),
(126, 'PI054', 'Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Lokal (Peserta)', 10, 'Penalaran dan Keilmuan'),
(127, 'PI055', 'Mengikuti kegiatan / forum ilmiah (seminar, lokakarya, workshop, pameran) Tingkat Universitas (Pembicara)', 30, 'Penalaran dan Keilmuan'),
(128, 'PI056', 'kegiatan / forum ilmiah Tingkat Universitas (Moderator)', 10, 'Penalaran dan Keilmuan'),
(129, 'PI057', 'kegiatan / forum ilmiah Tingkat Universitas (Peserta)', 8, 'Penalaran dan Keilmuan'),
(130, 'PI058', 'kegiatan / forum ilmiah Tingkat Fakultas (Pembicara)', 20, 'Penalaran dan Keilmuan'),
(131, 'PI059', 'kegiatan / forum ilmiah Tingkat Fakultas (Moderator)', 10, 'Penalaran dan Keilmuan'),
(132, 'PI060', 'kegiatan / forum ilmiah Tingkat Fakultas (Peserta)', 5, 'Penalaran dan Keilmuan'),
(133, 'PI061', 'kegiatan / forum ilmiah Tingkat Program Studi (Pembicara)', 10, 'Penalaran dan Keilmuan'),
(134, 'PI062', 'kegiatan / forum ilmiah Tingkat Program Studi (Moderator)', 5, 'Penalaran dan Keilmuan'),
(135, 'PI063', 'kegiatan / forum ilmiah Tingkat Program Studi (Peserta)', 3, 'Penalaran dan Keilmuan'),
(136, 'PI064', 'Menghasilkan temuan inovasi yang dipatenkan', 100, 'Penalaran dan Keilmuan'),
(137, 'PI065', 'Menghasilkan karya ilmiah yang dipublikasikan dalam majalah ilmiah Tingkat Internasional (Ketua)', 100, 'Penalaran dan Keilmuan'),
(138, 'PI066', 'Menghasilkan karya ilmiah yang dipublikasikan dalam majalah ilmiah Tingkat Internasional (Anggota)', 50, 'Penalaran dan Keilmuan'),
(139, 'PI067', 'Menghasilkan karya ilmiah yang dipublikasikan dalam majalah ilmiah Tingkat Nasional-Akreditasi (Ketua)', 75, 'Penalaran dan Keilmuan'),
(140, 'PI068', 'Menghasilkan karya ilmiah yang dipublikasikan dalam majalah ilmiah Tingkat Nasional-Akreditasi (Anggota)', 35, 'Penalaran dan Keilmuan'),
(141, 'PI069', 'Menghasilkan karya ilmiah yang dipublikasikan dalam majalah ilmiah Tingkat Nasional (Ketua)', 30, 'Penalaran dan Keilmuan'),
(142, 'PI070', 'Menghasilkan karya ilmiah yang dipublikasikan dalam majalah ilmiah Tingkat Nasional (Anggota)', 15, 'Penalaran dan Keilmuan'),
(143, 'PI071', 'Menghasilkan karya populer yang diterbitkan di surat kabar/majalah/media lainnya Tingkat Internasional (Ketua)', 40, 'Penalaran dan Keilmuan'),
(144, 'PI072', 'Menghasilkan karya populer yang diterbitkan di surat kabar/majalah/media lainnya Tingkat Internasional (Anggota)', 20, 'Penalaran dan Keilmuan'),
(145, 'PI073', 'Menghasilkan karya populer yang diterbitkan di surat kabar/majalah/media lainnya Tingkat Nasional (Ketua)', 30, 'Penalaran dan Keilmuan'),
(146, 'PI074', 'Menghasilkan karya populer yang diterbitkan di surat kabar/majalah/media lainnya Tingkat Nasional (Anggota)', 15, 'Penalaran dan Keilmuan'),
(147, 'PI075', 'Menghasilkan karya populer yang diterbitkan di surat kabar/majalah/media lainnya Tingkat Regional (Ketua)', 20, 'Penalaran dan Keilmuan'),
(148, 'PI076', 'Menghasilkan karya populer yang diterbitkan di surat kabar/majalah/media lainnya Tingkat Regional (Anggota)', 10, 'Penalaran dan Keilmuan'),
(149, 'PI077', 'Menghasilkan karya populer yang diterbitkan di surat kabar/majalah/media lainnya Tingkat Lokal (Ketua)', 15, 'Penalaran dan Keilmuan'),
(150, 'PI078', 'Menghasilkan karya populer yang diterbitkan di surat kabar/majalah/media lainnya Tingkat Lokal (Anggota)', 7, 'Penalaran dan Keilmuan'),
(151, 'PI079', 'Menghasilkan karya populer yang diterbitkan di surat kabar/majalah/media lainnya Tingkat Universitas (Ketua)', 10, 'Penalaran dan Keilmuan'),
(152, 'PI080', 'Menghasilkan karya populer yang diterbitkan di surat kabar/majalah/media lainnya Tingkat Universitas (Anggota)', 5, 'Penalaran dan Keilmuan'),
(153, 'PI081', 'Menghasilkan karya yang didanai oleh pemerintah/pihak lain Tingkat (Ketua)', 15, 'Penalaran dan Keilmuan'),
(154, 'PI082', 'Menghasilkan karya yang didanai oleh pemerintah/pihak lain Tingkat (Anggota)', 7, 'Penalaran dan Keilmuan'),
(155, 'PI083', 'Memberikan pelatihan/bimbingan dalam penyusunan karya tulis', 15, 'Penalaran dan Keilmuan'),
(156, 'PI084', 'Aktif membantu kegiatan laboratorium Tingkat Universitas', 15, 'Penalaran dan Keilmuan'),
(157, 'PI085', 'Aktif membantu kegiatan laboratorium Tingkat Fakultas', 10, 'Penalaran dan Keilmuan'),
(158, 'PI086', 'Mengikuti kuliah tamu', 3, 'Penalaran dan Keilmuan'),
(159, 'PI087', 'Terlibat dalam penelitian pihak lain', 10, 'Penalaran dan Keilmuan'),
(160, 'PI088', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Internasional (Juara I)', 100, 'Penalaran dan Keilmuan'),
(161, 'PI089', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Internasional (Juara II)', 90, 'Penalaran dan Keilmuan'),
(162, 'PI090', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Internasional (Juara III)', 80, 'Penalaran dan Keilmuan'),
(163, 'PI091', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Internasional (Finalis)', 70, 'Penalaran dan Keilmuan'),
(164, 'PI092', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Internasional (Peserta terpilih)', 50, 'Penalaran dan Keilmuan'),
(165, 'PI093', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Nasional (Juara I)', 80, 'Penalaran dan Keilmuan'),
(166, 'PI094', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Nasional (Juara II)', 70, 'Penalaran dan Keilmuan'),
(167, 'PI095', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Nasional (Juara III)', 60, 'Penalaran dan Keilmuan'),
(168, 'PI096', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Nasional (Finalis)', 50, 'Penalaran dan Keilmuan'),
(169, 'PI097', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Nasional (Peserta terpilih)', 30, 'Penalaran dan Keilmuan'),
(170, 'PI098', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Regional (Juara I)', 60, 'Penalaran dan Keilmuan'),
(171, 'PI099', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Regional (Juara II)', 50, 'Penalaran dan Keilmuan'),
(172, 'PI100', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Regional (Juara III)', 40, 'Penalaran dan Keilmuan'),
(173, 'PI101', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Regional (Finalis)', 30, 'Penalaran dan Keilmuan'),
(174, 'PI102', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Regional (Peserta terpilih)', 10, 'Penalaran dan Keilmuan'),
(175, 'PI103', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Universitas (Juara I)', 40, 'Penalaran dan Keilmuan'),
(176, 'PI104', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Universitas (Juara II)', 30, 'Penalaran dan Keilmuan'),
(177, 'PI105', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Universitas (Juara III)', 20, 'Penalaran dan Keilmuan'),
(178, 'PI106', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Universitas (Finalis)', 10, 'Penalaran dan Keilmuan'),
(179, 'PI107', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Universitas (Peserta terpilih)', 5, 'Penalaran dan Keilmuan'),
(180, 'PI108', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Fakultas (Juara I)', 20, 'Penalaran dan Keilmuan'),
(181, 'PI109', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Fakultas (Juara II)', 10, 'Penalaran dan Keilmuan'),
(182, 'PI110', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Fakultas (Juara III)', 10, 'Penalaran dan Keilmuan'),
(183, 'PI111', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Fakultas (Finalis)', 5, 'Penalaran dan Keilmuan'),
(184, 'PI112', 'PILMAPRES dan kompetisi lain yang diadakan oleh RISTEKDIKTI Tingkat Fakultas (Peserta terpilih)', 3, 'Penalaran dan Keilmuan'),
(185, 'PI113', 'Program Kreatifitas Mahasiswa (PKM) Tingkat (Proposal Lolos Seleksi Universitas)', 10, 'Penalaran dan Keilmuan'),
(186, 'PI114', 'Program Kreatifitas Mahasiswa (PKM) Tingkat (Proposal diajukan)', 5, 'Penalaran dan Keilmuan'),
(187, 'PI115', 'Pelatihan Keahlian (Pelatihan Bahasa Inggris - Peserta)', 25, 'Penalaran dan Keilmuan'),
(188, 'PI116', 'Pelatihan Keahlian (Pelatihan Komputer - Peserta)', 25, 'Penalaran dan Keilmuan'),
(189, 'PI117', 'Tes Uji Kopetensi Akademik Tingkat (Peserta)', 15, 'Penalaran dan Keilmuan'),
(190, 'PI118', 'Tes Uji Kopetensi Akademik Tingkat (Panitia)', 5, 'Penalaran dan Keilmuan'),
(191, 'PI119', 'Kampus Mengajar (LLDIKTI)', 50, 'Penalaran dan Keilmuan'),
(192, 'PI120', 'Magang Mandiri', 25, 'Penalaran dan Keilmuan'),
(193, 'MB001', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Internasional (Juara I)', 100, 'Minat dan Bakat'),
(194, 'MB002', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Internasional (Juara II)', 90, 'Minat dan Bakat'),
(195, 'MB003', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Internasional (Juara III)', 80, 'Minat dan Bakat'),
(196, 'MB004', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Internasional (Finalis)', 70, 'Minat dan Bakat'),
(197, 'MB005', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Internasional (Peserta terpilih)', 50, 'Minat dan Bakat'),
(198, 'MB006', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Nasional (Juara I)', 80, 'Minat dan Bakat'),
(199, 'MB007', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Nasional (Juara II)', 70, 'Minat dan Bakat'),
(200, 'MB008', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Nasional (Juara III)', 60, 'Minat dan Bakat'),
(201, 'MB009', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Nasional (Finalis)', 50, 'Minat dan Bakat'),
(202, 'MB010', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Nasional (Peserta terpilih)', 30, 'Minat dan Bakat'),
(203, 'MB011', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Regional (Juara I)', 60, 'Minat dan Bakat'),
(204, 'MB012', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Regional (Juara II)', 50, 'Minat dan Bakat'),
(205, 'MB013', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Regional (Juara III)', 40, 'Minat dan Bakat'),
(206, 'MB014', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Regional (Finalis)', 30, 'Minat dan Bakat'),
(207, 'MB015', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Regional (Peserta terpilih)', 15, 'Minat dan Bakat'),
(208, 'MB016', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Lokal (Juara I)', 50, 'Minat dan Bakat'),
(209, 'MB017', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Lokal (Juara II)', 40, 'Minat dan Bakat'),
(210, 'MB018', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Lokal (Juara III)', 30, 'Minat dan Bakat'),
(211, 'MB019', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Lokal (Finalis)', 20, 'Minat dan Bakat'),
(212, 'MB020', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Lokal (Peserta terpilih)', 10, 'Minat dan Bakat'),
(213, 'MB021', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Universitas (Juara I)', 40, 'Minat dan Bakat'),
(214, 'MB022', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Universitas (Juara II)', 30, 'Minat dan Bakat'),
(215, 'MB023', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Universitas (Juara III)', 20, 'Minat dan Bakat'),
(216, 'MB024', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Universitas (Finalis)', 10, 'Minat dan Bakat'),
(217, 'MB025', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Universitas (Peserta terpilih)', 5, 'Minat dan Bakat'),
(218, 'MB026', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Fakultas (Juara I)', 20, 'Minat dan Bakat'),
(219, 'MB027', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Fakultas (Juara II)', 10, 'Minat dan Bakat'),
(220, 'MB028', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Fakultas (Juara III)', 10, 'Minat dan Bakat'),
(221, 'MB029', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Fakultas (Finalis)', 5, 'Minat dan Bakat'),
(222, 'MB030', 'Memperoleh prestasi dalam kegiatan minat dan bakat (Olahraga, seni, dan kerohanian) Tingkat Fakultas (Peserta terpilih)', 3, 'Minat dan Bakat'),
(223, 'MB031', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Internasional (Delegasi)', 50, 'Minat dan Bakat'),
(224, 'MB032', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Internasional (Pelatih)', 50, 'Minat dan Bakat'),
(225, 'MB033', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Internasional (Peserta undangan)', 30, 'Minat dan Bakat'),
(226, 'MB034', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Internasional (Peserta biasa)', 20, 'Minat dan Bakat'),
(227, 'MB035', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Nasional (Delegasi)', 30, 'Minat dan Bakat'),
(228, 'MB036', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Nasional (Pelatih)', 30, 'Minat dan Bakat'),
(229, 'MB037', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Nasional (Peserta undangan)', 20, 'Minat dan Bakat'),
(230, 'MB038', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Nasional (Peserta biasa)', 15, 'Minat dan Bakat'),
(231, 'MB039', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Regional (Delegasi)', 25, 'Minat dan Bakat'),
(232, 'MB040', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Regional (Pelatih)', 25, 'Minat dan Bakat'),
(233, 'MB041', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Regional (Peserta undangan)', 15, 'Minat dan Bakat'),
(234, 'MB042', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Regional (Peserta biasa)', 10, 'Minat dan Bakat'),
(235, 'MB043', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Lokal (Delegasi)', 20, 'Minat dan Bakat'),
(236, 'MB044', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Lokal (Pelatih)', 20, 'Minat dan Bakat'),
(237, 'MB045', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Lokal (Peserta undangan)', 10, 'Minat dan Bakat'),
(238, 'MB046', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Lokal (Peserta biasa)', 7, 'Minat dan Bakat'),
(239, 'MB047', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Universitas (Delegasi)', 15, 'Minat dan Bakat'),
(240, 'MB048', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Universitas (Pelatih)', 15, 'Minat dan Bakat'),
(241, 'MB049', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Universitas (Peserta undangan)', 7, 'Minat dan Bakat'),
(242, 'MB050', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Universitas (Peserta biasa)', 5, 'Minat dan Bakat'),
(243, 'MB051', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Fakultas (Delegasi)', 10, 'Minat dan Bakat'),
(244, 'MB052', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Fakultas (Pelatih)', 10, 'Minat dan Bakat'),
(245, 'MB053', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Fakultas (Peserta undangan)', 5, 'Minat dan Bakat'),
(246, 'MB054', 'Mengikuti kegiatan minat dan bakat (olahraga, seni dan kerohanian) Tingkat Fakultas (Peserta biasa)', 3, 'Minat dan Bakat'),
(247, 'MB055', 'Melaksanakan kegiatan minat dan bakat Tingkat Internasional', 20, 'Minat dan Bakat'),
(248, 'MB056', 'Melaksanakan kegiatan minat dan bakat Tingkat Nasional', 12, 'Minat dan Bakat'),
(249, 'MB057', 'Melaksanakan kegiatan minat dan bakat Tingkat Regional', 10, 'Minat dan Bakat'),
(250, 'MB058', 'Melaksanakan kegiatan minat dan bakat Tingkat Lokal', 7, 'Minat dan Bakat'),
(251, 'MB059', 'Melaksanakan kegiatan minat dan bakat Tingkat Universitas', 5, 'Minat dan Bakat'),
(252, 'MB060', 'Melaksanakan kegiatan minat dan bakat Tingkat Fakultas', 3, 'Minat dan Bakat'),
(253, 'MB061', 'Melaksanakan latihan gabungan Tingkat', 15, 'Minat dan Bakat'),
(254, 'MB062', 'Melaksanakan aktivitas rutin berkaitan dengan kegiatan minat dan bakat yang diselenggarakan UKM Tingkat', 15, 'Minat dan Bakat'),
(255, 'MB063', 'Menjadi mitra tanding pada kegiatan minat dan bakat Tingkat', 15, 'Minat dan Bakat'),
(256, 'MB064', 'Menghasilkan karya seni (konser, pameran seni, puisi, fotografi, teater, dll) Tingkat', 40, 'Minat dan Bakat'),
(257, 'MB065', 'Mengelola Kewirausahaan (Mandiri)', 60, 'Minat dan Bakat'),
(258, 'MB066', 'Mengelola Kewirausahaan (Kemitraan)', 50, 'Minat dan Bakat'),
(259, 'MB067', 'Menjadi Pelatih/Pembimbing Kegiatan Minat dan Bakat (Tingkat Nasional)', 30, 'Minat dan Bakat'),
(260, 'MB068', 'Menjadi Pelatih/Pembimbing Kegiatan Minat dan Bakat (Tingkat Lokal)', 20, 'Minat dan Bakat'),
(261, 'MB069', 'Menjadi Pelatih/Pembimbing Kegiatan Minat dan Bakat (Tingkat Universitasl)', 15, 'Minat dan Bakat'),
(262, 'MB070', 'Menjadi Pelatih/Pembimbing Kegiatan Minat dan Bakat (Tingkat Fakultas', 10, 'Minat dan Bakat'),
(263, 'SO001', 'Mengikuti pelaksanaan bakti sosial Tingkat Internasional', 60, 'Sosial dan Lainnya'),
(264, 'SO002', 'Mengikuti pelaksanaan bakti sosial Tingkat Nasional', 50, 'Sosial dan Lainnya'),
(265, 'SO003', 'Mengikuti pelaksanaan bakti sosial Tingkat Regional', 40, 'Sosial dan Lainnya'),
(266, 'SO004', 'Mengikuti pelaksanaan bakti sosial Tingkat Lokal', 35, 'Sosial dan Lainnya'),
(267, 'SO005', 'Mengikuti pelaksanaan bakti sosial Tingkat Universitas', 30, 'Sosial dan Lainnya'),
(268, 'SO006', 'Mengikuti pelaksanaan bakti sosial Tingkat Fakultas', 20, 'Sosial dan Lainnya'),
(269, 'SO007', 'Mengikuti pelaksanaan bakti sosial Tingkat Program Studi', 10, 'Sosial dan Lainnya'),
(270, 'SO008', 'Penanganan Bencana', 50, 'Sosial dan Lainnya'),
(271, 'SO009', 'Kegiatan lain indiviudal/sosial', 10, 'Sosial dan Lainnya'),
(272, 'SO010', 'Mengikuti Bantuan Pembimbingan Rutin (LBB, Pengajian, TPA, PAUD)', 20, 'Sosial dan Lainnya'),
(273, 'SO011', 'Upacara Bendera', 10, 'Sosial dan Lainnya'),
(274, 'SO012', 'Berpartisipasi dalam kegiatan alumni/wisuda', 10, 'Sosial dan Lainnya'),
(275, 'SO013', 'Melakukan kunjungan/studi banding', 10, 'Sosial dan Lainnya'),
(276, 'SO014', 'Magang Kerja (bukan praktik kerja lapangan)', 50, 'Sosial dan Lainnya'),
(277, 'SO015', 'Magang Penelitian', 50, 'Sosial dan Lainnya'),
(278, 'SO016', 'Kegiatan ESQ (Fasilitator)', 15, 'Sosial dan Lainnya'),
(279, 'SO017', 'Kegiatan ESQ (Peserta)', 10, 'Sosial dan Lainnya'),
(280, 'SO018', 'Kegiatan Jati Diri (Fasilitator)', 30, 'Sosial dan Lainnya'),
(281, 'SO019', 'Kegiatan Jati Diri (Peserta)', 10, 'Sosial dan Lainnya'),
(282, 'SO020', 'Kegiatan seminar proposal mahasiswa', 10, 'Sosial dan Lainnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `krp_mhs`
--

CREATE TABLE `krp_mhs` (
  `id` int(11) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `npm` int(11) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `periode` varchar(50) NOT NULL,
  `bobot` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `krp_mhs`
--

INSERT INTO `krp_mhs` (`id`, `kode`, `npm`, `tahun`, `periode`, `bobot`, `created_at`, `updated_at`) VALUES
(12, 'WU002', 721520055, '2025/2026', 'GENAP', 10, '2025-06-05 06:15:18', '2025-06-05 06:15:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mhs` int(11) NOT NULL,
  `npm` varchar(15) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_tlp` varchar(15) DEFAULT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `agama` varchar(20) DEFAULT NULL,
  `biaya` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `skripsi` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `tinggal_bersama` varchar(50) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `prodi_id` int(11) DEFAULT NULL,
  `berat_badan` int(11) DEFAULT NULL,
  `tinggi_badan` int(11) DEFAULT NULL,
  `golongan_darah` varchar(5) DEFAULT NULL,
  `penyakit_diderita` text DEFAULT NULL,
  `saudara_kandung` int(11) DEFAULT NULL,
  `saudara_tiri` int(11) DEFAULT NULL,
  `saudara_angkat` int(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mhs`, `npm`, `nama_lengkap`, `alamat`, `no_tlp`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `agama`, `biaya`, `email`, `skripsi`, `foto`, `tinggal_bersama`, `role_id`, `prodi_id`, `berat_badan`, `tinggi_badan`, `golongan_darah`, `penyakit_diderita`, `saudara_kandung`, `saudara_tiri`, `saudara_angkat`, `password`) VALUES
(1, '721520055', 'PUTRI WULANDARI AISYAH', 'Sumenep Paberasan jawa timur dusun salosa, kecamatan kota, kabupaten sumenep provinsi jawa timur', '087754772100', 'Perempuan', 'Sumenep', '2002-12-08', 'Islam', 'Orang Tua', 'putriwulandariaisyah32@gmail.com', 'Aplikasi Website E-Prestasi Unija', '682928ae9a33f.png', 'Orang Tua', 2, 1, 38, 153, 'A', 'Asma, Amandel, Mag, Darah rendah', 3, 0, 0, '$2y$10$IAOcFxySdjJjSGAMnYb4suhCSgym2u.HGbNBH7ZEnWPNz3wwsA65.'),
(2, '7230520012', 'Muhammad Ayyub', 'Jalan Raya Lenteng Dusun ABC. Desa BCD Kec. Saronggi Kab. Sumenep', '3948389533', 'Laki-Laki', 'Sumenep', '2025-05-18', 'Islam', '-', 'muhammad@gmail.com', '-', '6829b7a3df98e.png', NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$1E5qV2OVav0Hi2VjVO4eSO4TpuvluUbEfIx3/7bQnBZdLcvjpp6PW'),
(5, '7230520013', 'Aisyah', 'Jalan Raya Manding Dusun Salosa Manding Daya', '3435', 'Perempuan', 'Sumenep', NULL, NULL, NULL, NULL, '', '', NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Y5m3M8MX3eQAAeriY7Ju4OaxffwZ8DgtmlPlvtxx.c0rU7sc28Zze'),
(6, '7230520014', 'Suprayitno', 'Jalan Raya Jalan', '2335', 'Laki Laki', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$4i/H3s5Wg/wqMRY2BWOHBORcE9JwluyS3tJIOE3O22TRcDkQnJ9sG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orang_tua`
--

CREATE TABLE `orang_tua` (
  `id_ortu` int(11) NOT NULL,
  `npm` varchar(15) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `pendidikan` varchar(50) DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `jumlah_penghasilan` varchar(255) DEFAULT NULL,
  `hubungan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orang_tua`
--

INSERT INTO `orang_tua` (`id_ortu`, `npm`, `nama`, `no_telp`, `pendidikan`, `pekerjaan`, `jumlah_penghasilan`, `hubungan`) VALUES
(1, '721520055', 'Kacung Arifin', '087819301009', 'Tidak Sekolah', 'Petani', '-', 'Ayah'),
(2, '721520055', 'Busaniati', '081908710755', 'SD', 'Ibu Rumah Tangga', '-', 'Ibu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` int(11) NOT NULL,
  `kode_prodi` varchar(255) NOT NULL,
  `nama_prodi` varchar(100) NOT NULL,
  `jenjang` enum('D1','D3','S1') NOT NULL,
  `akreditasi` enum('Baik','Baik Sekali','Sangat Baik') NOT NULL,
  `fakultas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `kode_prodi`, `nama_prodi`, `jenjang`, `akreditasi`, `fakultas_id`) VALUES
(1, 'IT01', 'Informatika', 'D1', 'Baik', 1),
(2, 'TS01', 'Teknik Sipil', 'D1', 'Baik', 1),
(3, 'SI01', 'Sistem Informasi', 'D1', 'Baik', 1),
(4, 'AGR1', 'Agribisnis', 'S1', 'Baik', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` enum('staff','admin','mahasiswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'staff'),
(2, 'admin'),
(3, 'mahasiswa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('staff','admin','mahasiswa') NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `prodi_id`, `created_at`, `updated_at`) VALUES
(1, 'ayyub', '$2y$10$8e2QDEhhp8Rlr96zxyvL/Ob6EkNIv6LvA36Exjcb.c6fYuSACBsB2', 'staff', 1, '2025-03-04 22:38:44', '2025-03-04 22:38:44'),
(2, 'mahasiswa', '$2y$10$GXtuxhaOFurkSN8LBklccOdCsuh5UGxjnaTTkUJtVUVdm1aqawz1O', 'mahasiswa', 0, '2025-03-05 05:19:14', '2025-03-05 05:19:14'),
(3, 'pertanian', '$2y$10$cWmjnNrpj82YgBfVnxceHeIsrETj5nywnujveyEmHQTv2f6DWesla', 'staff', 4, '2025-05-05 11:01:08', '2025-05-05 11:01:08');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_mhs`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_mhs` (
`nama_wali` varchar(255)
,`pekerjaan_wali` varchar(255)
,`pendidikan_wali` varchar(255)
,`no_telp_wali` tinyint(4)
,`hubungan_wali` varchar(255)
,`penghasilan_wali` varchar(255)
,`mhs_id` int(11)
,`npm` varchar(15)
,`nama_lengkap` varchar(100)
,`nama_prodi` varchar(100)
,`nama_fakultas` varchar(100)
,`alamat` text
,`no_tlp` varchar(15)
,`jenis_kelamin` varchar(10)
,`tempat_lahir` varchar(50)
,`tanggal_lahir` date
,`agama` varchar(20)
,`biaya` varchar(50)
,`email` varchar(100)
,`foto` varchar(255)
,`skripsi` varchar(255)
,`tinggal_bersama` varchar(50)
,`berat_badan` int(11)
,`tinggi_badan` int(11)
,`golongan_darah` varchar(5)
,`penyakit_diderita` text
,`saudara_kandung` int(11)
,`saudara_tiri` int(11)
,`saudara_angkat` int(11)
,`nama_ayah` varchar(100)
,`no_telp_ayah` varchar(15)
,`pendidikan_ayah` varchar(50)
,`pekerjaan_ayah` varchar(100)
,`penghasilan_ayah` varchar(255)
,`nama_ibu` varchar(100)
,`no_telp_ibu` varchar(15)
,`pendidikan_ibu` varchar(50)
,`pekerjaan_ibu` varchar(100)
,`penghasilan_ibu` varchar(255)
,`peran_pengguna` enum('staff','admin','mahasiswa')
,`prodi_id` int(11)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `wali`
--

CREATE TABLE `wali` (
  `id_wali` int(11) NOT NULL,
  `nama_wali` varchar(255) NOT NULL,
  `no_telp_wali` tinyint(4) NOT NULL,
  `pendidikan_wali` varchar(255) NOT NULL,
  `pekerjaan_wali` varchar(255) NOT NULL,
  `penghasilan_wali` varchar(255) NOT NULL,
  `hubungan` varchar(255) NOT NULL,
  `npm` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur untuk view `view_mhs`
--
DROP TABLE IF EXISTS `view_mhs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_mhs`  AS SELECT `w`.`nama_wali` AS `nama_wali`, `w`.`pekerjaan_wali` AS `pekerjaan_wali`, `w`.`pendidikan_wali` AS `pendidikan_wali`, `w`.`no_telp_wali` AS `no_telp_wali`, `w`.`hubungan` AS `hubungan_wali`, `w`.`penghasilan_wali` AS `penghasilan_wali`, `m`.`id_mhs` AS `mhs_id`, `m`.`npm` AS `npm`, `m`.`nama_lengkap` AS `nama_lengkap`, `p`.`nama_prodi` AS `nama_prodi`, `f`.`nama_fakultas` AS `nama_fakultas`, `m`.`alamat` AS `alamat`, `m`.`no_tlp` AS `no_tlp`, `m`.`jenis_kelamin` AS `jenis_kelamin`, `m`.`tempat_lahir` AS `tempat_lahir`, `m`.`tanggal_lahir` AS `tanggal_lahir`, `m`.`agama` AS `agama`, `m`.`biaya` AS `biaya`, `m`.`email` AS `email`, `m`.`foto` AS `foto`, `m`.`skripsi` AS `skripsi`, `m`.`tinggal_bersama` AS `tinggal_bersama`, `m`.`berat_badan` AS `berat_badan`, `m`.`tinggi_badan` AS `tinggi_badan`, `m`.`golongan_darah` AS `golongan_darah`, `m`.`penyakit_diderita` AS `penyakit_diderita`, `m`.`saudara_kandung` AS `saudara_kandung`, `m`.`saudara_tiri` AS `saudara_tiri`, `m`.`saudara_angkat` AS `saudara_angkat`, `ayah`.`nama` AS `nama_ayah`, `ayah`.`no_telp` AS `no_telp_ayah`, `ayah`.`pendidikan` AS `pendidikan_ayah`, `ayah`.`pekerjaan` AS `pekerjaan_ayah`, `ayah`.`jumlah_penghasilan` AS `penghasilan_ayah`, `ibu`.`nama` AS `nama_ibu`, `ibu`.`no_telp` AS `no_telp_ibu`, `ibu`.`pendidikan` AS `pendidikan_ibu`, `ibu`.`pekerjaan` AS `pekerjaan_ibu`, `ibu`.`jumlah_penghasilan` AS `penghasilan_ibu`, `r`.`role` AS `peran_pengguna`, `m`.`prodi_id` AS `prodi_id` FROM ((((((`mahasiswa` `m` left join `prodi` `p` on(`m`.`prodi_id` = `p`.`id_prodi`)) left join `fakultas` `f` on(`p`.`fakultas_id` = `f`.`id_fakultas`)) left join `role` `r` on(`m`.`role_id` = `r`.`id`)) left join `wali` `w` on(`w`.`npm` = `m`.`npm`)) left join `orang_tua` `ayah` on(`m`.`npm` = `ayah`.`npm` and `ayah`.`hubungan` = 'Ayah')) left join `orang_tua` `ibu` on(`m`.`npm` = `ibu`.`npm` and `ibu`.`hubungan` = 'Ibu')) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id_fakultas`),
  ADD UNIQUE KEY `nama_fakultas` (`nama_fakultas`);

--
-- Indeks untuk tabel `khp`
--
ALTER TABLE `khp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `krp`
--
ALTER TABLE `krp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `krp_mhs`
--
ALTER TABLE `krp_mhs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mhs`),
  ADD UNIQUE KEY `npm` (`npm`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `fk_prodi` (`prodi_id`);

--
-- Indeks untuk tabel `orang_tua`
--
ALTER TABLE `orang_tua`
  ADD PRIMARY KEY (`id_ortu`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`),
  ADD KEY `fakultas_id` (`fakultas_id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `wali`
--
ALTER TABLE `wali`
  ADD PRIMARY KEY (`id_wali`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id_fakultas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `khp`
--
ALTER TABLE `khp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `krp`
--
ALTER TABLE `krp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=283;

--
-- AUTO_INCREMENT untuk tabel `krp_mhs`
--
ALTER TABLE `krp_mhs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mhs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `orang_tua`
--
ALTER TABLE `orang_tua`
  MODIFY `id_ortu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `wali`
--
ALTER TABLE `wali`
  MODIFY `id_wali` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `fk_prodi` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id_prodi`) ON DELETE SET NULL,
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD CONSTRAINT `prodi_ibfk_1` FOREIGN KEY (`fakultas_id`) REFERENCES `fakultas` (`id_fakultas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
