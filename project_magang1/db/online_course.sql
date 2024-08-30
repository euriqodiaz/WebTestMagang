-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Agu 2024 pada 06.06
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_course`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `duration` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `duration`) VALUES
(1, 'test', 'test', '120'),
(2, 'test2', 'ilmu paham', '60');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `embed_link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `materials`
--

INSERT INTO `materials` (`id`, `course_id`, `title`, `description`, `embed_link`) VALUES
(3, 2, 'Pemahaman Kak Gem', '1. Pendahuluan\r\nKak Gem adalah seorang kreator konten di platform TikTok yang dikenal dengan konten-kontennya yang kreatif dan menghibur. Dalam materi ini, kita akan membahas profil Kak Gem, jenis konten yang dibuatnya, dan dampaknya di platform TikTok.\r\n\r\n2. Profil Kak Gem\r\nKak Gem adalah seorang TikToker yang memiliki nama asli [Nama Lengkap], dan dikenal dengan username TikTok-nya @kakgem. Dia mulai aktif di TikTok pada [Tahun Mulai Aktif], dan sejak itu telah membangun pengikut yang besar dengan konten-kontennya yang menarik dan beragam.\r\n\r\nFakta Singkat:\r\nUsername TikTok: @kakgem\r\nJumlah Pengikut: [Jumlah Pengikut] (terbaru)\r\nJenis Konten: [Jenis Konten, misalnya: dance, komedi, tutorial, dll.]\r\n3. Jenis Konten\r\nKak Gem dikenal karena membuat berbagai jenis konten yang mencakup:\r\n\r\n3.1. Konten Hiburan\r\nKak Gem sering membuat video hiburan yang menghibur penontonnya. Ini bisa mencakup:\r\n\r\nDance Challenges: Mengikuti tren tarian terbaru di TikTok.\r\nKomedi: Sketsa atau parodi yang lucu dan menghibur.\r\nLip Sync: Menyanyikan atau melip sync lagu-lagu populer.\r\n3.2. Konten Edukasi\r\nSelain konten hiburan, Kak Gem juga mungkin membuat video edukasi, seperti:\r\n\r\nTutorial: Video yang mengajarkan keterampilan baru atau tips dan trik.\r\nInformasi: Menyampaikan informasi menarik tentang topik tertentu.\r\n3.3. Konten Lifestyle\r\nKonten lifestyle Kak Gem mungkin meliputi:\r\n\r\nVlog: Menampilkan keseharian atau kegiatan sehari-hari Kak Gem.\r\nReview Produk: Mengulas produk atau layanan yang digunakan.\r\n4. Dampak di Platform TikTok\r\nKak Gem telah memberikan dampak signifikan di TikTok melalui:\r\n\r\nPengikut Setia: Memiliki basis pengikut yang besar dan aktif.\r\nTren dan Viral: Membuat konten yang sering menjadi viral atau trend di TikTok.\r\nKeterlibatan Komunitas: Aktif berinteraksi dengan pengikut dan komunitas TikTok.\r\n5. Kesimpulan\r\nKak Gem adalah contoh kreator konten TikTok yang sukses dengan berbagai jenis konten yang menghibur dan mendidik. Memahami profil dan jenis konten Kak Gem bisa memberikan wawasan tentang cara membangun audiens dan menciptakan konten yang menarik di media sosial.', 'https://www.tiktok.com/@kakakgem?lang=id-ID'),
(4, 1, 'Pengenalan Web Programming', 'Web programming adalah proses membuat dan mengelola aplikasi web. Dalam materi ini, kita akan membahas dasar-dasar web programming dengan fokus pada HTML, CSS, dan JavaScript. untuk melihat full materi bisa kunjungi link disebelah ini', 'https://www.karier.mu/blog/umum/karier-web-developer/');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
