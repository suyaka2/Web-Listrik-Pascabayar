-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jul 2025 pada 17.30
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `listrik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id_level` varchar(6) NOT NULL,
  `nama_level` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
('LV001', 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(6) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nomor_kwh` varchar(20) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `id_tarif` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `username`, `password`, `nomor_kwh`, `nama_pelanggan`, `alamat`, `id_tarif`) VALUES
('PLG001', 'qwe', '$2y$10$TImX88.Dpx1Wihzo83Q2U.RMqUnm8yoAGyKL.EnPL2upxRuoHvYF.', '4331', 'adi', 'adada', 'TRF001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` varchar(6) NOT NULL,
  `id_tagihan` varchar(6) NOT NULL,
  `id_pelanggan` varchar(6) NOT NULL,
  `tanggal_pembayaran` datetime NOT NULL,
  `bulan_bayar` date NOT NULL,
  `biaya_admin` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggunaan`
--

CREATE TABLE `penggunaan` (
  `id_penggunaan` varchar(6) NOT NULL,
  `id_pelanggan` varchar(6) NOT NULL,
  `bulan` date NOT NULL,
  `tahun` year(4) NOT NULL,
  `meter_awal` int(11) NOT NULL,
  `meter_akhir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penggunaan`
--

INSERT INTO `penggunaan` (`id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `meter_awal`, `meter_akhir`) VALUES
('PNG001', 'PLG001', '0000-00-00', '2025', 555, 554),
('PNG002', 'PLG001', '0000-00-00', '2025', 555, 554),
('PNG003', 'PLG001', '0000-00-00', '2025', 555, 554),
('PNG004', 'PLG001', '0000-00-00', '2025', 555, 554),
('PNG005', 'PLG001', '0000-00-00', '2025', 555, 554),
('PNG006', 'PLG001', '0000-00-00', '2025', 555, 554),
('PNG007', 'PLG001', '0000-00-00', '2025', 555, 554),
('PNG008', 'PLG001', '0000-00-00', '2025', 555, 554),
('PNG009', 'PLG001', '0000-00-00', '2025', 55, 66),
('PNG010', 'PLG001', '0000-00-00', '2025', 55, 66),
('PNG011', 'PLG001', '0000-00-00', '2025', 55, 66),
('PNG012', 'PLG001', '0000-00-00', '2025', 55, 66),
('PNG013', 'PLG001', '0000-00-00', '2025', 55, 66),
('PNG014', 'PLG001', '0000-00-00', '2025', 22, 22),
('PNG015', 'PLG001', '0000-00-00', '2025', 22, 22);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tagihan`
--

CREATE TABLE `tagihan` (
  `id_tagihan` varchar(6) NOT NULL,
  `id_penggunaan` varchar(6) NOT NULL,
  `id_pelanggan` varchar(6) NOT NULL,
  `bulan` date NOT NULL,
  `tahun` year(4) NOT NULL,
  `jumlah_meter` int(11) NOT NULL,
  `status` enum('Lunas','Belum Lunas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tagihan`
--

INSERT INTO `tagihan` (`id_tagihan`, `id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `jumlah_meter`, `status`) VALUES
('', 'PNG002', 'PLG001', '0000-00-00', '2025', 211, 'Belum Lunas'),
('TGH001', 'PNG002', 'PLG001', '0000-00-00', '2025', -1, 'Belum Lunas'),
('TGH002', 'PNG003', 'PLG001', '0000-00-00', '2025', -1, 'Belum Lunas'),
('TGH003', 'PNG004', 'PLG001', '0000-00-00', '2025', -1, 'Belum Lunas'),
('TGH004', 'PNG005', 'PLG001', '0000-00-00', '2025', -1, 'Belum Lunas'),
('TGH005', 'PNG006', 'PLG001', '0000-00-00', '2025', -1, 'Belum Lunas'),
('TGH006', 'PNG007', 'PLG001', '0000-00-00', '2025', -1, 'Belum Lunas'),
('TGH007', 'PNG008', 'PLG001', '0000-00-00', '2025', -1, 'Belum Lunas'),
('TGH008', 'PNG009', 'PLG001', '0000-00-00', '2025', 11, 'Belum Lunas'),
('TGH009', 'PNG010', 'PLG001', '0000-00-00', '2025', 11, 'Belum Lunas'),
('TGH010', 'PNG011', 'PLG001', '0000-00-00', '2025', 11, 'Belum Lunas'),
('TGH011', 'PNG012', 'PLG001', '0000-00-00', '2025', 11, 'Belum Lunas'),
('TGH012', 'PNG013', 'PLG001', '0000-00-00', '2025', 11, 'Belum Lunas'),
('TGH013', 'PNG014', 'PLG001', '0000-00-00', '2025', 0, 'Belum Lunas'),
('TGH014', 'PNG015', 'PLG001', '0000-00-00', '2025', 0, 'Belum Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tarif`
--

CREATE TABLE `tarif` (
  `id_tarif` varchar(6) NOT NULL,
  `daya` varchar(10) NOT NULL,
  `tarifperkwh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tarif`
--

INSERT INTO `tarif` (`id_tarif`, `daya`, `tarifperkwh`) VALUES
('TRF001', '5000', 344000),
('TRF002', '134', 1344);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` varchar(6) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_admin` varchar(20) NOT NULL,
  `id_level` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_admin`, `id_level`) VALUES
('ADM001', 'adm', '$2y$10$EjLTNYeW8Iff9P7rNtk0QeOqDXIFTppmNE5/zm5HJ2wotwgFpQF6u', 'Admin 1', 'LV001');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD PRIMARY KEY (`id_penggunaan`);

--
-- Indeks untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id_tagihan`);

--
-- Indeks untuk tabel `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
