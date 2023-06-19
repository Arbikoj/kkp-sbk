-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Bulan Mei 2023 pada 06.31
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u1747614_kepegawaian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pangkat`
--

CREATE TABLE `pangkat` (
  `gol` varchar(5) NOT NULL,
  `pangkat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `pangkat`
--

INSERT INTO `pangkat` (`gol`, `pangkat`) VALUES
('I/a', 'Juru Muda'),
('I/b', 'Juru Muda Tingkat 1'),
('I/c', 'Juru'),
('I/d', 'Juru Tingkat 1'),
('II/a', 'Pengatur Muda'),
('II/b', 'Pengatur Muda Tingkat 1'),
('II/c', 'Pengatur'),
('II/d', 'Pengatur Tingkat 1'),
('III/a', 'Penata Muda'),
('III/b', 'Penata Muda Tingkat 1'),
('III/c', 'Penata'),
('III/d', 'Penata Tingkat 1'),
('IV/a', 'Pembina'),
('IV/b', 'Pembina Tingkat 1'),
('IV/c', 'Pembina Utama Muda'),
('IV/d', 'Pembina Utama Madya'),
('IV/E', 'Pembina Utama');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(18) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `id_wilker` varchar(4) DEFAULT NULL,
  `id_substansi` varchar(4) DEFAULT NULL,
  `id_struktural` varchar(4) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL,
  `gol` varchar(5) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama`, `id_wilker`, `id_substansi`, `id_struktural`, `status`, `gol`, `jabatan`) VALUES
('196405122000031001', 'Slamet Mulsiswanto, SKM, M.Kes', 'JNDA', 'TU', 'KAKT', 'PNS', 'IV/c', 'Kepala Kantor'),
('196506151986031003', 'Abd. Basith', 'PRAK', 'PKSE', NULL, 'PNS', 'III/d', 'Epidemiolog Kesehatan Penyelia (JF)'),
('196509272014121001', 'Riyono', 'JNDA', 'TU', NULL, 'PNS', 'II/b', 'Staf TU'),
('196510161989031001', 'Mochamad Handoko', 'GRSK', 'PRL', NULL, 'PNS', 'III/b', 'Sanitarian / Pengelola Penyehatan Lingkungan (JP)'),
('196604021991031004', 'Suminto, SH, M.Si', 'JNDA', 'TU', NULL, 'PNS', 'III/d', 'Arsiparis Ahli Muda (JF)'),
('196607291988032001', 'Yuli Suharianingtyas, SKM', 'JNDA', 'PRL', NULL, 'PNS', 'IV/a', 'Sanitarian Ahli Madya (JF)'),
('196608081989031003', 'Edy Suyanto, SKM', 'GRSK', 'PRL', NULL, 'PNS', 'III/d', 'Sanitarian Ahli Muda (JF)'),
('196611072014121001', 'Boedhi Soendarto', 'JNDA', 'TU', NULL, 'PNS', 'II/b', 'Staf TU'),
('196703202014122001', 'Dra. Heni Tugaswati', 'JNDA', 'TU', NULL, 'PNS', 'III/b', 'Staf TU'),
('196706301994031002', 'Djoni Soeroso, S.ST', 'PRAK', 'PKSE', NULL, 'PNS', 'III/d', 'Epidemiolog Kesehatan Ahli Muda (JF)'),
('196709152003122001', 'dr. Dwi Hartatik', 'PRAK', 'UKLW', NULL, 'PNS', 'IV/c', 'Dokter Ahli Madya (JF)'),
('196804271997032001', 'Ruli Handajani, S.Si, Apt, M.Kes', 'JNDA', 'TU', NULL, 'PNS', 'IV/a', 'Perencana / Penyusun Program Anggaran dan Pelaporan (JP)'),
('196809191993031004', 'Hari Susanto, ST, M.KL', 'JNDA', 'TU', 'KOOR', 'PNS', 'IV/a', 'Analis Pengelolaan Keuangan APBN Ahli Madya (JF)'),
('196907082014121001', 'Suyanto', 'GRSK', 'TU', NULL, 'PNS', 'II/b', 'Petugas Keamanan (JP)'),
('196907231989032001', 'Ida Nurhandayani, SKM', 'JNDA', 'PKSE', NULL, 'PNS', 'IV/a', 'Epidemiolog Kesehatan Ahli Madya (JF)'),
('197003262005021002', 'dr. Acub Zaenal Amoe, MPH', 'JNDA', 'UKLW', 'KOOR', 'PNS', 'IV/a', 'Dokter Ahli Madya (JF)'),
('197003301991031002', 'Pudjo Suwanto, SKM, M.Kes', 'JNDA', 'PRL', 'SKOR', 'PNS', 'IV/a', 'Entomolog Kesehatan Ahli Muda (JF)'),
('197004082002122001', 'dr. Deni Apriani, MM', 'JNDA', 'UKLW', 'SKOR', 'PNS', 'IV/a', 'Dokter Ahli Muda (JF)'),
('197005182007101001', 'Nuril', 'TBAN', 'TU', NULL, 'PNS', 'II/d', 'Petugas Keamanan (JP)'),
('197006071994021001', 'Gunawan Abdul Majid, SKM', 'TBAN', 'PRL', NULL, 'PNS', 'III/d', 'Entomolog Kesehatan Ahli Muda (JF)'),
('197008221998032001', 'Nur Asyah, SKM., M.Kes', 'JNDA', 'TU', NULL, 'PNS', 'IV/a', 'Arsiparis Ahli (JP)'),
('197009162002122006', 'dr. Adianti Handajani, M.Kes., Sp.KJ.', 'JNDA', 'UKLW', '', 'PNS', 'III/b', 'Dokter'),
('197012291993031001', 'Achmad Faridy Faqih, ST,M.Kes', 'JNDA', 'PRL', 'KOOR', 'PNS', 'IV/a', 'Sanitarian Ahli Madya (JF)'),
('197101282005012002', 'dr. Ratih Nawang Palupi, M.Kes', 'PRAK', 'UKLW', 'KORW', 'PNS', 'IV/c', 'Dokter Ahli Madya (JF)'),
('197105052014122001', 'dr. Ririn Puspitasari, MM', 'JNDA', 'PKSE', 'SKOR', 'PNS', 'III/c', 'Epidemiolog Kesehatan Ahli Muda (JF)'),
('197109192001122006', 'dr. Diah Wahju Tjahjana', 'JNDA', 'UKLW', NULL, 'PNS', 'IV/c', 'Dokter Ahli Madya (JF)'),
('197205212001121001', 'dr. Rofiud Darojat', 'JNDA', 'PKSE', 'KOOR', 'PNS', 'IV/a', 'Epidemiolog Kesehatan Ahli Madya (JF)'),
('197301012007011060', 'Suhandoko', 'JNDA', 'TU', NULL, 'PNS', 'II/b', 'Petugas Keamanan (JP)'),
('197301252014122002', 'dr. Norma Priamindiasari', 'PRAK', 'UKLW', NULL, 'PNS', 'III/c', 'Dokter (JP)'),
('197304142000032001', 'Christiany Kusuma Pertiwi, S.Si', 'JNDA', 'PRL', NULL, 'PNS', 'IV/a', 'Entomolog Kesehatan Ahli Madya (JF)'),
('197305181994031002', 'Akhmad Imron, SKM,M.KKK', 'JNDA', 'PKSE', NULL, 'PNS', 'IV/a', 'Epidemiolog Kesehatan Ahli Muda (JF)'),
('197310162003122001', 'dr. Suci Wulansari Sp. KFR', 'JNDA', 'UKLW', NULL, 'PNS', 'III/d', 'Dokter'),
('197407141998031002', 'Robert Anang Judianto, SST, MM', 'GRSK', 'PRL', 'KORW', 'PNS', 'III/b', 'Sanitarian Ahli Pertama (JF)'),
('197407221999032007', 'Yuyung Setiyowati, SKM, MPH', 'JNDA', 'PRL', NULL, 'PNS', 'IV/a', 'Sanitarian Ahli Madya (JF)'),
('197408132002121002', 'Moch Agus Wahyudi, SKM, M.KL', 'JNDA', 'TU', 'ADUM', 'PNS', 'III/d', 'Kepala Subbagian Administrasi Umum'),
('197408181994031001', 'Agus Hendri, S.Kep', 'GRSK', 'UKLW', NULL, 'PNS', 'III/c', 'Perawat Ahli Pertama (JF)'),
('197411062014121002', 'Ahmad Basori', 'JNDA', 'TU', NULL, 'PNS', 'II/b', 'Petugas Keamanan (JP)'),
('197505292014051002', 'Sukari', 'JNDA', 'TU', NULL, 'PNS', 'II/a', 'Petugas Keamanan (JP)'),
('197508172014122004', 'Agustin Ambarwati', 'JNDA', 'TU', NULL, 'PNS', 'III/b', 'Analis Kepegawaian (JP)'),
('197601282005012003', 'Nina Kurnia Mardiani, S.Kep, Ners', 'PRAK', 'UKLW', NULL, 'PNS', 'III/d', 'Perawat Ahli Muda (JF)'),
('197603302006042001', 'dr. Lulut Kusumawati, SpPK', 'JNDA', 'UKLW', NULL, 'PNS', 'III/c', 'Dokter'),
('197608292009012003', 'dr. Hendri Hastuti', 'JNDA', 'UKLW', NULL, 'PNS', 'IV/a', 'Dokter Ahli Muda (JF)'),
('197611182005012002', 'Binti Wachidatin, S.Kep, Ners', 'JNDA', 'UKLW', NULL, 'PNS', 'III/c', 'Perawat Ahli Pertama (JF)'),
('197701152006042003', 'dr. Khrisma Wijayanti', 'JNDA', 'UKLW', NULL, 'PNS', 'III/d', 'Staf Substansi UKLW'),
('197710212003121001', 'Deden Adiecandra, SE', 'JNDA', 'TU', NULL, 'PNS', 'III/d', 'Analis Pengelolaan Keuangan APBN Ahli Muda (JF)'),
('197805312009121001', 'dr. Mochamad Gesta Robi Farmawan', 'JNDA', 'UKLW', 'SKOR', 'PNS', 'IV/a', 'Dokter Ahli Muda (JF)'),
('197806032012122001', 'Siti Nurhayati, Amd.KL', 'PRAK', 'PRL', NULL, 'PNS', 'II/d', 'Sanitarian Terampil (JF)'),
('197807062009122001', 'dr. Yuli Kristanti', 'JNDA', 'UKLW', NULL, 'PNS', 'III/c', 'Dokter (JP)'),
('197812262002121002', 'Hardani Endras Sigita, SKM', 'PRAK', 'PRL', NULL, 'PNS', 'III/b', 'Sanitarian Ahli Pertama (JF)'),
('197901292008121002', 'Siswanto, ST, M.Epid', 'JNDA', 'PRL', 'SKOR', 'PNS', 'III/c', 'Sanitarian Ahli Muda (JF)'),
('197903112003122003', 'Devika Martyawati, SKM,M.Kes', 'JNDA', 'PKSE', 'SKOR', 'PNS', 'IV/a', 'Epidemiolog Kesehatan Ahli Muda (JF)'),
('197904042002122003', 'Ira Ummu Aimanah, SKM, M.Kes', 'JNDA', 'PKSE', NULL, 'PNS', 'III/c', 'Epidemiolog Kesehatan Ahli Muda (JF)'),
('197904212005012001', 'Henik Kartikowati, S.Kep,Ns', 'JNDA', 'UKLW', NULL, 'PNS', 'III/c', 'Perawat / Pengelola Keperawatan (JP)'),
('197904272003122001', 'Yuyun Dwi Astutik, SKM', 'PRAK', 'PKSE', NULL, 'PNS', 'III/c', 'Epidemiolog Kesehatan Ahli Muda (JF)'),
('197905052005011006', 'Maksudi, S.Kep, Ns', 'JNDA', 'UKLW', NULL, 'PNS', 'III/d', 'Perawat Ahli Muda (JF)'),
('197911172009032003', 'dr. Ana Krismiawati', 'JNDA', 'UKLW', NULL, 'PNS', 'III/d', 'Dokter Ahli Muda (JF)'),
('197911182006042001', 'Nunki Nirmalasari, ST', 'JNDA', 'PRL', NULL, 'PNS', 'III/d', 'Sanitarian Ahli Muda (JF)'),
('198004012007101001', 'Haryono', 'JNDA', 'TU', NULL, 'PNS', 'II/d', 'Staf TU'),
('198006042005012004', 'Leily Florentina, AMd. Kep', 'JNDA', 'UKLW', NULL, 'PNS', 'III/c', 'Perawat / Pengelola Keperawatan (JP)'),
('198006072006042006', 'dr. Eni Wahyuni', 'JNDA', 'UKLW', NULL, 'PNS', 'IV/b', 'Dokter Ahli Madya (JF)'),
('198007142014122002', 'dr. Maedy Christiyani Bawolje', 'JNDA', 'UKLW', NULL, 'PNS', 'III/c', 'Dokter (JP)'),
('198008082005012005', 'Aryanti, S.Kep, Ns', 'JNDA', 'UKLW', NULL, 'PNS', 'III/d', 'Perawat Ahli Muda (JF)'),
('198009102008122001', 'Puspita Tri Mutiarani, S.KM', 'JNDA', 'PRL', NULL, 'PNS', 'III/a', 'Sanitarian Ahli Pertama (JF)'),
('198106072015032001', 'Sri Rejeki Amalia, SE', 'JNDA', 'TU', NULL, 'PNS', 'III/b', 'Analis Pengelolaan Keuangan APBN Ahli Pertama (JF)'),
('198107252014121004', 'dr. Christian Tri Wibowo', 'KLNG', 'UKLW', 'KORW', 'PNS', 'III/c', 'Dokter (JP)'),
('198108042011032001', 'dr. Rr. Fitri Budi Sri Sugihartini', 'JNDA', 'UKLW', NULL, 'PNS', 'III/d', 'Dokter Ahli Muda (JF)'),
('198109142005012001', 'Suhartatik, SKM, M.Kes', 'JNDA', 'PKSE', NULL, 'PNS', 'III/c', 'Epidemiolog Kesehatan Ahli Muda (JF)'),
('198112012014121002', 'Yuliono', 'GRSK', 'TU', NULL, 'PNS', 'I/d', 'Petugas Keamanan (JP)'),
('198209302009122001', 'dr. Lestari Sri Pusparini, M.KKK', 'PRAK', 'UKLW', NULL, 'PNS', 'III/d', 'Dokter Ahli Muda (JF)'),
('198210022005012003', 'Agata Mirna Sari, Amd.Kep', 'JNDA', 'UKLW', NULL, 'PNS', 'III/a', 'Perawat Mahir (JF)'),
('198210252014121004', 'dr. Heris Setiawan Kusumaningrat', 'TBAN', 'UKLW', 'KORW', 'PNS', 'III/c', 'Dokter (JP)'),
('198301012009121003', 'Doni Andrianto Nugroho, S.Kom', 'JNDA', 'TU', NULL, 'PNS', 'III/c', 'Analis Kepegawaian Ahli Muda (JF)'),
('198305252009122001', 'dr. Retno Widyastuti, MKM', 'JNDA', 'PKSE', NULL, 'PNS', 'III/d', 'Epidemiolog Kesehatan Ahli Muda (JF)'),
('198311252006042005', 'Fenty Dwi Noviani, SKM', 'JNDA', 'PKSE', NULL, 'PNS', 'III/b', 'Sanitarian Ahli (JP)'),
('198402012008011014', 'Feri Wahyudi, S.Kep', 'TBAN', 'UKLW', NULL, 'PNS', 'III/b', 'Perawat Mahir (JF)'),
('198402102010012020', 'drg. Dyah Puspita Rachmawati', 'GRSK', 'PKSE', NULL, 'PNS', 'III/d', 'Epidemiolog Kesehatan Ahli Muda (JF)'),
('198404282010121001', 'Darma Setiawan, A.Md.KL', 'TBAN', 'PRL', NULL, 'PNS', 'III/a', 'Entomolog Kesehatan / Pengelola Pemberantasan Penyakit Bersumber Binatang (JP)'),
('198408172007122001', 'Zulfa Auliyati Agustina, SKM', 'JNDA', 'PKSE', NULL, 'PNS', 'III/c', 'Epidemiolog Kesehatan Ahli Muda (JF)'),
('198411022009122001', 'Elly Erawati, AMd', 'JNDA', 'TU', NULL, 'PNS', 'III/a', 'Arsiparis Mahir (JF)'),
('198502202008122003', 'Yanita Setyaningrum, SKM, M.Kes', 'JNDA', 'TU', 'SKOR', 'PNS', 'III/d', 'Perencana Ahli Muda (JF)'),
('198503052014022001', 'Indah Sari Wulandari, SKM', 'JNDA', 'PRL', NULL, 'PNS', 'III/c', 'Entomolog Kesehatan Ahli (JP)'),
('198505092008122001', 'Reni Candra Palupi, S.Farm, Apt', 'PRAK', 'PKSE', NULL, 'PNS', 'III/d', 'Epidemiolog Kesehatan Ahli Muda (JF)'),
('198505112008122003', 'Mielka Ratna Kusuma Wardhani, SKM, M.Kes', 'JNDA', 'PKSE', NULL, 'PNS', 'III/c', 'Epidemiolog Kesehatan Ahli Muda (JF)'),
('198505142008121001', 'Wachid Nurcahyo, S.Kep, Ns', 'PRAK', 'UKLW', NULL, 'PNS', 'III/b', 'Perawat Ahli Pertama (JF)'),
('198506052014121001', 'dr. Dedy Hendrawan Alvianto', 'PRAK', 'UKLW', NULL, 'PNS', 'III/c', 'Dokter (JP)'),
('198506142015032007', 'dr. Yuliana Tanaya', 'JNDA', 'UKLW', NULL, 'PNS', 'III/c', 'Dokter (JP)'),
('198512172008011008', 'Mas Adhi Hardian Utama, SST', 'PRAK', 'PRL', NULL, 'PNS', 'III/c', 'Entomolog Kesehatan Ahli Muda (JF)'),
('198607122009121001', 'Hery Iswanto, A.Md.Kep', 'TBAN', 'UKLW', NULL, 'PNS', 'III/a', 'Perawat / Pengelola Keperawatan (JP)'),
('198607232015031001', 'dr. Yulius Anggana', 'GRSK', 'UKLW', NULL, 'PNS', 'III/c', 'Dokter (JP)'),
('198610132015031001', 'Yuwono Widyatmoko, Amd.Kep', 'KLNG', 'UKLW', NULL, 'PNS', 'II/d', 'Perawat Terampil (JF)'),
('198708152010121002', 'Andhika Nugraha, SKM., M.KKK', 'JNDA', 'UKLW', NULL, 'PNS', 'III/c', 'Pembimbing Kesehatan Kerja Ahli Muda (JF)'),
('198710282015032001', 'Annisa Ur Risdah, AMd.Kep', 'PRAK', 'UKLW', NULL, 'PNS', 'II/d', 'Perawat Terampil (JF)'),
('198801282010122001', 'Rr Ayuningtyas Dian Paramita, SE', 'JNDA', 'TU', NULL, 'PNS', 'III/c', 'Analis Pengelolaan Keuangan APBN Ahli Muda (JF)'),
('198804282019022001', 'Ika Rohmawati, SKM', 'JNDA', 'PKSE', NULL, 'PNS', 'III/a', 'Epidemiolog Kesehatan Ahli Pertama (JF)'),
('198808152010122002', 'Qurrotul Aini Meta Puspita Sari, S.TP., M.Kes.', 'JNDA', 'TU', NULL, 'PNS', 'III/c', 'Staf TU'),
('198811072022031002', 'Candra Kurniawan, A.Md', 'JNDA', 'TU', NULL, 'PNS', 'II/c', 'Pranata Komputer Terampil (JP)'),
('198906182020122004', 'Shinta Ayu Dewanti, S.E', 'JNDA', 'TU', NULL, 'PNS', 'III/a', 'Analis Keuangan (JP)'),
('198910282020121003', 'Henif Carry Budinaryanto, Amd. Kep', 'GRSK', 'UKLW', NULL, 'PNS', 'II/c', 'Perawat / Pengelola Keperawatan (JP)'),
('199006162012122002', 'Ratih Maharani, SKM', 'JNDA', 'PRL', NULL, 'PNS', 'III/a', 'Sanitarian Ahli Pertama (JF)'),
('199007312019021001', 'Tonny Nero, AMd.KL', 'GRSK', 'PRL', NULL, 'PNS', 'II/c', 'Sanitarian Terampil (JF)'),
('199101062012122002', 'Fawandi Eta Rachmawati, SKM', 'JNDA', 'PRL', NULL, 'PNS', 'III/a', 'Sanitarian Ahli Pertama (JF)'),
('199112222014022003', 'Nellis Eka Risnita, Amd.KL', 'GRSK', 'PRL', NULL, 'PNS', 'III/a', 'Entomolog Kesehatan Mahir (JF)'),
('199209232022031001', 'Yogi Harsa Pradana, S.E', 'JNDA', 'TU', NULL, 'PNS', 'III/a', 'Analis Pengelolaan Keuangan APBN Ahli Pertama (JP)'),
('199402282022031001', 'Putra Ibnu Chajar, S.Kom', 'JNDA', 'TU', NULL, 'PNS', 'III/a', 'Pranata Komputer Ahli Pertama (JP)'),
('199508092019021001', 'Dirga Maulidan, SKM', 'JNDA', 'PRL', NULL, 'PNS', 'III/a', 'Entomolog Kesehatan Ahli Pertama (JF)'),
('919590119200002101', 'Kasman', 'PRAK', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919660604201510101', 'Made Seniman', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919720523202001101', 'Slamet Riadi', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919720630201501101', 'Fuji', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919720730201101101', 'Mawan Dwi Winarto', 'PRAK', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919761119201005101', 'Budi Setiawan', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Pengemudi'),
('919771010201802101', 'Muslimin', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919790917201802101', 'Supramono Djati', 'PRAK', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919800811202006101', 'Gatut Susanto', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Pengemudi'),
('919800828200905101', 'Agus Ardiansyah', 'KLNG', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919801208202001101', 'M.Yudha Amu', 'PRAK', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919811110200904101', 'Bayu Indar Nirwanto', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919820713202001101', 'Agus Salim', 'PRAK', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919821115201211101', 'M. Taufik', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919830105201802101', 'Bowo Budi Santoso', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919830218201101101', 'Rahmad Fauzi', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919830317200905101', 'Muhammad Iswanto', 'PRAK', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919830521201501101', 'Budi Wagianto', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919840401201802101', 'Dwi Aprilia Susamtoro Sunaryo, SH', 'PRAK', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919850124201802101', 'Putu Angga Kusuma Atmaja', 'PRAK', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919850827201501101', 'Ricky Tri Anggoro', 'TBAN', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919860421202003101', 'Roy Widiyanto', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Pengemudi'),
('919860617201301101', 'Iwan Santoso', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Pengemudi'),
('919871010201401101', 'Ansori', 'PRAK', 'PRL', NULL, 'PPNPN', NULL, 'Staf Substansi PRL'),
('919880116201601101', 'Januar Irwandi', 'GRSK', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919881110202001101', 'Mustakim', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Pengemudi'),
('919890324201601201', 'Dian Eka Puspitasari', 'PRAK', 'PKSE', NULL, 'PPNPN', NULL, 'Staf Substansi PKSE'),
('919890729201401101', 'Deddy Pratama', 'PRAK', 'UKLW', NULL, 'PPNPN', NULL, 'Staf Substansi UKLW'),
('919900330201501101', 'Martin Anjar Hartanto, S.Kep, Ns', 'TBAN', 'UKLW', NULL, 'PPNPN', NULL, 'Staf Substansi UKLW'),
('919900825201005101', 'Abd. Rozak', 'PRAK', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919900906201310101', 'Zaenal Abidin', 'PRAK', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919900920202006101', 'Didik Aman Wahyudi, S.Kep, Ns', 'JNDA', 'UKLW', NULL, 'PPNPN', NULL, 'Perawat'),
('919910723201501101', 'Ainul Qodraturrahman', 'KLNG', 'UKLW', NULL, 'PPNPN', NULL, 'Staf Substansi UKLW'),
('919910803201802201', 'Merista Vivilia Hariwati', 'PRAK', 'UKLW', NULL, 'PPNPN', NULL, 'Staf Substansi UKLW'),
('919910905201601201', 'Septia Anggraini, AMd. KL', 'JNDA', 'PRL', NULL, 'PPNPN', NULL, 'Staf Substansi PRL'),
('919911009201802101', 'Moh Norman Suryanto', 'KLNG', 'UKLW', NULL, 'PPNPN', NULL, 'Staf Substansi UKLW'),
('919911223201601201', 'Amen Desina Sari, SKM', 'PRAK', 'PRL', NULL, 'PPNPN', NULL, 'Staf Substansi PRL'),
('919920309202201201', 'Rizki Fitrah Ramadhani', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919920503201601201', 'Putrie Nurlina Permatasari, AMd. Kep', 'JNDA', 'UKLW', NULL, 'PPNPN', NULL, 'Perawat'),
('919920721202001102', 'Ardian Rudi Kristanto, S.Kep, Ns', 'GRSK', 'UKLW', NULL, 'PPNPN', NULL, 'Staf Substansi UKLW'),
('919920923201802101', 'Septian Maulana Rakhmad, S.Kom', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919921026201401201', 'Okky Oktavia Pontororing, AMd. Kep', 'JNDA', 'UKLW', NULL, 'PPNPN', NULL, 'Perawat'),
('919930318202111201', 'Dewi Sulistianingroem', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919930425201501101', 'Arief Dedi Setiawan, Amd. Kep', 'GRSK', 'UKLW', NULL, 'PPNPN', NULL, 'Staf Substansi UKLW'),
('919930504202002101', 'Rizqi Arief Firmansyah, S.Kom', 'JNDA', 'PKSE', NULL, 'PPNPN', NULL, 'Staf Substansi PKSE'),
('919931028201601101', 'Alrizal Nanda Kusuma Pradana', 'TBAN', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919931115202002101', 'Dimas Abdullah Marha Putra', 'TBAN', 'PRL', NULL, 'PPNPN', NULL, 'Staf Substansi PRL'),
('919940216202102201', 'Nuri Iswoyo Ramadhani', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919940601201501101', 'Deden Triwandani', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919940611201802201', 'Sherla Sherlia Herdirinandasari, SE', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919940725201601101', 'Bagus Permana Sukma', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919940910201802101', 'Nurhakim, AMd. Kep', 'JNDA', 'UKLW', NULL, 'PPNPN', NULL, 'Perawat'),
('919941211201802101', 'Miftahol Hudhah', 'GRSK', 'PKSE', NULL, 'PPNPN', NULL, 'Staf Substansi PKSE'),
('919950317201802101', 'Misbakhul Yogi Rosianto', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919950425201802101', 'Miftahul Huda', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Pengemudi'),
('919950526201802201', 'Saudah Mawaliya Alkhusaini', 'PRAK', 'UKLW', NULL, 'PPNPN', NULL, 'Staf Substansi UKLW'),
('919960212202111201', 'Vega Nida Vebiani', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919960325201802101', 'Dodo Weah Saputra, S.I.Kom', 'PRAK', 'PKSE', NULL, 'PPNPN', NULL, 'Staf Substansi PKSE'),
('919960419202001201', 'Dias Annisa Rahmah, AMd', 'JNDA', 'UKLW', NULL, 'PPNPN', NULL, 'Perawat'),
('919970526202001201', 'Della Ayu Pramestya', 'PRAK', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919970906202007101', 'Rochmad Ardiansyah Pratama', 'KLNG', 'PKSE', NULL, 'PPNPN', NULL, 'Staf Substansi PKSE'),
('919971221202110101', 'Ilham Sofa Andriawan, SKM', 'TBAN', 'PKSE', NULL, 'PPNPN', NULL, 'Staf Substansi PKSE'),
('919980224202203101', 'Bagas Permadi', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919980827202101101', 'Audrey Abdilah Rusdianto', 'JNDA', 'PRL', NULL, 'PPNPN', NULL, 'Staf Substansi PRL'),
('919980912201802101', 'Arif Wicaksono', 'JNDA', 'TU', NULL, 'PPNPN', NULL, 'Staf Substansi TU'),
('919990129202202201', 'Armya Zakiah Safitri, SKM', 'GRSK', 'PKSE', NULL, 'PPNPN', NULL, 'Staf Substansi PKSE'),
('919990523202101101', 'Ilyas Anas Alauddin', 'KLNG', 'PRL', NULL, 'PPNPN', NULL, 'Staf Substansi PRL');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pangkat`
--
ALTER TABLE `pangkat`
  ADD PRIMARY KEY (`gol`) USING BTREE;

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`) USING BTREE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
