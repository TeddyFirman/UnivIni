-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Bulan Mei 2021 pada 15.34
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alamat`
--

CREATE TABLE `alamat` (
  `id` int(11) NOT NULL,
  `prov` varchar(50) NOT NULL,
  `kab` varchar(50) NOT NULL,
  `kec` varchar(50) NOT NULL,
  `desa` varchar(50) NOT NULL,
  `jln` varchar(50) NOT NULL,
  `loginid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `alamat`
--

INSERT INTO `alamat` (`id`, `prov`, `kab`, `kec`, `desa`, `jln`, `loginid`) VALUES
(5, 'Jawa Timur', 'Surabaya', 'sby', 'sby', 's y', 7),
(6, 'Jawa Timur', 'Jombang', 'Jombang', 'Jombatan', 'jl.HOS', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `biodata`
--

CREATE TABLE `biodata` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kwn` varchar(50) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `ttl` datetime NOT NULL,
  `agama` varchar(50) NOT NULL,
  `nid` varchar(50) NOT NULL,
  `jalur` varchar(30) NOT NULL,
  `nim` varchar(50) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `jk` varchar(50) NOT NULL,
  `gambar` varchar(50) NOT NULL DEFAULT 'def.png',
  `angkatan` varchar(50) NOT NULL,
  `loginid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `biodata`
--

INSERT INTO `biodata` (`id`, `nama`, `kwn`, `tempat`, `ttl`, `agama`, `nid`, `jalur`, `nim`, `prodi`, `jk`, `gambar`, `angkatan`, `loginid`) VALUES
(21, 'Yusril API', 'Indonesia', 'Surabaya', '1999-12-02 00:00:00', 'Islam', '13243546576', 'SNM', '234564565', 'SI', 'Laki', '60afb7368cfa8.png', '2019', 7),
(22, 'david', 'indo', 'jombang', '2021-05-11 00:00:00', 'islam', '23454656', 'SNM', '1345346', 'Pend TI', 'Laki', '', '2019', 10),
(24, 'Teddy Firman Winarto', 'indo', 'sby', '2021-05-13 00:00:00', 'islam', '213435', 'sbm', '123456', 'pti', 'laki', '60b4dbf91c6fb.jpg', '2019', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `krs`
--

CREATE TABLE `krs` (
  `id` int(11) NOT NULL,
  `semester` int(100) NOT NULL,
  `matkul` varchar(100) NOT NULL,
  `dosen` varchar(100) NOT NULL,
  `loginid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `krs`
--

INSERT INTO `krs` (`id`, `semester`, `matkul`, `dosen`, `loginid`) VALUES
(25, 0, 'pemweb\r\n', '', 0),
(26, 0, 'prodas', '', 0),
(27, 0, 'Pemograman Web', '', 7),
(28, 0, 'Pemograman Basis Data', '', 6),
(29, 0, 'Pemograman Web', 'Ari Kurniawan', 6),
(30, 0, 'Jaringan Komputer', '', 6),
(31, 0, 'Pemograman Basis Data', '', 7),
(32, 0, 'Pemograman Web', '', 6),
(33, 0, 'Pemograman Web', '', 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id`, `email`, `username`, `password`) VALUES
(6, 'teddyfirman902@gmail.com', 'Teddy', '$2y$10$mTEAwxr8z9ahdn5dFlZAz.8ZZvbPAplhY9vFur4sTF4T3Mpvtgeyi'),
(7, 'yusril@gmail.com', 'Yusril', '$2y$10$Bl4f1zN.rfXOo5JSmXbVh.4pDd/4TenUNlMUjBygw6vmt1OY7o3w6'),
(10, 'david@gmail.com', 'david', '$2y$10$hFGUuaH/ekZlVa9bQhJJCugOHAOiH4mJob0HGhdOgg.ojLX8gLEv.'),
(11, 'bima@gmail.com', 'Bima', '$2y$10$a0QGJX.g/0locta5I.gF9ui5FanXH6/QS/Ir1Jbi22o5Y83NES2Gu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sekolah`
--

CREATE TABLE `sekolah` (
  `id` int(11) NOT NULL,
  `prov` varchar(50) NOT NULL,
  `kab` varchar(50) NOT NULL,
  `kec` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `loginid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sekolah`
--

INSERT INTO `sekolah` (`id`, `prov`, `kab`, `kec`, `nama`, `loginid`) VALUES
(13, 'Jatim', 'Surabaya', 'Wonokromo', 'SMKN3 JOMBANG', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `teman`
--

CREATE TABLE `teman` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `teman`
--

INSERT INTO `teman` (`id`, `nama`, `prodi`, `foto`) VALUES
(2, 'Dedy Aufansyah Putra', 'Pendidikan Teknologi Informasi', 'dedy.jpg'),
(3, 'Vira Aditya S P', 'Pendidikan Teknologi Informasi', 'vira.jpg'),
(4, 'Havina Azka Nafilah', 'Pendidikan Teknologi Informasi', 'havina.jpg'),
(5, 'Bima Aditya Anugrah Putra', 'Pendidikan Teknologi Informasi', 'bima.png'),
(6, 'Albertus Dwi Anggara', 'Pendidikan Teknologi Informasi', 'albert.jpg'),
(7, 'M Aaqilah Daffa Yovanka', 'Pendidikan Teknologi Informasi', 'daffa.jpg'),
(8, 'Dava Pratama', 'Pendidikan Teknologi Informasi', 'davaP.jpg'),
(9, 'Ira Nandasyah Wulandari', 'Pendidikan Teknologi Informasi', 'wulan.jpg'),
(10, 'Nilam Setyoningrum', 'Pendidikan Teknologi Informasi', 'nilam.jpg'),
(11, 'Adriansyah Bagus Purwanto', 'Pendidikan Teknologi Informasi', 'adrian.jpg'),
(12, 'Faisal Dwi Priatna', 'Pendidikan Teknologi Informasi', 'faisal.jpg'),
(13, 'Nanda Ajeng Listia', 'Pendidikan Teknologi Informasi', 'nanda.jpg'),
(14, 'Fatahriza Aulia Ramadhani', 'Pendidikan Teknologi Informasi', 'fatahriza.jpg'),
(15, 'Teddy Firman Winarto', 'Pendidikan Teknologi Informasi', 'teddy.jpg'),
(16, 'Uswatun Khasanah', 'Pendidikan Teknologi Informasi', 'uus.jpg'),
(17, 'Kristina Yuliana', 'Pendidikan Teknologi Informasi', 'yuli.jpg'),
(18, 'Nurul Dwi Apriliya', 'Pendidikan Teknologi Informasi', 'prili.jpg'),
(19, 'Muhammad Afif', 'Pendidikan Teknologi Informasi', 'apip.jpg'),
(20, 'Elisa Dwi Erniyanti', 'Pendidikan Teknologi Informasi', 'elisa.jpg'),
(21, 'Febriana Mahabatika', 'Pendidikan Teknologi Informasi', 'tika.jpg'),
(22, 'Sephia Ummiyatil Azizah', 'Pendidikan Teknologi Informasi', 'sephia.jpg'),
(23, 'Sarifal Kudsi', 'Pendidikan Teknologi Informasi', 'ifhal.jpg'),
(24, 'Putri Islamiah', 'Pendidikan Teknologi Informasi', 'putri.jpg'),
(25, 'Nefira Annatasya', 'Pendidikan Teknologi Informasi', 'nefira.jpg'),
(26, 'Fiyo Agatha Putra', 'Pendidikan Teknologi Informasi', 'fiyo.jpg'),
(27, 'Reynaldi Dirmansyah Putra', 'Pendidikan Teknologi Informasi', 'reynaldi.jpg'),
(28, 'Dimas Dwi Putra', 'Pendidikan Teknologi Informasi', 'dimas.jpg'),
(29, 'Kemala Adinda Salwa', 'Pendidikan Teknologi Informasi', 'kemala.jpg'),
(30, 'M David Irsyadus Sholihin', 'Pendidikan Teknologi Informasi', 'david.jpg'),
(31, 'M Wahyu Rizkianto', 'Pendidikan Teknologi Informasi', 'wahyu.jpg'),
(32, 'Tasya Eka Oktavia', 'Pendidikan Teknologi Informasi', 'tasya.jpg'),
(33, 'M Nizamuddin Aulia', 'Pendidikan Teknologi Informasi', 'nizam.jpg'),
(34, 'Fahri Darul Farokhi', 'Pendidikan Teknologi Informasi', 'fahri.jpg'),
(35, 'Mirnawati', 'Pendidikan Teknologi Informasi', 'kosong.png'),
(36, 'M Robieth Rosyidi', 'Pendidikan Teknologi Informasi', 'robet.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transkrip`
--

CREATE TABLE `transkrip` (
  `id` int(50) NOT NULL,
  `semester` int(50) NOT NULL,
  `matkul` varchar(50) NOT NULL,
  `sks` int(50) NOT NULL,
  `nilai` varchar(40) NOT NULL,
  `indeks` varchar(50) NOT NULL,
  `loginid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transkrip`
--

INSERT INTO `transkrip` (`id`, `semester`, `matkul`, `sks`, `nilai`, `indeks`, `loginid`) VALUES
(7, 1, 'prodas', 3, 'A', '4', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ukt`
--

CREATE TABLE `ukt` (
  `id` int(11) NOT NULL,
  `nominal` int(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `bidikmisi` varchar(50) NOT NULL,
  `gg` varchar(80) NOT NULL,
  `lunas` int(50) NOT NULL,
  `blunas` int(50) NOT NULL,
  `loginid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ukt`
--

INSERT INTO `ukt` (`id`, `nominal`, `status`, `bidikmisi`, `gg`, `lunas`, `blunas`, `loginid`) VALUES
(6, 2400000, 'Lunas', 'Tidak', '2020/2021 Genap', 2400000, 0, 7),
(7, 2400000, 'Lunas', 'Tidak', '2020/2021 Gasal', 2400000, 0, 7);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alamat`
--
ALTER TABLE `alamat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alamat_ibfk_1` (`loginid`);

--
-- Indeks untuk tabel `biodata`
--
ALTER TABLE `biodata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loginid` (`loginid`);

--
-- Indeks untuk tabel `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loginid` (`loginid`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loginid` (`loginid`);

--
-- Indeks untuk tabel `teman`
--
ALTER TABLE `teman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transkrip`
--
ALTER TABLE `transkrip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transkrip_ibfk_1` (`loginid`);

--
-- Indeks untuk tabel `ukt`
--
ALTER TABLE `ukt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loginid` (`loginid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alamat`
--
ALTER TABLE `alamat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `biodata`
--
ALTER TABLE `biodata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `krs`
--
ALTER TABLE `krs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `teman`
--
ALTER TABLE `teman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `transkrip`
--
ALTER TABLE `transkrip`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `ukt`
--
ALTER TABLE `ukt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alamat`
--
ALTER TABLE `alamat`
  ADD CONSTRAINT `alamat_ibfk_1` FOREIGN KEY (`loginid`) REFERENCES `login` (`id`);

--
-- Ketidakleluasaan untuk tabel `biodata`
--
ALTER TABLE `biodata`
  ADD CONSTRAINT `biodata_ibfk_1` FOREIGN KEY (`loginid`) REFERENCES `login` (`id`);

--
-- Ketidakleluasaan untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  ADD CONSTRAINT `sekolah_ibfk_1` FOREIGN KEY (`loginid`) REFERENCES `login` (`id`);

--
-- Ketidakleluasaan untuk tabel `transkrip`
--
ALTER TABLE `transkrip`
  ADD CONSTRAINT `transkrip_ibfk_1` FOREIGN KEY (`loginid`) REFERENCES `login` (`id`);

--
-- Ketidakleluasaan untuk tabel `ukt`
--
ALTER TABLE `ukt`
  ADD CONSTRAINT `ukt_ibfk_1` FOREIGN KEY (`loginid`) REFERENCES `login` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
