-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2024 at 12:40 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fca`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) UNSIGNED NOT NULL,
  `author_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `resume` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` enum('draft','publish','delete','') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `author_id`, `title`, `slug`, `resume`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Apa yang dimaksud dengan <em>Financial Coach</em>?', 'apa-yang-dimaksud-dengan-financial-coach', 'Berikut ini adalah arti Financial Coach dari dua expert dunia tentang Financial Coach sesuai bidang mereka masing-masing.', '<p>Ada beberapa definisi tentang apa yang dimaksud dengan Financial Coach, berikut ini adalah maksud dari <em>Financial Coach</em> dari beberapa expert dunia tentang <em>Financial Coach.</em></p>\r\n<p><strong>Dave Ramsey - </strong><em>financial advisor</em> dan <em>popular radio show/ podcast.</em></p>\r\n<p><em>Financial Coach</em> adalah profesional uang terlatih yang dapat membantu klien &nbsp;membuat keputusan yang baik dengan uang mereka sejak saat mereka menerima pembayaran penghasilan hingga saat klien membelanjakan unag terakhirnya.</p>\r\n<p>Ketika klien bekerja dengan <em>Financial Coach</em>, mereka akan menjadi lebih sadar akan kebiasaan uang mereka (yang baik dan yang buruk).</p>\r\n<p>Mengapa penting? ketika Klien mengerjakan kebiasaan memperlakukan uang mereka, itu mengubah perilaku segalanya. Uang bukan hanya masalah matematika, ini ternyata masalah perilaku juga.</p>\r\n<p>Seorang <em>Financial Coach</em> dapat menunjukkan kepada Klien bagaimana mengatasi stres, ketakutan, dan kurangnya rencana untuk uang mereka.</p>\r\n<p>Inilah bagian terbaiknya:<em> Financial Coach</em> berada di sisi klien! Mereka tidak menghakimi, mengkritik atau mempermalukan uang. Dan mereka tahu persis bagaimana cara membantu klien melarikan diri dari roda hidup seekor hamster, yaitu dari gaji ke gaji.</p>\r\n<p><strong>Kelsa Dickey &ndash; <em>Financial Coach Academy USA</em></strong></p>\r\n<p>Saya suka menjadi seorang <em>Financial Coach</em> &ndash; menyukainya sampai ke inti saya! Saya tidak dapat memberi tahu Anda betapa berharganya membantu orang memiliki kemampuan tentang kekuatan dan jebakan finansial, dan menjadikannya fokus dan mempelajari cara mengelolanya.</p>\r\n<p><em>Financial Coach</em> tidak seperti bisnis lain yang saya tahu. Itu tidak murni menekankan angka dan penjualan, seperti <em>Financial Advisor</em>. Itu tidak menekankan pola pikir dan emosi, seperti <em>Life Coaching</em> dan sebagian besar bentuk <em>Business Coaching</em>. Ini adalah keseimbangan yang tepat dari keduanya, dan karena itu, model bisnis financial Coaching benar-benar berbeda dari industri <em>Coaching</em> lainnya.</p>', 'publish', '2023-12-08 08:01:54', '2023-12-27 04:40:28'),
(2, 1, 'Apa itu psikologi dalam <em>Financial Planning</em>?', 'apa-itu-psikologi-dalam-financial-planning', 'Perencanaan keuangan telah berkembang dengan mempertimbangkan semua area dalam kehidupan klien yang dipengaruhi oleh uang.', '<p>Perencanaan keuangan saat ini lebih dari sekadar portofolio dan produk. Bidang ini telah berkembang dengan mempertimbangkan semua area dalam kehidupan klien yang dipengaruhi oleh uang: makna bagi mereka; tujuan keuangan yang dipengaruhi oleh nilai-nilai; dan kekhawatiran tentang dampak uang yang paling berarti bagi mereka.</p>\r\n<p>Perencana keuangan yang sukses memahami satu hal penting tentang klien mereka bahwa, keuangan pribadi (<em>personal finance</em>) dan psikologi (<em>psychology</em>) klien terkait erat. Ketika seorang perencana keuangan memberikan saran kepada klien mereka, mereka berhadapan dengan ratusan ribu tahun pengkondisian psikologis manusia (<em>human psychological conditioning</em>), serta keyakinan (<em>beliefs</em>) yang unik, perilaku (<em>behaviour</em>), kebiasaan (<em>habits</em>), dan latar belakang &nbsp;klien mereka.</p>\r\n<p>Pengetahuan tentang psikologi keuangan klien lebih dari esensi untuk praktik perencanaan keuangan. Jadi, mengingat kesan kita yang berhubungan dengan uang, perencana keuangan harus melengkapi diri dengan pengetahuan dan alat untuk membantu klien mengatasi hambatan mental ini.</p>\r\n<p>Menjadi berpengetahuan saja tidak cukup. Perencana keuangan harus menggunakan pengetahuan ini untuk memahami latar belakang pribadi, keluarga dan budaya klien mereka yang unik dan bagaimana mereka memengaruhi tujuan keuangan mereka. Untuk melakukan ini, perencana keuangan harus memahami psikologi uang mereka sendiri, termasuk pandangan dunia dan bias yang mereka bawa ke dalam hubungan dengan klien mereka. Ini akan memungkinkan mereka untuk peka terhadap pandangan dunia dan bias unik masing-masing klien.</p>\r\n<p>Sumber: <em>Psychology of financial planning, Dr. Bradley T. Klontz CFP, Dr. Charles Chaffin, Ted Klonz Phd</em></p>', 'publish', '2023-12-08 08:02:22', '2023-12-28 02:16:04'),
(3, 1, '<em>Financial Coaching</em> - Sebuah kesempatan bisnis', 'financial-coaching-sebuah-kesempatan-bisnis', 'Bagaimana Anda keluar dari siklus gaji ke gaji yang tampaknya tak ada habisnya?', '<p>Menghasilkan uang dan kemudian bertanya-tanya ke mana perginya seperti meninju diri sendiri dalam perkelahian. Itu mungkin terdengar sedikit berlebihan, tapi itu benar! Dan 78% orang Amerika melakukan hal itu: hidup dari gaji ke gaji dan bertanya-tanya ke mana uang mereka pergi setiap bulan.</p>\r\n<p>Tapi bagaimana Anda keluar dari siklus gaji ke gaji yang tampaknya tak ada habisnya? &nbsp;. . . dengan melakukan hal-hal yang berbeda dari yang pernah orang-orang tersebut Anda lakukan. Dan bagian dari melakukan sesuatu secara berbeda adalah mengetahui kapan (dan siapa) untuk meminta bantuan. Dalam hal ini, saatnya untuk menghubungi seorang <em>Coach </em>&ndash; Seorang <em>Financial Coach</em>. (sumber Dave Ramsey).</p>\r\n<p>Dengan populasi Amerika sebesar kurang lebih 340 juta, Mr. Dave Ramsey mengibaratkan 78% orang Amerika masih bergantung dari gaji ke gaji&hellip;dan berpotensi membutuhkan seorang&nbsp;<em>Financial Coach</em> yang memahami psikologi perencanaan keuangan untuk membantu.</p>\r\n<p>Populasi Indonesia mungkin tidak sebesar Amerika, angka 78% populasi tersebut mungkin lebih kecil atau lebih besar. Tetap saja itu potensi yang besar.</p>\r\n<p>Bagi perencana keuangan dan praktisi jasa keuangan seperti penasehat investasi, konsultan keuangan, agen asuransi serta perencana keuangan independen, meningkatkan kompetensi psikologi perencanaan keuangan berpotensi meraih peluang bisnis, menambah klien baru dan meningkatkan layanan advisori bagi klien yang sudah ada. Dan jangan lupa, kepuasan dan kebahagiaan pribadi ketika berhasil membantu seorang klien meraih rencana tujuan keuangan mereka.</p>\r\n<p>FPSB Indonesia dan Academy Financial Coaching Indonesia merancang program pelatihan yang memanfaatkan pendekatan psikologi perencanaan keuangan yang digunakan CFP Board Amerika. FPSB Indonesia juga menyiapkan&nbsp;<em>tools </em>(alat bantu) yang digunakan oleh lulusan pelatihan psikologi perencanaan keuangan juga mendukung praktek bisnis profesi Anda.</p>', 'publish', '2023-12-08 08:02:48', '2024-01-10 06:28:27');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `image_url`, `description`, `created_at`) VALUES
(1, 'Qualified Financial Coach&trade;', NULL, 'Materi belajar Academy Financial Coaching Indonesia untuk Qualified Financial Coach.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_enrollment`
--

CREATE TABLE `course_enrollment` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `course_id` int(11) UNSIGNED DEFAULT NULL,
  `enrolled_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `access_until` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mc_answers`
--

CREATE TABLE `mc_answers` (
  `id` int(11) UNSIGNED NOT NULL,
  `question_id` int(11) UNSIGNED DEFAULT NULL,
  `selected_option_id` int(11) UNSIGNED DEFAULT NULL,
  `task_attempt_id` int(11) UNSIGNED DEFAULT NULL,
  `answered_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mc_options`
--

CREATE TABLE `mc_options` (
  `id` int(11) UNSIGNED NOT NULL,
  `question_id` int(11) UNSIGNED NOT NULL,
  `option_text` varchar(255) DEFAULT NULL,
  `is_correct` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mc_options`
--

INSERT INTO `mc_options` (`id`, `question_id`, `option_text`, `is_correct`) VALUES
(1, 1, 'Untuk mengembangkan strategi keuangan standar untuk semua klien', 0),
(2, 1, 'Untuk memahami, merespons, dan memprediksi perilaku klien terkait berbagai situasi dan peristiwa kehidupan', 1),
(3, 1, 'Untuk memastikan klien mengikuti semua nasihat keuangan yang diberikan', 0),
(4, 1, 'Untuk mengurangi kebutuhan akan teknologi dalam perencanaan keuangan', 0),
(5, 2, 'Mereka sangat cocok dengan perencanaan keuangan modern', 0),
(6, 2, 'Mereka dirancang untuk membuat keputusan uang jangka panjang yang cerdas', 0),
(7, 2, 'Mereka dirancang untuk bertahan hidup dan mencari kepuasan instan, yang dapat menyebabkan keputusan keuangan yang buruk', 1),
(8, 2, 'Mereka berkembang dengan cepat seiring kemajuan teknologi', 0),
(9, 3, 'Karena klien sudah tahu apa yang harus dilakukan tetapi kesulitan menerapkannya karena psikologi keuangan mereka', 1),
(10, 3, 'Karena perencana keuangan tidak boleh memberikan nasihat langsung', 0),
(11, 3, 'Karena pakar media online menyediakan semua informasi yang diperlukan', 0),
(12, 3, 'Karena klien tidak tertarik pada perencanaan keuangan', 0),
(13, 4, 'Psikologi uang mereka sendiri dan latar belakang unik klien', 1),
(14, 4, 'Hanya aspek teknis dari perencanaan keuangan', 0),
(15, 4, 'Teknologi keuangan terbaru', 0),
(16, 4, 'Strategi keuangan standar untuk semua klien', 0),
(17, 5, 'Menggunakan pendekatan satu ukuran untuk semua', 0),
(18, 5, 'Memahami dan menangani pandangan dunia dan bias unik klien', 1),
(19, 5, 'Menghindari diskusi tentang latar belakang pribadi', 0),
(20, 5, 'Fokus hanya pada pengembalian keuangan yang cepat', 0),
(21, 6, 'Dengan menggunakan teknik yang terbukti yang sesuai dengan perasaan, pikiran, dan perilaku klien', 1),
(22, 6, 'Dengan menerapkan nasihat keuangan yang seragam untuk semua klien', 0),
(23, 6, 'Dengan meminimalkan interaksi dengan klien', 0),
(24, 6, 'Dengan fokus hanya pada alat-alat teknologi', 0),
(25, 7, 'Keterampilan (skills)', 0),
(26, 7, 'Pengetahuan (knowledge)', 0),
(27, 7, 'Sistem keyakinan (belief system)', 1),
(28, 7, 'Nasihat (advice)', 0),
(29, 8, 'Keterampilan mereka', 0),
(30, 8, 'Keyakinan mereka', 1),
(31, 8, 'Tools yang mereka gunakan', 0),
(32, 8, 'Status keuangan mereka', 0),
(33, 9, 'Mereka kurang pengetahuan', 0),
(34, 9, 'Mereka memiliki keterampilan yang salah', 0),
(35, 9, 'Mereka memiliki keyakinan tertentu', 1),
(36, 9, 'Rekomendasinya buruk', 0),
(37, 10, 'Keterampilan klien', 0),
(38, 10, 'Status keuangan klien', 0),
(39, 10, 'Keyakinan klien tentang konsultan dan uang', 1),
(40, 10, 'Alat yang tersedia bagi klien', 0),
(41, 11, 'Tingkat perilaku (behavioral level)', 0),
(42, 11, 'Tingkat pengetahuan (knowledge level)', 0),
(43, 11, 'Tingkat keterampilan (skills level)', 0),
(44, 11, 'Tingkat keyakinan (beliefs level)', 1),
(45, 12, 'Menyediakan lebih banyak tools untuk membantu menganalisis perilaku', 0),
(46, 12, 'Meningkatkan keterampilan mereka dengan memberikan latihan', 0),
(47, 12, 'Menggali keyakinan mereka dengan mengajukan pertanyaan spesifik', 1),
(48, 12, 'Meningkatkan pengetahuan mereka melalui berita terkini', 0),
(49, 13, 'Insting untuk menimbun sumber daya', 0),
(50, 13, 'Insting untuk berbagi sumber daya dalam komunitas', 1),
(51, 13, 'Insting untuk mengikuti rencana keuangan yang rinci', 0),
(52, 13, 'Insting untuk mengurangi pengeluaran', 0),
(53, 14, 'Karena berbagi dapat membantu individu mengumpulkan lebih banyak kekayaan', 0),
(54, 14, 'Karena berbagi adalah harapan sosial untuk menjaga hubungan komunitas yang kuat', 1),
(55, 14, 'Karena berbagi dapat memastikan semua orang memiliki sumber daya keuangan yang sama', 0),
(56, 14, 'Karena berbagi adalah persyaratan oleh hukum yang harus dilakukan', 0),
(57, 15, 'Mendorong strategi investasi jangka panjang', 0),
(58, 15, 'Menyebabkan pengeluaran impulsif dan kesulitan dalam menabung', 1),
(59, 15, 'Memotivasi penganggaran yang hati-hati', 0),
(60, 15, 'Tidak berdampak pada keputusan keuangan', 0),
(61, 16, 'Kecenderungan untuk mengikuti tujuan keuangan pribadi seperti seseorang yang tetap berpegang pada rencana pensiun mereka meskipun orang lain panik menjual saham.', 0),
(62, 16, 'Kecenderungan untuk mengikuti tindakan kelompok seperti investor yang menjual saham mereka hanya karena melihat orang lain melakukannya selama penurunan pasar.', 1),
(63, 16, 'Strategi untuk mendiversifikasi investasi seperti seseorang yang menyebarkan investasinya di berbagai aset untuk mengurangi risiko, bukan mengikuti tren populer.', 0),
(64, 16, 'Fokus pada perencanaan keuangan jangka panjang seperti investor yang tetap fokus pada tujuan pensiun meskipun ada fluktuasi pasar.', 0),
(65, 17, 'Dengan mendorong individu untuk lebih banyak menabung', 0),
(66, 17, 'Dengan memberikan tekanan sosial untuk mencegah orang lain memperbaiki situasi keuangan mereka', 1),
(67, 17, 'Dengan memotivasi orang untuk berbagi kekayaan mereka', 0),
(68, 17, 'Dengan mempromosikan investasi dalam portofolio yang beragam', 0),
(69, 18, 'Kecenderungan untuk fokus pada tujuan keuangan jangka panjang', 0),
(70, 18, 'Keinginan untuk tetap up-to-date dengan tren keuangan terbaru', 1),
(71, 18, 'Kebutuhan inheren untuk menabung dan berinvestasi dengan bijak', 0),
(72, 18, 'Keyakinan bahwa keputusan keuangan harus dibuat secara mandiri', 0),
(73, 19, 'Kondisi di mana seseorang merasa cukup dengan apa yang mereka miliki tanpa membandingkan dengan orang lain.', 0),
(74, 19, 'Perasaan tidak puas karena merasa memiliki lebih sedikit dibandingkan dengan orang lain di sekitar mereka.', 1),
(75, 19, 'Situasi di mana seseorang menilai kesejahteraan mereka berdasarkan tujuan keuangan pribadi yang tidak dipengaruhi oleh orang lain.', 0),
(76, 19, 'Keadaan di mana seseorang fokus pada pengembangan diri tanpa memperhatikan status orang lain dalam komunitas mereka.', 0),
(77, 20, 'Dengan mendorong mereka untuk mengabaikan pengaruh sosial dan fokus pada tujuan keuangan pribadi.', 0),
(78, 20, 'Dengan mendorong mereka untuk menyesuaikan kebiasaan keuangan agar sesuai dengan norma kelompok sosial mereka.', 1),
(79, 20, 'Dengan mengarahkan perhatian pada manajemen keuangan jangka pendek tanpa mempertimbangkan status sosial.', 0),
(80, 20, 'Dengan hanya memperhatikan aspek teknis keuangan dan mengabaikan pandangan orang lain terhadap keputusan mereka.', 0),
(81, 21, 'Sistem 1 rasional dan memperhitungkan segalanya, sedangkan Sistem 2 irasional dan sangat emosional', 0),
(82, 21, 'Sistem 1 menangani respon segera, sedangkan Sistem 2 fokus pada pengambilan keputusan yang kompleks', 1),
(83, 21, 'Sistem 1 berfokus pada perencanaan jangka pendek, sedangkan Sistem 2 menangani tujuan jangka panjang', 0),
(84, 21, 'Sistem 1 berfokus pada strategi investasi, sedangkan Sistem 2 menangani pengeluaran sehari-hari', 0),
(85, 22, 'Dengan mengesampingkan insting dasar yang telah tertanam sejak zaman prasejarah yang dapat mempengaruhi perilaku keuangan klien secara signifikan.', 0),
(86, 22, 'Dengan membantu klien memahami dan mengendalikan kecenderungan keuangan alami mereka yang berasal dari insting dan kebiasaan masa lalu.', 1),
(87, 22, 'Dengan menetapkan aturan keuangan yang ketat dengan harapan aspek psikologis dan kebutuhan individu klien terpenuhi.', 0),
(88, 22, 'Dengan memfokuskan perhatian pada penggunaan tools keuangan modern tanpa mempertimbangkan faktor psikologis lainnya.', 0),
(89, 23, 'Availability Bias', 0),
(90, 23, 'Anchoring Heuristic', 1),
(91, 23, 'Bandwagon Effect', 0),
(92, 23, 'Confirmation Bias', 0),
(93, 24, 'Availability Bias', 1),
(94, 24, 'Disposition Effect', 0),
(95, 24, 'Status Quo Bias', 0),
(96, 24, 'Recency Effect', 0),
(97, 25, 'Bandwagon Effect', 1),
(98, 25, 'Anchoring Heuristic', 0),
(99, 25, 'Confirmation Bias', 0),
(100, 25, 'Overconfidence', 0),
(101, 26, 'Confirmation Bias', 1),
(102, 26, 'Endowment Effect', 0),
(103, 26, 'Loss Aversion', 0),
(104, 26, 'Recency Effect', 0),
(105, 27, 'Recency Effect', 1),
(106, 27, 'Anchoring Heuristic', 0),
(107, 27, 'Availability Bias', 0),
(108, 27, 'Confirmation Bias', 0),
(109, 28, 'Dengan mendengarkan aktif dan memperhatikan tanda-tanda bias kognitif dalam proses pengambilan keputusan klien.', 1),
(110, 28, 'Dengan mengabaikan bias kognitif dan fokus hanya pada aspek teknis dari keuangan klien.', 0),
(111, 28, 'Dengan memberikan semua keputusan keuangan sepenuhnya kepada klien tanpa memberikan masukan apapun.', 0),
(112, 28, 'Dengan mendorong klien untuk tetap pada kebiasaan lama mereka tanpa perlu perubahan.', 0),
(113, 29, 'Untuk membantu klien membuat keputusan berdasarkan fakta dan analisis rasional daripada emosi atau bias.', 1),
(114, 29, 'Untuk memastikan klien hanya berinvestasi dalam produk keuangan yang mereka sukai.', 0),
(115, 29, 'Untuk membuat klien merasa nyaman dengan keputusan mereka tanpa mempertimbangkan dampaknya.', 0),
(116, 29, 'Untuk menekankan pentingnya hanya menggunakan tools keuangan modern dalam perencanaan.', 0),
(117, 30, 'Untuk membayangkan kegagalan masa depan dan memperbaiki kesalahan yang mungkin terjadi sebelumnya.', 1),
(118, 30, 'Untuk mengabaikan semua potensi risiko dan fokus hanya pada keuntungan.', 0),
(119, 30, 'Untuk mempertahankan pendekatan yang sama meskipun ada bukti bahwa strategi tersebut gagal.', 0),
(120, 30, 'Untuk memastikan bahwa semua keputusan diambil berdasarkan optimisme berlebihan.', 0),
(121, 31, 'Dengan membayangkan bahwa pilihan yang dipilih tidak tersedia lagi dan mempertimbangkan alternatif lainnya.', 1),
(122, 31, 'Dengan tetap fokus pada pilihan yang paling umum dan mengabaikan alternatif lain.', 0),
(123, 31, 'Dengan memastikan bahwa semua pilihan diambil berdasarkan emosi dan pengalaman masa lalu.', 0),
(124, 31, 'Dengan mengabaikan semua pilihan yang ada dan tidak membuat keputusan.', 0),
(125, 32, 'Untuk melihat situasi dari perspektif lain, seolah-olah klien memberi nasihat kepada teman, sehingga lebih objektif dan mengurangi bias.', 1),
(126, 32, 'Untuk memastikan mereka hanya mengikuti tren pasar tanpa mempertimbangkan kebutuhan unik klien.', 0),
(127, 32, 'Untuk fokus hanya pada keuntungan jangka pendek dan mengabaikan risiko jangka panjang.', 0),
(128, 32, 'Untuk mengabaikan masukan dari klien dan membuat keputusan sepihak berdasarkan pengalaman pribadi perencana.', 0),
(129, 33, 'Karena nilai budaya klien dapat mempengaruhi penerimaan sosial', 1),
(130, 33, 'Karena nilai budaya tidak berpengaruh pada keputusan keuangan', 0),
(131, 33, 'Karena nilai budaya hanya relevan dalam konteks investasi luar negeri', 0),
(132, 33, 'Karena nilai budaya membantu klien menghindari pengeluaran yang tidak perlu', 0),
(133, 34, 'Semua generasi di Indonesia memiliki pandangan yang sama mengenai investasi, terlepas dari pengalaman dan kondisi ekonomi mereka', 1),
(134, 34, 'Generasi Baby Boomer lebih fokus pada menabung dan keamanan finansial, sementara Generasi Z lebih cenderung berinvestasi dalam aset berisiko tinggi seperti cryptocurrency', 0),
(135, 34, 'Generasi Milenial lebih cenderung mengutamakan pengalaman hidup dan keseimbangan antara kehidupan dan pekerjaan dibandingkan menabung untuk masa depan', 0),
(136, 34, 'Generasi Gen X biasanya lebih berhati-hati dalam investasi dan lebih memilih aset tradisional seperti properti dan obligasi', 0),
(137, 35, 'Dapat menyebabkan ketegangan dan isolasi bagi anggota yang memiliki status sosial yang lebih tinggi', 1),
(138, 35, 'Menimbulkan keseimbangan yang sempurna dalam memberi dan menerima', 0),
(139, 35, 'Memungkinkan setiap anggota untuk mengabaikan kontribusi mereka dalam komunitas', 0),
(140, 35, 'Memastikan bahwa semua anggota keluarga mendapatkan keuntungan yang sama', 0),
(141, 36, 'Dengan membandingkan diri dengan gaya hidup orang lain dan memicu perasaan tidak memadai', 1),
(142, 36, 'Dengan memberikan informasi yang akurat tentang keuangan pribadi', 0),
(143, 36, 'Dengan mengabaikan tren pasar keuangan global', 0),
(144, 36, 'Dengan memastikan bahwa semua orang memiliki pandangan keuangan yang sama.', 0),
(145, 37, 'Karena komunitas dapat mempengaruhi nilai dan kebiasaan keuangan klien', 1),
(146, 37, 'Karena komunitas tidak berpengaruh pada pandangan keuangan klien', 0),
(147, 37, 'Karena komunitas selalu mendukung keputusan investasi yang klien buat', 0),
(148, 37, 'Karena komunitas membantu klien mendapatkan pinjaman dengan mudah', 0),
(149, 38, 'Dengan memahami pengaruh budaya dan komunitas masa kecil Rina, serta tekanan sosial dari lingkungan kerjanya saat ini agar sesuai nilai-nilai Rina', 1),
(150, 38, 'Dengan hanya fokus pada penghasilan Rina saat ini dan mengabaikan latar belakang budayanya', 0),
(151, 38, 'Dengan mengarahkan Rina untuk mengikuti gaya hidup dan keputusan investasi rekan-rekannya di Jakarta', 0),
(152, 38, 'Dengan menasihati Rina untuk sepenuhnya meninggalkan kebiasaan menabungnya dan berfokus pada investasi berisiko tinggi', 0),
(153, 39, 'Pengalaman hidup penting terkait uang yang membentuk kepercayaan dan perilaku keuangan seseorang hingga dewasa.', 1),
(154, 39, 'Keputusan keuangan sehari-hari yang tidak memiliki dampak jangka panjang.', 0),
(155, 39, 'Strategi investasi yang menguntungkan dalam jangka pendek.', 0),
(156, 39, 'Rencana keuangan yang dirancang untuk menghasilkan keuntungan besar dalam waktu singkat.', 0),
(157, 40, 'Menghasilkan mentalitas selalu kekurangan dan menyebabkan ketakutan.', 1),
(158, 40, 'Membuat seseorang merasa lebih percaya diri dalam mengelola uang tanpa rasa takut.', 0),
(159, 40, 'Menyebabkan seseorang tidak mempedulikan kebutuhan finansial mereka.', 0),
(160, 40, 'Mendorong seseorang untuk mengambil risiko finansial yang tinggi tanpa pertimbangan.', 0),
(161, 41, 'Dapat menyebabkan perasaan terasing dan tidak percaya pada orang lain, meskipun memiliki kekayaan materi.', 1),
(162, 41, 'Selalu menghasilkan sikap yang positif dan percaya diri terhadap uang.', 0),
(163, 41, 'Membuat seseorang cenderung mengabaikan pentingnya perencanaan keuangan.', 0),
(164, 41, 'Menghasilkan kebiasaan hidup hemat dan sederhana.', 0),
(165, 42, 'Bergantung pada semesta dan menghindari tanggung jawab keuangan pribadi.', 1),
(166, 42, 'Membantu menjadi lebih mandiri secara finansial.', 0),
(167, 42, 'Memastikan  tidak pernah mengalami masalah keuangan lagi.', 0),
(168, 42, 'Meningkatkan kepercayaan diri dalam mengelola keuangan sendiri.', 0),
(169, 43, 'Tidak memiliki dampak signifikan atau hanya mempengaruhi keputusan keuangan dalam jangka pendek.', 1),
(170, 43, 'Menghasilkan ketakutan bawah sadar terhadap kemakmuran finansial atau menyebabkan pola pikir yang kaku tentang uang.', 0),
(171, 43, 'Membentuk keyakinan dan perilaku keuangan secara tidak terduga, termasuk melalui kejadian kecil seperti permainan anak-anak.', 0),
(172, 43, 'Membuat seseorang lebih kompeten atau lebih positif dalam mengelola keuangan dan beradaptasi dengan perubahan keuangan.', 0),
(173, 44, 'Membuat perempuan untuk tidak perlu menghasilkan banyak uang.', 1),
(174, 44, 'Membuat perempuan lebih berani dalam mengambil risiko finansial.', 0),
(175, 44, 'Mendorong perempuan untuk selalu menjadi pencari nafkah utama.', 0),
(176, 44, 'Tidak memiliki dampak pada keputusan keuangan perempuan.', 0),
(177, 45, 'Sistem keyakinan tentang uang yang memengaruhi perilaku keuangan.', 1),
(178, 45, 'Rencana keuangan yang dirancang untuk penganggaran.', 0),
(179, 45, 'Kebijakan pemerintah mengenai mata uang.', 0),
(180, 45, 'Metode untuk menghitung tingkat bunga.', 0),
(181, 46, '\"Orang kaya serakah.\"', 1),
(182, 46, '\"Uang sama dengan kekuatan.\"', 0),
(183, 46, '\"Lebih banyak uang berarti lebih banyak kebahagiaan.\"', 0),
(184, 46, '\"Uang adalah alat untuk mencapai kebebasan.\"', 0),
(185, 47, 'Membuat seseorang enggan mengumpulkan kekayaan.', 1),
(186, 47, 'Menyebabkan perilaku menabung yang disiplin.', 0),
(187, 47, 'Memotivasi seseorang untuk bekerja lebih keras.', 0),
(188, 47, 'Menyebabkan seseorang mengambil risiko investasi tinggi.', 0),
(189, 48, '\"Lebih banyak uang akan membuat segalanya lebih baik.\"', 1),
(190, 48, '\"Uang adalah sumber semua masalah.\"', 0),
(191, 48, '\"Kebahagiaan tidak ada hubungannya dengan uang.\"', 0),
(192, 48, '\"Uang adalah sesuatu yang harus dihindari.\"', 0),
(193, 49, 'Mereka sering berpikir bahwa uang akan menyelesaikan semua masalah.', 1),
(194, 49, 'Mereka percaya bahwa kekayaan tidak akan memecahkan masalah mereka.', 0),
(195, 49, 'Mereka merasa uang tidak terlalu penting dalam kehidupan mereka.', 0),
(196, 49, 'Mereka percaya bahwa tidak ada cukup uang untuk kebutuhan dasar.', 0),
(197, 50, '\"Orang miskin tidak pantas memiliki uang.\"', 1),
(198, 50, '\"Uang tidak bisa membeli kebahagiaan.\"', 0),
(199, 50, '\"Uang hanya sebuah alat tukar.\"', 0),
(200, 50, '\"Kebahagiaan lebih penting dari kekayaan.\"', 0),
(201, 51, 'Mengakibatkan pengeluaran yang melebihi kemampuan.', 1),
(202, 51, 'Mendorong penghematan secara berlebihan.', 0),
(203, 51, 'Mengurangi kecenderungan untuk berbelanja.', 0),
(204, 51, 'Membuat seseorang merasa nyaman dengan pengeluarannya.', 0),
(205, 52, '\"Uang harus disimpan dan tidak dihabiskan.\"', 1),
(206, 52, '\"Uang seharusnya dihabiskan untuk kesenangan.\"', 0),
(207, 52, '\"Penting untuk meminjam uang ketika diperlukan.\"', 0),
(208, 52, '\"Tidak perlu khawatir tentang masa depan keuangan.\"', 0),
(209, 53, 'Mengakibatkan stres yang tidak perlu tentang uang.', 1),
(210, 53, 'Mengarah pada pengeluaran yang lebih boros.', 0),
(211, 53, 'Menyebabkan seseorang merasa aman dan nyaman.', 0),
(212, 53, 'Mengurangi kecemasan tentang masa depan keuangan.', 0),
(213, 54, 'Dengan membantu klien mengubah keyakinan finansial yang tidak sehat.', 1),
(214, 54, 'Dengan membuat keputusan investasi berdasarkan keyakinan pribadi perencana keuangan.', 0),
(215, 54, 'Dengan menawarkan diskon khusus untuk produk keuangan.', 0),
(216, 54, 'Dengan menentukan tujuan keuangan yang tidak realistis.', 0),
(217, 55, 'Menyebabkan utang konsumen yang tinggi dan masalah kesehatan.', 1),
(218, 55, 'Meningkatkan tabungan jangka panjang.', 0),
(219, 55, 'Membuat seseorang lebih bahagia dalam jangka panjang.', 0),
(220, 55, 'Mengurangi kebutuhan untuk bekerja keras.', 0),
(221, 56, 'Menghindari realitas keuangan dan mengabaikan kondisi keuangan.', 1),
(222, 56, 'Sering mengecek saldo bank dan membuat anggaran.', 0),
(223, 56, 'Menginvestasikan uang di berbagai aset.', 0),
(224, 56, 'Menabung lebih banyak daripada yang diperlukan.', 0),
(225, 57, 'Terlalu banyak pilihan sehingga tidak mampu untuk membuat keputusan.', 1),
(226, 57, 'Tidak memiliki cukup pilihan investasi.', 0),
(227, 57, 'Mengalami masalah utang yang besar.', 0),
(228, 57, 'Menghindari penggunaan teknologi dalam manajemen keuangan.', 0),
(229, 58, 'Menyembunyikan informasi keuangan dari pasangan.', 1),
(230, 58, 'Membagi semua informasi keuangan dengan pasangan.', 0),
(231, 58, 'Menyimpan uang dalam rekening bersama.', 0),
(232, 58, 'Melakukan investasi jangka panjang bersama.', 0),
(233, 59, 'Melibatkan anak-anak dalam masalah keuangan pribadi orang tua secara tidak pantas.', 1),
(234, 59, 'Memberikan dukungan keuangan kepada anak-anak dewasa dalam situasi darurat.', 0),
(235, 59, 'Mengajar anak-anak cara menabung sejak dini.', 0),
(236, 59, 'Menggunakan jasa penasihat keuangan profesional.', 0),
(237, 60, 'Menghalangi anak-anak untuk menjadi mandiri.', 1),
(238, 60, 'Membantu anak-anak menjadi lebih mandiri secara finansial.', 0),
(239, 60, 'Meningkatkan stabilitas keuangan anak-anak.', 0),
(240, 60, 'Membuat anak-anak lebih bertanggung jawab terhadap keuangan mereka.', 0),
(241, 61, 'Mendapat dukungan keuangan tanpa bekerja.', 1),
(242, 61, 'Kemampuan untuk mengelola uang secara mandiri.', 0),
(243, 61, 'Memiliki penghasilan yang tinggi.', 0),
(244, 61, 'Menabung sebagian besar pendapatan.', 0),
(245, 62, 'Seseorang yang terus-menerus berjudi meskipun mengalami kerugian finansial.', 1),
(246, 62, 'Seseorang yang berjudi sesekali di malam minggu untuk bersenang-senang.', 0),
(247, 62, 'Seseorang yang menabung untuk bermain poker di masa depan.', 0),
(248, 62, 'Seseorang yang hanya berjudi dalam jumlah kecil dan terkendali.', 0),
(249, 63, 'Seseorang yang berlebihan membeli barang-barang yang tidak dibutuhkan.', 1),
(250, 63, 'Seseorang yang membeli barang hanya saat ada diskon besar.', 0),
(251, 63, 'Seseorang yang hanya membeli barang-barang penting untuk kebutuhan sehari-hari.', 0),
(252, 63, 'Seseorang yang menghindari belanja barang-barang mewah.', 0),
(253, 64, 'Seseorang yang menyimpan uang tunai dalam jumlah besar.', 1),
(254, 64, 'Seseorang yang menyimpan beberapa barang sebagai kenang-kenangan.', 0),
(255, 64, 'Seseorang yang memiliki koleksi barang hobi yang tertata rapi.', 0),
(256, 64, 'Seseorang yang membeli barang-barang hanya saat diperlukan.', 0),
(257, 65, 'Mengidentifikasi perilaku keuangan yang bermasalah dan merujuk ke profesional kesehatan mental.', 1),
(258, 65, 'Mendiagnosis dan merawat gangguan tersebut sendiri.', 0),
(259, 65, 'Menyarankan klien untuk tidak mengubah perilaku mereka.', 0),
(260, 65, 'Mengabaikan masalah keuangan yang ada.', 0),
(261, 66, 'Ketidaksesuaian antara tujuan keuangan dengan perilaku keuangan.', 1),
(262, 66, 'Ketidaksesuaian antara keyakinan pribadi dan keyakinan orang lain.', 0),
(263, 66, 'Ketidakmampuan untuk membuat keputusan keuangan yang cepat.', 0),
(264, 66, 'Kesulitan dalam memahami kebijakan keuangan pemerintah.', 0),
(265, 67, 'Dengan membantu klien menyelaraskan tujuan keuangan ideal dengan tindakan nyata mereka.', 1),
(266, 67, 'Dengan mengabaikan keyakinan klien dan fokus pada strategi investasi.', 0),
(267, 67, 'Dengan mendorong klien untuk menghabiskan lebih banyak uang.', 0),
(268, 67, 'Dengan membuat semua keputusan keuangan untuk klien.', 0),
(269, 68, 'Perbedaan keyakinan keuangan dan pengalaman finansial sebelumnya.', 1),
(270, 68, 'Kesamaan pandangan tentang pengeluaran dan tabungan.', 0),
(271, 68, 'Kemampuan komunikasi yang baik tentang uang.', 0),
(272, 68, 'Keterbukaan tentang tujuan keuangan bersama.', 0),
(273, 69, 'Dengan mendorong pasangan untuk berkompromi secara terbuka tentang tujuan mereka.', 1),
(274, 69, 'Dengan memutuskan tujuan keuangan tanpa melibatkan pasangan dalam prosesnya.', 0),
(275, 69, 'Dengan menyarankan pasangan untuk menghindari diskusi tentang tujuan keuangan mereka.', 0),
(276, 69, 'Dengan memberikan perhatian hanya pada pasangan yang memiliki kendali lebih dalam hubungan.', 0),
(277, 70, 'Mereka berada dalam situasi di mana mereka harus mendukung baik anak-anak maupun orang tua secara finansial.', 1),
(278, 70, 'Mereka hanya perlu mengelola keuangan pribadi tanpa tanggung jawab tambahan.', 0),
(279, 70, 'Mereka menerima dukungan finansial dari orang tua dan tidak memiliki tanggung jawab keuangan lainnya.', 0),
(280, 70, 'Mereka hanya perlu menabung untuk masa depan sendiri tanpa memikirkan kebutuhan keluarga lainnya.', 0),
(281, 71, 'Dengan membantu klien menetapkan batasan keuangan yang sehat dan mengurangi ketergantungan keluarga.', 1),
(282, 71, 'Dengan mendorong klien untuk terus memberikan dukungan keuangan yang berlebihan.', 0),
(283, 71, 'Dengan menyarankan klien untuk meminjam uang dari anggota keluarga.', 0),
(284, 71, 'Dengan mengabaikan masalah keuangan yang ada.', 0),
(285, 72, 'Membuat hubungan menjadi tidak stabil jika tidak dibayar.', 1),
(286, 72, 'Meningkatkan hubungan karena adanya kepercayaan.', 0),
(287, 72, 'Mengurangi ketegangan dalam hubungan.', 0),
(288, 72, 'Membuat hubungan menjadi lebih dekat dan solid.', 0),
(289, 73, 'Dengan membantu klien membuat rencana pelunasan yang jelas sesuai ekspektasi.', 1),
(290, 73, 'Dengan menyarankan klien untuk meminjam uang lebih banyak dari teman.', 0),
(291, 73, 'Dengan menyarankan klien untuk tidak meminjam uang sama sekali.', 0),
(292, 73, 'Dengan mengabaikan masalah keuangan dengan orang lain.', 0),
(293, 74, 'Gejala (symptom)', 1),
(294, 74, 'Solusi (solution)', 0),
(295, 74, 'Strategi (strategy)', 0),
(296, 74, 'Situasi (situation)', 0),
(297, 75, 'Mereka adalah masalah mendasar di balik gejala.', 1),
(298, 75, 'Mereka adalah solusi yang diberikan oleh perencana.', 0),
(299, 75, 'Mereka adalah tujuan jangka panjang dari klien.', 0),
(300, 75, 'Mereka adalah tindakan segera yang harus diambil.', 0),
(301, 76, 'Hasil atau tujuan yang diinginkan oleh klien.', 1),
(302, 76, 'Tindakan segera yang diperlukan untuk mengatasi gejala.', 0),
(303, 76, 'Penyebab mendasar dari masalah.', 0),
(304, 76, 'Sumber daya yang tersedia untuk klien.', 0),
(305, 77, 'Mereka adalah skills dan tools klien yang dapat diberdayakan.', 1),
(306, 77, 'Mereka merujuk pada aset keuangan yang tersedia untuk klien.', 0),
(307, 77, 'Mereka tidak relevan dengan gejala dan penyebab klien.', 0),
(308, 77, 'Mereka mewakili solusi akhir dari masalah.', 0),
(309, 78, 'Mereka menunjukkan dampak jangka panjang dari mencapai tujuan.', 1),
(310, 78, 'Mereka adalah hasil langsung dari mengatasi simptom.', 0),
(311, 78, 'Mereka mencerminkan manfaat jangka pendek dari penyelesaian masalah.', 0),
(312, 78, 'Mereka menentukan penyebab masalah.', 0),
(313, 79, 'Mengatasi gejala yang terlihat dari masalah tersebut.', 1),
(314, 79, 'Fokus pada tujuan langsung klien.', 0),
(315, 79, 'Mengabaikan masalah dan fokus pada strategi investasi.', 0),
(316, 79, 'Membuat keputusan tanpa melibatkan klien.', 0),
(317, 80, 'Karena menangani gejala saja tidak akan menyelesaikan masalah mendasar.', 1),
(318, 80, 'Karena gejala selalu lebih mudah diperbaiki.', 0),
(319, 80, 'Karena penyebab lebih relevan untuk tindakan segera.', 0),
(320, 80, 'Karena penyebab tidak terkait dengan tujuan klien.', 0),
(321, 81, 'Ekspektasi (expectation)', 1),
(322, 81, 'Gejala (symptom)', 0),
(323, 81, 'Tujuan (objective)', 0),
(324, 81, 'Sumber daya (resource)', 0),
(325, 82, 'Untuk memberikan pendekatan yang komprehensif dalam jangka panjang.', 1),
(326, 82, 'Untuk memastikan perbaikan cepat terhadap simptom.', 0),
(327, 82, 'Untuk mengelola krisis segera dengan efektif.', 0),
(328, 82, 'Untuk menghindari pemahaman terhadap penyebab mendasar dari masalah.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `topic_id` int(11) UNSIGNED DEFAULT NULL,
  `completed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) UNSIGNED NOT NULL,
  `question` text DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `question_type` enum('multiple_choice','short_answer') NOT NULL,
  `correct_feedback` text DEFAULT NULL,
  `incorrect_feedback` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `image`, `question_type`, `correct_feedback`, `incorrect_feedback`, `created_at`, `updated_at`) VALUES
(1, 'Mengapa pemahaman tentang psikologi keuangan klien penting bagi perencana keuangan?', NULL, 'multiple_choice', 'Memahami psikologi keuangan klien penting karena memungkinkan perencana keuangan untuk memahami, merespons, dan bahkan memprediksi perilaku klien dalam berbagai situasi dan peristiwa kehidupan. Hal ini memastikan bahwa nasihat yang diberikan lebih personal dan relevan dengan kebutuhan unik klien.', 'Pilihan ini tidak tepat. Pemahaman tentang psikologi keuangan tidak bertujuan untuk mengembangkan strategi standar, memastikan kepatuhan penuh, atau mengurangi kebutuhan teknologi, melainkan untuk membantu perencana keuangan berinteraksi secara efektif dengan klien berdasarkan perilaku dan keyakinan unik mereka.', '2024-10-18 07:33:30', '2024-10-18 07:33:30'),
(2, 'Apa yang diberikan oleh materi ini tentang otak primal kita dan keputusan uang?', NULL, 'multiple_choice', 'Otak primal kita dirancang untuk bertahan hidup dan mencari kepuasan instan, yang sering kali dapat menyebabkan keputusan keuangan yang buruk. Dalam konteks keuangan modern, kecenderungan ini dapat mengakibatkan perilaku seperti pengeluaran berlebihan atau investasi yang tidak bijaksana.', 'Pilihan ini tidak tepat. Otak primal kita tidak cocok dengan perencanaan keuangan modern atau membuat keputusan uang jangka panjang yang cerdas. Sebaliknya, mereka lebih cenderung mendorong perilaku yang berfokus pada kepuasan instan daripada perencanaan jangka panjang yang diperlukan dalam keuangan.', '2024-10-21 06:36:30', '2024-10-21 06:36:30'),
(3, 'Menurut materi, mengapa tidak cukup hanya memberi tahu klien tindakan keuangan yang benar untuk diambil?', NULL, 'multiple_choice', 'Tidak cukup hanya memberi tahu klien tindakan keuangan yang benar karena klien sering kali sudah tahu apa yang harus dilakukan, tetapi kesulitan menerapkannya akibat pengaruh psikologi keuangan mereka. Tantangan emosional dan kebiasaan yang sudah tertanam membuat penerapan nasihat menjadi sulit.', 'Pilihan ini tidak tepat. Masalah utama bukanlah bahwa perencana keuangan tidak boleh memberikan nasihat atau bahwa klien tidak tertarik. Masalahnya adalah bahwa psikologi keuangan klien sering menjadi penghalang dalam menerapkan tindakan yang benar, bukan kurangnya informasi.', '2024-10-21 06:39:20', '2024-10-21 06:39:20'),
(4, 'Apa yang harus dipahami oleh perencana keuangan untuk membantu klien mengatasi hambatan mental terkait uang?', NULL, 'multiple_choice', 'Perencana keuangan harus memahami psikologi uang mereka sendiri dan latar belakang unik klien untuk membantu klien mengatasi hambatan mental terkait uang. Pemahaman ini memungkinkan perencana untuk memberikan nasihat yang lebih personal dan efektif.', 'Pilihan ini tidak tepat. Hanya memahami aspek teknis, teknologi terbaru, atau menggunakan strategi standar tidak cukup. Kunci untuk membantu klien adalah dengan memahami psikologi uang mereka dan bagaimana latar belakang unik mereka memengaruhi keputusan keuangan mereka.', '2024-10-21 06:40:47', '2024-10-21 06:40:47'),
(5, 'Menurut materi, apa yang penting dilakukan perencana keuangan saat membantu klien dengan tujuan keuangan mereka?', NULL, 'multiple_choice', 'Penting bagi perencana keuangan untuk memahami dan menangani pandangan dunia dan bias unik klien saat membantu mereka dengan tujuan keuangan. Pendekatan ini memastikan bahwa strategi yang dibuat selaras dengan kebutuhan dan aspirasi pribadi klien.', 'Pilihan ini tidak tepat. Menggunakan pendekatan satu ukuran untuk semua, menghindari diskusi tentang latar belakang pribadi, atau hanya fokus pada pengembalian cepat tidak akan membantu klien mencapai tujuan keuangan mereka secara efektif. Memahami dan menangani pandangan dunia dan bias klien adalah kunci keberhasilan.', '2024-10-21 06:41:37', '2024-10-21 06:41:37'),
(6, 'Bagaimana perencana keuangan harus mendekati klien mereka untuk memastikan perencanaan keuangan yang efektif?', NULL, 'multiple_choice', 'Perencana keuangan harus mendekati klien mereka dengan menggunakan teknik yang terbukti yang sesuai dengan perasaan, pikiran, dan perilaku klien. Pendekatan yang disesuaikan ini membantu memastikan perencanaan keuangan yang lebih efektif dan relevan.', 'Pilihan ini tidak tepat. Menerapkan nasihat seragam, meminimalkan interaksi, atau fokus hanya pada alat teknologi tidak akan memberikan hasil yang optimal. Perencanaan keuangan yang efektif membutuhkan pendekatan yang disesuaikan dengan kebutuhan psikologis dan perilaku unik setiap klien.', '2024-10-21 06:42:43', '2024-10-21 06:42:43'),
(7, 'Apa yang menjadi dasar utama seseorang bertindak dan sering terlupakan dalam analisis perilaku (behavioral analysis)?', NULL, 'multiple_choice', 'Sistem keyakinan merupakan dasar utama yang sering mempengaruhi tindakan seseorang. Keyakinan yang tertanam dalam diri seseorang dapat secara kuat mengarahkan perilaku mereka, bahkan tanpa disadari. Oleh karena itu, memahami sistem keyakinan sangat penting dalam analisis perilaku.', 'Pilihan ini tidak sepenuhnya tepat. Meskipun faktor seperti keterampilan, pengetahuan, atau nasihat dapat mempengaruhi tindakan seseorang, sistem keyakinan adalah dasar yang paling mendalam dan sering kali menjadi pendorong utama di balik perilaku seseorang. Memahami dan menganalisis sistem keyakinan seseorang dapat memberikan wawasan yang lebih mendalam tentang mengapa mereka bertindak dengan cara tertentu.', '2024-10-21 07:08:22', '2024-10-21 07:08:22'),
(8, 'Apa yang harus diperiksa untuk memahami perilaku seseorang terhadap uang, tabungan, dan konsultasi?', NULL, 'multiple_choice', 'Keyakinan seseorang mengenai uang, tabungan, dan konsultasi adalah aspek mendasar yang mempengaruhi perilaku mereka dalam hal keuangan. Dengan memahami keyakinan ini, kita dapat lebih memahami bagaimana mereka membuat keputusan keuangan dan mengapa mereka mungkin bertindak dengan cara tertentu.', 'Pilihan ini tidak sepenuhnya tepat. Meskipun keterampilan, tools, atau status keuangan mungkin berperan dalam perilaku keuangan seseorang, keyakinan mereka adalah elemen paling mendasar yang mempengaruhi keputusan mereka. Tanpa memahami keyakinan yang mendasari, sulit untuk mendapatkan gambaran lengkap tentang perilaku keuangan seseorang.', '2024-10-21 07:09:51', '2024-10-21 07:09:51'),
(9, 'Mengapa orang mungkin tidak bertindak berdasarkan rekomendasi?', NULL, 'multiple_choice', 'Orang mungkin tidak bertindak berdasarkan rekomendasi karena keyakinan mereka mungkin bertentangan dengan rekomendasi tersebut. Keyakinan yang kuat dapat mempengaruhi bagaimana seseorang menilai dan merespons nasihat, sehingga mereka mungkin mengabaikan atau menolak rekomendasi jika itu tidak sesuai dengan sistem keyakinan mereka.', 'Pilihan ini tidak sepenuhnya tepat. Meskipun kurangnya pengetahuan, keterampilan yang tidak tepat, atau kualitas rekomendasi bisa menjadi faktor, alasan utama orang tidak bertindak berdasarkan rekomendasi biasanya terkait dengan keyakinan mereka. Keyakinan yang kuat sering kali menjadi penghalang terbesar dalam menerima dan menerapkan nasihat atau rekomendasi.', '2024-10-21 07:10:46', '2024-10-21 07:10:46'),
(10, 'Apa yang harus selalu diperiksa oleh seorang konsultan pertama-tama?', NULL, 'multiple_choice', 'Keyakinan klien tentang konsultan dan uang adalah hal yang paling mendasar dan harus diperiksa terlebih dahulu oleh seorang konsultan. Keyakinan ini akan mempengaruhi bagaimana klien menerima saran dan menjalani proses konsultasi.', 'Meskipun keterampilan, status keuangan, atau alat yang tersedia penting, keyakinan klien adalah faktor utama yang perlu diperiksa terlebih dahulu. Keyakinan ini akan menentukan bagaimana klien berinteraksi dengan konsultan dan mempengaruhi seluruh proses konsultasi.', '2024-10-21 07:11:39', '2024-10-21 07:11:39'),
(11, 'Menurut konteks pada materi ini, di mana biasanya masalah klien berada?', NULL, 'multiple_choice', 'Masalah klien biasanya berada pada tingkat keyakinan. Keyakinan adalah fondasi yang mendasari perilaku dan keputusan klien, sehingga sering menjadi sumber masalah yang lebih mendalam dibandingkan dengan perilaku, pengetahuan, atau keterampilan.', 'Meskipun masalah dapat muncul pada tingkat perilaku, pengetahuan, atau keterampilan, masalah yang paling mendasar dan sering kali menjadi sumber utama adalah keyakinan klien. Keyakinan inilah yang membentuk cara klien berpikir dan bertindak dalam berbagai situasi.', '2024-10-21 07:12:39', '2024-10-21 07:12:39'),
(12, 'Apa yang direkomendasikan untuk membantu mengubah self-limiting belief?', NULL, 'multiple_choice', 'Menggali keyakinan mereka dengan mengajukan pertanyaan spesifik adalah cara yang efektif untuk membantu mengubah self-limiting belief. Pertanyaan yang tepat dapat membantu klien menyadari dan mempertanyakan keyakinan yang membatasi mereka, membuka jalan untuk perubahan positif.', 'Meskipun meningkatkan keterampilan, menyediakan tools, atau memperbarui pengetahuan dapat bermanfaat, perubahan yang signifikan pada self-limiting belief biasanya terjadi ketika keyakinan tersebut digali dan ditantang melalui pertanyaan yang mendalam dan spesifik.', '2024-10-21 07:13:39', '2024-10-21 07:13:39'),
(13, 'Apa insting bertahan hidup utama yang diwarisi dari leluhur kita yang mempengaruhi perilaku keuangan saat ini?', NULL, 'multiple_choice', 'Insting untuk berbagi sumber daya dalam komunitas adalah salah satu insting bertahan hidup utama yang diwarisi dari leluhur kita. Insting ini mempengaruhi perilaku keuangan saat ini, di mana dorongan untuk berbagi dengan orang lain sering kali mengalahkan keinginan untuk menabung atau menimbun sumber daya.', 'Pilihan ini tidak tepat. Insting utama yang diwarisi bukanlah menimbun sumber daya atau mengikuti rencana keuangan yang rinci. Sebaliknya, dorongan kuat untuk berbagi dalam komunitas adalah yang paling berpengaruh, sering kali mempengaruhi perilaku keuangan dengan cara yang mungkin tidak mendukung akumulasi kekayaan.', '2024-10-21 08:41:29', '2024-10-21 08:41:29'),
(14, 'Mengapa berbagi sumber daya masih menjadi tekanan dalam banyak komunitas saat ini?', NULL, 'multiple_choice', 'Berbagi sumber daya masih menjadi tekanan dalam banyak komunitas saat ini karena berbagi adalah harapan sosial untuk menjaga hubungan komunitas yang kuat. Ini adalah sisa dari insting bertahan hidup leluhur kita, di mana kelangsungan hidup sangat bergantung pada ikatan sosial yang kuat dan berbagi sumber daya dengan anggota suku.', 'Pilihan ini tidak tepat. Berbagi tidak selalu membantu mengumpulkan kekayaan atau memastikan kesetaraan sumber daya di komunitas, dan bukan merupakan persyaratan hukum. Tekanan untuk berbagi lebih terkait dengan kebutuhan untuk menjaga hubungan sosial yang kuat dan rasa kebersamaan dalam komunitas.', '2024-10-21 08:48:09', '2024-10-21 08:48:09'),
(15, 'Bagaimana kemajuan teknologi yang mendorong budaya kepuasan instan mempengaruhi perencanaan keuangan?', NULL, 'multiple_choice', 'Kemajuan teknologi yang mendorong budaya kepuasan instan sering kali menyebabkan pengeluaran impulsif dan kesulitan dalam menabung. Dengan akses mudah ke barang dan jasa, orang cenderung lebih mudah tergoda untuk membeli secara impulsif, yang dapat menghambat kemampuan mereka untuk menabung dan merencanakan keuangan jangka panjang.', 'Pilihan ini tidak tepat. Budaya kepuasan instan biasanya tidak mendorong strategi investasi jangka panjang atau penganggaran yang hati-hati. Sebaliknya, hal ini lebih sering mengakibatkan perilaku keuangan yang impulsif dan tidak terencana, yang dapat berdampak negatif pada stabilitas keuangan seseorang.', '2024-10-21 08:49:10', '2024-10-21 08:49:10'),
(16, 'Apa yang dimaksud dengan \"insting kawanan\" dalam konteks perilaku keuangan?', NULL, 'multiple_choice', 'Kecenderungan untuk mengikuti tindakan kelompok seperti investor yang menjual saham mereka hanya karena melihat orang lain melakukannya selama penurunan pasar. Ini adalah contoh klasik dari \"insting kawanan,\" di mana seseorang mengikuti keputusan kelompok tanpa mempertimbangkan analisis pribadi atau data yang lebih mendalam, yang sering kali dapat menyebabkan keputusan investasi yang buruk.', 'Pilihan ini tidak tepat. Insting kawanan tidak berkaitan dengan mengikuti tujuan keuangan pribadi, diversifikasi investasi, atau fokus pada perencanaan jangka panjang. Ketiga hal tersebut melibatkan analisis individu dan perencanaan yang matang, berbeda dengan insting kawanan yang mengarahkan seseorang untuk mengikuti keputusan kelompok tanpa pemikiran kritis.', '2024-10-21 08:50:05', '2024-10-21 08:50:05'),
(17, 'Bagaimana \"efek jeruji kepiting\" terwujud dalam perilaku keuangan?', NULL, 'multiple_choice', '\"Efek jeruji kepiting\" terwujud dalam perilaku keuangan dengan memberikan tekanan sosial untuk mencegah orang lain memperbaiki situasi keuangan mereka. Misalnya, ketika seseorang mencoba meningkatkan kondisi finansial mereka, orang-orang di sekitarnya mungkin secara tidak sadar menarik mereka kembali dengan kritik atau rasa iri, mirip dengan kepiting yang menarik kembali teman-temannya ke dalam keranjang.', 'Pilihan ini tidak tepat. \"Efek jeruji kepiting\" tidak mendorong menabung, memotivasi berbagi kekayaan, atau mempromosikan diversifikasi investasi. Sebaliknya, efek ini menciptakan tekanan untuk tetap dalam status quo dan dapat menghalangi upaya seseorang untuk memperbaiki keuangan mereka.', '2024-10-21 08:50:59', '2024-10-21 08:50:59'),
(18, 'Apa pendorong signifikan di balik FOMO (Fear of Missing Out) dalam keputusan keuangan?', NULL, 'multiple_choice', 'Keinginan untuk tetap up-to-date dengan tren keuangan terbaru adalah pendorong signifikan di balik FOMO (Fear of Missing Out) dalam keputusan keuangan. Misalnya, investor mungkin merasa terdorong untuk membeli saham atau aset yang sedang naik daun hanya karena melihat orang lain melakukannya, tanpa melakukan analisis mendalam terlebih dahulu, karena mereka takut ketinggalan keuntungan.', 'Pilihan ini tidak tepat. FOMO bukan tentang fokus pada tujuan keuangan jangka panjang, kebutuhan untuk menabung dan berinvestasi dengan bijak, atau keyakinan untuk membuat keputusan secara mandiri. Sebaliknya, FOMO sering kali didorong oleh tekanan sosial dan keinginan untuk mengikuti tren yang sedang populer, yang dapat mengarah pada keputusan impulsif.', '2024-10-21 08:51:47', '2024-10-21 08:51:47'),
(19, 'Apa yang dimaksud dengan deprivasi relatif?', NULL, 'multiple_choice', 'Deprivasi relatif adalah perasaan tidak puas karena merasa memiliki lebih sedikit dibandingkan dengan orang lain di sekitar mereka. Misalnya, seseorang yang memiliki rumah yang nyaman tetapi merasa tidak puas setelah melihat rumah yang lebih besar dan lebih mewah milik tetangganya, mengalami deprivasi relatif karena mereka membandingkan kesejahteraan mereka dengan orang lain.', 'Pilihan ini tidak tepat. Deprivasi relatif tidak terjadi ketika seseorang merasa cukup, menilai kesejahteraan berdasarkan tujuan pribadi, atau fokus pada pengembangan diri tanpa membandingkan dengan orang lain. Sebaliknya, deprivasi relatif muncul dari perbandingan sosial yang dapat menyebabkan ketidakpuasan dan perasaan kurang beruntung.', '2024-10-21 08:52:44', '2024-10-21 08:52:44'),
(20, 'Bagaimana status sosial seseorang dapat mempengaruhi perilaku keuangan mereka?', NULL, 'multiple_choice', 'Status sosial seseorang dapat mempengaruhi perilaku keuangan mereka dengan mendorong mereka untuk menyesuaikan kebiasaan keuangan agar sesuai dengan norma kelompok sosial mereka. Misalnya, seseorang mungkin merasa terdorong untuk membeli barang-barang mewah atau mengikuti gaya hidup tertentu karena tekanan dari lingkungannya, meskipun hal ini mungkin tidak sesuai dengan kemampuan finansialnya.', 'Pilihan ini tidak tepat. Status sosial cenderung mempengaruhi seseorang untuk menyesuaikan perilaku keuangan mereka dengan norma kelompok, bukan untuk mengabaikan pengaruh sosial, fokus hanya pada jangka pendek, atau mengabaikan pandangan orang lain. Sebaliknya, status sosial seringkali menjadi faktor penting dalam bagaimana seseorang mengelola keuangan mereka.', '2024-10-21 08:53:29', '2024-10-21 08:53:29'),
(21, 'Bagaimana teori dua sistem yang dijelaskan oleh Daniel Kahneman dalam \"Thinking Fast and Slow\" mempengaruhi pengambilan keputusan keuangan?', NULL, 'multiple_choice', 'Dalam teori dua sistem yang dijelaskan oleh Daniel Kahneman, Sistem 1 menangani respon segera, seperti keputusan impulsif dalam pembelian, sedangkan Sistem 2 fokus pada pengambilan keputusan yang kompleks, seperti perencanaan investasi atau strategi keuangan jangka panjang. Ini menunjukkan bagaimana kedua sistem mempengaruhi cara kita membuat keputusan keuangan, dengan Sistem 1 yang cepat dan otomatis sering kali mengarahkan kita ke pilihan yang lebih emosional dan kurang dipikirkan.', 'Pilihan ini tidak tepat. Sistem 1 tidak rasional dan memperhitungkan segalanya; sebaliknya, ia bertindak cepat dan otomatis, sering kali berdasarkan naluri. Sistem 2 tidak irasional dan emosional; ia cenderung lebih lambat dan analitis, memproses informasi secara mendalam untuk pengambilan keputusan yang lebih matang. Teori ini menekankan bagaimana kedua sistem ini berfungsi dalam konteks pengambilan keputusan keuangan.', '2024-10-21 08:54:25', '2024-10-21 08:54:25'),
(22, 'Bagaimana perencana keuangan dapat membantu klien mengelola insting keuangan mereka?', NULL, 'multiple_choice', 'Perencana keuangan dapat membantu klien dengan memahami dan mengendalikan kecenderungan keuangan alami mereka yang berasal dari insting dan kebiasaan masa lalu. Misalnya, seorang perencana dapat bekerja dengan klien yang cenderung melakukan pembelian impulsif dengan mengidentifikasi pemicu perilaku tersebut dan merancang strategi untuk mengatasinya, seperti menetapkan batas pengeluaran atau membuat rencana anggaran yang lebih terstruktur. Pendekatan ini menghormati insting alami klien sambil memberikan alat untuk mengelola dan mengarahkan perilaku keuangan mereka ke arah yang lebih positif.', 'Pilihan lain tidak tepat karena mengesampingkan insting dasar (a) tidak realistis mengingat betapa mendalamnya mereka tertanam dalam perilaku manusia. Menetapkan aturan keuangan yang ketat tanpa memperhatikan aspek psikologis (c) atau hanya memfokuskan pada tools keuangan modern tanpa mempertimbangkan faktor psikologis (d) dapat mengabaikan kebutuhan individu klien dan mungkin tidak efektif dalam jangka panjang. Pendekatan yang mempertimbangkan aspek psikologis dan insting alami klien cenderung lebih berhasil dalam membantu mereka mencapai tujuan keuangan.', '2024-10-21 08:55:39', '2024-10-21 08:55:39'),
(23, 'Berikut ini adalah ilustrasi dialog antara perencana keuangan dengan klien. Bias kognitif atau heuristik apa yang sedang dialami oleh klien?<br/><br/>\r\n        FP: \"Bagaimana perasaan Anda tentang portofolio investasi Anda?\"<br/>\r\nC: \"Saya merasa khawatir. Saya membeli saham ini seharga Rp 10 juta, dan sekarang hanya bernilai Rp 8 juta. Saya ingin menunggu sampai kembali ke Rp 10 juta sebelum saya menjualnya.\"<br/>\r\nFP: \"Apakah Anda berpikir bahwa menunggu harga kembali ke Rp 10 juta adalah keputusan terbaik, atau ada faktor lain yang perlu dipertimbangkan?\"', 'fp_talk_to_client.webp', 'multiple_choice', 'Ini adalah ilustrasi dari Anchoring Heuristic, di mana klien terlalu bergantung pada harga pembelian awal (Rp 10 juta) sebagai titik referensi atau \"jangkar\" dalam membuat keputusan investasi. Klien merasa enggan untuk menjual sahamnya saat ini karena nilainya turun di bawah harga jangkar tersebut, meskipun faktor lain mungkin lebih relevan untuk dipertimbangkan.', 'Pilihan ini tidak tepat. Anchoring Heuristic lebih berkaitan dengan ketergantungan pada nilai awal sebagai titik referensi. Bias lain seperti Availability Bias atau Confirmation Bias tidak secara langsung terkait dengan keputusan ini. Bandwagon Effect juga tidak relevan dalam situasi ini karena tidak melibatkan pengaruh keputusan orang lain.', '2024-10-23 07:13:01', '2024-10-23 07:13:01'),
(24, 'Berikut ini adalah ilustrasi dialog antara perencana keuangan dengan klien. Bias kognitif atau heuristik apa yang sedang dialami oleh klien?<br/><br/>FP: \"Mengapa Anda memutuskan untuk menarik semua investasi Anda dari pasar saham?\"<br/>\r\nC: \"Saya melihat berita tentang kehancuran pasar saham minggu lalu. Saya tidak ingin kehilangan uang saya seperti orang-orang yang diwawancarai di TV.\"<br/>\r\nFP: \"Saya mengerti kekhawatiran Anda. Namun, penting untuk melihat data jangka panjang dan keseluruhan portofolio Anda.\"', 'fp_talk_to_client.webp', 'multiple_choice', 'Ini adalah ilustrasi dari Availability Bias, di mana klien membuat keputusan untuk menarik investasinya berdasarkan informasi yang mudah diingat dan emosional dari berita terbaru. Klien dipengaruhi oleh liputan media tentang kehancuran pasar saham, yang mengesampingkan data jangka panjang dan analisis yang lebih komprehensif.', 'Pilihan ini tidak tepat. Availability Bias berfokus pada bagaimana informasi yang paling mudah diingat (seperti berita) mempengaruhi keputusan. Disposition Effect berkaitan dengan kecenderungan menjual aset yang naik dan menahan yang turun, Status Quo Bias adalah kecenderungan untuk mempertahankan keadaan saat ini, dan Recency Effect adalah kecenderungan untuk lebih menekankan informasi terbaru, meskipun mirip, tidak sepenuhnya menjelaskan reaksi emosional terhadap berita seperti Availability Bias.', '2024-10-23 08:04:34', '2024-10-23 08:04:34'),
(25, 'Berikut ini adalah ilustrasi dialog antara perencana keuangan dengan klien. Bias kognitif atau heuristik apa yang sedang dialami oleh klien?<br/><br/>FP: \"Apa yang membuat Anda tertarik untuk berinvestasi di cryptocurrency ini?\"<br/>\r\nC: \"Semua teman saya berinvestasi di sini dan mereka bilang mereka mendapatkan keuntungan besar.\"<br/>\r\nFP: \"Menarik. Apakah Anda sudah melakukan riset sendiri tentang potensi dan risikonya?\"', 'fp_talk_to_client.webp', 'multiple_choice', 'Ini adalah ilustrasi dari Bandwagon Effect, di mana klien tertarik untuk berinvestasi dalam cryptocurrency karena mengikuti keputusan teman-temannya yang sudah berinvestasi dan mendapatkan keuntungan besar. Klien cenderung mengikuti tindakan kelompok tanpa melakukan analisis atau riset sendiri tentang potensi dan risiko investasi tersebut.', 'Pilihan ini tidak tepat. Bandwagon Effect lebih sesuai dalam situasi ini, di mana keputusan didasarkan pada apa yang dilakukan orang lain. Anchoring Heuristic berkaitan dengan ketergantungan pada nilai referensi tertentu, Confirmation Bias adalah kecenderungan untuk mencari informasi yang mendukung keyakinan yang sudah ada, dan Overconfidence adalah keyakinan berlebihan pada kemampuan atau pengetahuan diri sendiri, yang tidak tercermin dalam respons klien ini.', '2024-10-23 08:06:20', '2024-10-23 08:06:20'),
(26, 'Berikut ini adalah ilustrasi dialog antara perencana keuangan dengan klien. Bias kognitif atau heuristik apa yang sedang dialami oleh klien?<br/><br/>FP: \"Bagaimana Anda memilih saham-saham di portofolio Anda?\"<br/>\r\nC: \"Saya selalu percaya bahwa perusahaan teknologi adalah masa depan. Saya membaca artikel yang mendukung hal tersebut.\"<br/>\r\nFP: \"Apakah Anda pernah melihat artikel atau analisis yang menunjukkan risiko atau tantangan di sektor teknologi?\"', 'fp_talk_to_client.webp', 'multiple_choice', 'Ini adalah ilustrasi dari Confirmation Bias, di mana klien cenderung mencari dan mempercayai informasi yang mendukung keyakinan mereka bahwa perusahaan teknologi adalah masa depan, sambil mengabaikan atau tidak mempertimbangkan informasi yang mungkin menunjukkan risiko atau tantangan di sektor tersebut.', 'Pilihan ini tidak tepat. Confirmation Bias adalah kecenderungan untuk hanya mencari informasi yang mendukung keyakinan yang sudah ada, seperti yang ditunjukkan oleh klien dalam kasus ini. Endowment Effect berkaitan dengan menilai barang yang dimiliki lebih tinggi daripada nilainya, Loss Aversion adalah kecenderungan untuk menghindari kerugian lebih kuat daripada keinginan untuk meraih keuntungan, dan Recency Effect adalah kecenderungan untuk lebih mengingat informasi terbaru, yang tidak sepenuhnya relevan dalam konteks ini.', '2024-10-23 08:07:40', '2024-10-23 08:07:40'),
(27, 'Berikut ini adalah ilustrasi dialog antara perencana keuangan dengan klien. Bias kognitif atau heuristik apa yang sedang dialami oleh klien?<br/><br/>FP: \"Apakah Anda sudah memutuskan bagaimana Anda ingin mengalokasikan investasi baru Anda?\"<br/>\r\nC: \"Saya pikir saya akan memasukkan sebagian besar ke saham teknologi. Saya baru saja membaca artikel kemarin tentang bagaimana sektor teknologi akan terus tumbuh pesat.\"<br/>\r\nFP: \"Menarik. Apakah Anda juga mempertimbangkan informasi dari beberapa bulan lalu tentang volatilitas pasar teknologi?\"', 'fp_talk_to_client.webp', 'multiple_choice', 'Ini adalah ilustrasi dari Recency Effect, di mana klien cenderung terlalu fokus pada informasi terbaru (artikel yang dibaca kemarin) saat membuat keputusan investasi, mengabaikan data atau informasi sebelumnya yang mungkin lebih relevan atau memberikan gambaran yang lebih lengkap.', 'Pilihan ini tidak tepat. Recency Effect adalah kecenderungan untuk lebih menekankan informasi terbaru, seperti yang dilakukan klien dalam kasus ini. Anchoring Heuristic berhubungan dengan ketergantungan pada nilai referensi tertentu, Availability Bias melibatkan keputusan berdasarkan informasi yang mudah diingat atau paling menonjol, dan Confirmation Bias adalah kecenderungan untuk mencari informasi yang mendukung keyakinan yang sudah ada, yang tidak sepenuhnya menjelaskan perilaku klien dalam contoh ini.', '2024-10-23 08:08:50', '2024-10-23 08:08:50'),
(28, 'Bagaimana perencana keuangan dapat membantu klien mengidentifikasi bias kognitif mereka sendiri dalam pengambilan keputusan keuangan?', NULL, 'multiple_choice', 'Perencana keuangan dapat membantu klien mengidentifikasi bias kognitif mereka sendiri dalam pengambilan keputusan keuangan dengan mendengarkan aktif dan memperhatikan tanda-tanda bias kognitif dalam proses pengambilan keputusan klien. Dengan demikian, perencana dapat memberikan panduan yang lebih baik dan membantu klien membuat keputusan yang lebih rasional dan terinformasi.', 'Pilihan ini tidak tepat. Mengabaikan bias kognitif, memberikan semua keputusan kepada klien tanpa masukan, atau mendorong klien untuk tetap pada kebiasaan lama tanpa perubahan, semuanya dapat menghalangi kemampuan klien untuk membuat keputusan keuangan yang optimal dan mungkin memperburuk efek dari bias kognitif tersebut.', '2024-10-23 08:13:38', '2024-10-23 08:13:38'),
(29, 'Apa manfaat utama dari analisis objektif yang dilakukan oleh perencana keuangan bagi klien mereka?', NULL, 'multiple_choice', 'Manfaat utama dari analisis objektif yang dilakukan oleh perencana keuangan bagi klien mereka adalah untuk membantu klien membuat keputusan berdasarkan fakta dan analisis rasional daripada emosi atau bias. Ini memungkinkan klien untuk mengambil keputusan keuangan yang lebih tepat dan selaras dengan tujuan jangka panjang mereka.', 'Pilihan ini tidak tepat. Analisis objektif bertujuan untuk menghindari keputusan yang hanya didasarkan pada preferensi pribadi, kenyamanan, atau penggunaan eksklusif tools modern tanpa mempertimbangkan konteks dan fakta yang relevan. Fokus utamanya adalah memastikan bahwa keputusan didasarkan pada data yang akurat dan analisis yang rasional.', '2024-10-23 08:15:34', '2024-10-23 08:15:34'),
(30, 'Apa pentingnya teknik post-mortem dalam pengambilan keputusan keuangan?', NULL, 'multiple_choice', 'Penting untuk menggunakan teknik post-mortem dalam pengambilan keputusan keuangan untuk membayangkan kegagalan masa depan dan memperbaiki kesalahan yang mungkin terjadi sebelumnya. Dengan teknik ini, perencana keuangan dan klien dapat lebih siap menghadapi kemungkinan risiko dan membuat strategi yang lebih tahan terhadap kegagalan.', 'Pilihan ini tidak tepat. Teknik post-mortem bertujuan untuk mengantisipasi risiko dan memperbaiki kesalahan, bukan untuk mengabaikan risiko, bersikap terlalu optimis, atau mempertahankan strategi yang terbukti gagal. Teknik ini membantu menciptakan rencana yang lebih matang dan realistis dalam mencapai tujuan keuangan.', '2024-10-23 08:16:42', '2024-10-23 08:16:42'),
(31, 'Bagaimana cara teknik uji \"pilihan yang menghilang\" dapat membantu mengatasi bias kognitif dalam pengambilan keputusan?', NULL, 'multiple_choice', 'Teknik uji \"pilihan yang menghilang\" dapat membantu mengatasi bias kognitif dalam pengambilan keputusan dengan membayangkan bahwa pilihan yang dipilih tidak tersedia lagi dan mempertimbangkan alternatif lainnya. Ini mendorong individu untuk mengevaluasi opsi lain yang mungkin lebih baik dan membantu menghindari keterjebakan pada satu pilihan semata.', 'Pilihan ini tidak tepat. Teknik ini bertujuan untuk membuka pikiran terhadap alternatif lain, bukan untuk fokus pada pilihan umum, mengandalkan emosi atau pengalaman masa lalu, atau mengabaikan semua pilihan yang ada. Tujuannya adalah untuk memperluas perspektif dan menghindari bias yang mungkin membatasi keputusan yang optimal.', '2024-10-23 08:19:19', '2024-10-23 08:19:19'),
(32, 'Mengapa penting bagi perencana keuangan untuk mengadopsi sudut pandang eksternal dalam proses pengambilan keputusan?', NULL, 'multiple_choice', 'Penting bagi perencana keuangan untuk mengadopsi sudut pandang eksternal dalam proses pengambilan keputusan untuk melihat situasi dari perspektif lain, seolah-olah klien memberi nasihat kepada teman, sehingga lebih objektif dan mengurangi bias. Ini membantu perencana memberikan nasihat yang lebih seimbang dan rasional, serta mempertimbangkan semua aspek penting sebelum membuat keputusan.', 'Pilihan ini tidak tepat. Mengadopsi sudut pandang eksternal bertujuan untuk meningkatkan objektivitas, bukan untuk mengikuti tren pasar tanpa pertimbangan, fokus hanya pada keuntungan jangka pendek, atau mengabaikan masukan dari klien. Pendekatan ini mendukung pengambilan keputusan yang lebih bijaksana dan sesuai dengan kebutuhan klien.', '2024-10-23 08:20:09', '2024-10-23 08:20:09'),
(33, 'Mengapa penting bagi perencana keuangan untuk menghormati nilai-nilai budaya klien mereka?', NULL, 'multiple_choice', 'Penting bagi perencana keuangan untuk menghormati nilai-nilai budaya klien mereka karena nilai budaya klien dapat mempengaruhi penerimaan sosial. Misalnya, dalam budaya Tionghoa, investasi keluarga sering dianggap penting, sementara dalam budaya Batak, adat istiadat berperan besar dalam pengelolaan keuangan keluarga besar. Memahami dan menghormati nilai-nilai ini membantu perencana keuangan memberikan nasihat yang lebih relevan dan dapat diterima oleh klien mereka.', 'Pilihan ini tidak tepat. Nilai budaya sangat mempengaruhi keputusan keuangan, bukan hanya dalam konteks investasi luar negeri atau pengeluaran. Mengabaikan nilai-nilai budaya dapat menyebabkan miskomunikasi dan nasihat yang kurang efektif bagi klien.', '2024-10-24 08:26:54', '2024-10-24 08:26:54'),
(34, 'Manakah dari pernyataan berikut yang tidak benar mengenai perbedaan pandangan keuangan antar generasi misalkan di Indonesia?', NULL, 'multiple_choice', 'Pilihan lainnya benar karena mencerminkan perbedaan nyata dalam pandangan keuangan antar generasi. Baby Boomers cenderung fokus pada keamanan finansial dan menabung, Milenial lebih mengutamakan keseimbangan hidup dan pengalaman, sementara Gen X lebih konservatif dalam berinvestasi, sering memilih aset tradisional seperti properti dan obligasi.', 'Tidak semua generasi di Indonesia memiliki pandangan yang sama mengenai investasi, terlepas dari pengalaman dan kondisi ekonomi mereka. Setiap generasi memiliki karakteristik dan pandangan yang berbeda terhadap keuangan, yang dipengaruhi oleh pengalaman hidup, krisis ekonomi yang pernah dialami, serta perubahan teknologi dan sosial.', '2024-10-24 09:16:41', '2024-10-24 09:16:41'),
(35, 'Apa dampak dari memiliki status sosial yang berbeda dalam komunitas atau keluarga menurut teori pertukaran sosial?', NULL, 'multiple_choice', 'Memiliki status sosial yang lebih tinggi dalam komunitas atau keluarga dapat menyebabkan ketegangan dan isolasi. Menurut teori pertukaran sosial, ketidakseimbangan dalam memberi dan menerima dapat membuat anggota dengan status sosial yang lebih tinggi merasa terisolasi atau dimanfaatkan oleh anggota lain yang terus-menerus meminta bantuan finansial.', 'Pilihan ini tidak tepat. Keseimbangan sempurna jarang terjadi dalam realitas sosial. Mengabaikan kontribusi bertentangan dengan teori pertukaran sosial, dan keuntungan yang sama tidak selalu terjadi dalam dinamika sosial yang kompleks.', '2024-10-24 09:17:58', '2024-10-24 09:17:58'),
(36, 'Bagaimana media sosial dapat mempengaruhi pandangan seseorang tentang keuangan mereka?', NULL, 'multiple_choice', 'Media sosial dapat mempengaruhi pandangan seseorang tentang keuangan mereka dengan membandingkan diri dengan gaya hidup orang lain dan memicu perasaan tidak memadai. Paparan terhadap gaya hidup yang dipamerkan oleh orang lain di media sosial dapat membuat seseorang merasa kurang berhasil secara finansial, meskipun gambaran yang ditampilkan sering kali tidak mencerminkan realitas penuh.', 'Pilihan ini tidak tepat. Media sosial sering kali tidak memberikan informasi yang akurat atau seimbang tentang keuangan pribadi, mengabaikan tren pasar keuangan global, dan tidak memastikan bahwa semua orang memiliki pandangan keuangan yang sama. Sebaliknya, media sosial lebih sering memperkuat perbedaan dan perasaan tidak memadai di antara penggunanya.', '2024-10-24 09:18:46', '2024-10-24 09:18:46'),
(37, 'Mengapa penting bagi perencana keuangan untuk memahami komunitas tempat klien mereka dibesarkan?', NULL, 'multiple_choice', 'Penting bagi perencana keuangan untuk memahami komunitas tempat klien mereka dibesarkan karena komunitas dapat mempengaruhi nilai dan kebiasaan keuangan klien. Komunitas di mana seseorang tumbuh besar memainkan peran penting dalam membentuk pandangan mereka tentang uang, termasuk bagaimana mereka mengelola keuangan, menabung, dan berinvestasi.', 'Pilihan ini tidak tepat. Komunitas memiliki pengaruh signifikan terhadap pandangan keuangan seseorang, tidak hanya sekadar memberikan dukungan atau membantu mendapatkan pinjaman. Mengabaikan pengaruh komunitas dapat menyebabkan perencanaan keuangan yang kurang relevan dan efektif.', '2024-10-24 09:19:41', '2024-10-24 09:19:41'),
(38, 'Rina, dari pedesaan Jawa dengan tradisi menabung, kini bekerja di Jakarta di perusahaan teknologi dan terpengaruh gaya hidup mewah rekan-rekannya. Bagaimana perencana keuangan bisa mempertimbangkan lingkungan Rina dalam memberi nasihat?', 'fp_talk_to_rina.webp', 'multiple_choice', 'Perencana keuangan harus memahami pengaruh budaya dan komunitas masa kecil Rina, serta tekanan sosial dari lingkungan kerjanya saat ini agar nasihat yang diberikan sesuai dengan nilai-nilai dan kebiasaannya. Ini penting untuk memastikan bahwa rencana keuangan yang disarankan dapat diterima oleh Rina dan mendukung kesejahteraannya secara keseluruhan.', 'Pilihan ini tidak tepat. Hanya fokus pada penghasilan saat ini, mengabaikan latar belakang budaya, atau mendorong Rina untuk mengikuti gaya hidup yang tidak sesuai dengan nilai-nilainya dapat mengakibatkan keputusan keuangan yang tidak berkelanjutan dan kurang sesuai dengan kebutuhannya.', '2024-10-24 09:23:07', '2024-10-24 09:23:07'),
(39, 'Apa yang dimaksud dengan flashpoints keuangan?', NULL, 'multiple_choice', 'Flashpoints keuangan adalah pengalaman hidup penting terkait uang yang membentuk kepercayaan dan perilaku keuangan seseorang hingga dewasa. Peristiwa-peristiwa ini, seperti kemiskinan di masa kecil atau kehilangan pekerjaan, dapat meninggalkan dampak emosional yang berkelanjutan dan mempengaruhi cara seseorang mengelola uangnya di kemudian hari.', 'Pilihan ini tidak tepat. Flashpoints keuangan tidak merujuk pada keputusan keuangan sehari-hari, strategi investasi jangka pendek, atau rencana untuk keuntungan cepat. Sebaliknya, ini adalah peristiwa signifikan yang membentuk pandangan seseorang tentang uang dan memiliki dampak jangka panjang pada perilaku keuangan mereka.', '2024-10-25 08:30:01', '2024-10-25 08:30:01'),
(40, 'Bagaimana masa kecil dalam kemiskinan dapat mempengaruhi sikap seseorang terhadap uang?', NULL, 'multiple_choice', 'Masa kecil dalam kemiskinan dapat menghasilkan mentalitas selalu kekurangan dan menyebabkan ketakutan. Seseorang yang tumbuh dalam kondisi ini mungkin merasa cemas tentang uang, takut tidak memiliki cukup, dan cenderung sangat berhati-hati atau bahkan berlebihan dalam menabung dan menghindari pengeluaran.', 'Pilihan ini tidak tepat. Kemiskinan di masa kecil biasanya tidak membuat seseorang merasa percaya diri dalam mengelola uang tanpa rasa takut, mengabaikan kebutuhan finansial, atau mengambil risiko finansial tinggi tanpa pertimbangan. Sebaliknya, pengalaman ini seringkali menyebabkan ketakutan dan kecemasan yang mendalam terkait keuangan.', '2024-10-25 08:33:01', '2024-10-25 08:33:01'),
(41, 'Apa dampak masa kecil dalam kemewahan terhadap hubungan seseorang dengan uang di masa dewasa?', NULL, 'multiple_choice', 'Masa kecil dalam kemewahan dapat menyebabkan perasaan terasing dan tidak percaya pada orang lain, meskipun memiliki kekayaan materi. Seseorang mungkin merasa kesepian dan terputus dari orang-orang di sekitarnya, serta mengalami konflik emosional terkait kekayaan mereka, yang dapat mempengaruhi hubungan dan perilaku keuangan di masa dewasa.', 'Pilihan ini tidak tepat. Kemewahan di masa kecil tidak selalu menghasilkan sikap yang positif dan percaya diri terhadap uang, cenderung mengabaikan perencanaan keuangan, atau menghasilkan kebiasaan hidup hemat dan sederhana. Sebaliknya, hal ini bisa menyebabkan konflik internal dan perasaan terisolasi meskipun memiliki kekayaan.', '2024-10-25 08:34:28', '2024-10-25 08:34:28'),
(42, 'Adi selalu berharap kepada keluarganya untuk membantunya ketika membutuhkan uang. Apa yang bisa menjadi dampak dari seringnya Adi menerima penyelamatan keuangan dari orang lain?', NULL, 'multiple_choice', 'Seringnya menerima penyelamatan keuangan dari orang lain dapat membuat Adi bergantung pada semesta dan menghindari tanggung jawab keuangan pribadi. Ketergantungan ini dapat menghambat kemampuan Adi untuk belajar mengelola keuangannya sendiri dan menghadapi konsekuensi dari keputusan keuangannya.', 'Pilihan ini tidak tepat. Mengandalkan bantuan keuangan dari orang lain biasanya tidak membantu seseorang menjadi lebih mandiri secara finansial, memastikan mereka tidak pernah mengalami masalah keuangan lagi, atau meningkatkan kepercayaan diri dalam mengelola keuangan sendiri. Sebaliknya, hal ini justru bisa memperpanjang siklus ketergantungan dan menghambat kemandirian finansial.', '2024-10-25 08:35:14', '2024-10-25 08:35:14'),
(43, 'Manakah dari pernyataan berikut yang tidak benar mengenai pengaruh pengalaman masa kecil dan peristiwa traumatis terhadap sikap dan perilaku keuangan seseorang?', NULL, 'multiple_choice', 'Pengalaman masa kecil dan peristiwa traumatis biasanya memiliki dampak signifikan dan jangka panjang pada sikap dan perilaku keuangan seseorang. Pengalaman ini sering kali membentuk keyakinan mendasar tentang uang yang dapat mempengaruhi keputusan keuangan di masa dewasa.', 'Pilihan ini tidak tepat. Pengalaman masa kecil dan peristiwa traumatis memang dapat menyebabkan ketakutan bawah sadar, pola pikir kaku, atau keyakinan yang terbentuk secara tidak terduga, serta mempengaruhi kompetensi seseorang dalam mengelola keuangan dan beradaptasi dengan perubahan.', '2024-10-25 08:36:30', '2024-10-25 08:36:30'),
(44, 'Bagaimana norma gender konvensional dapat mempengaruhi pandangan perempuan terhadap uang?', 'discontent_man_woman.webp', 'multiple_choice', 'Norma gender konvensional dapat membuat perempuan merasa bahwa mereka tidak perlu menghasilkan banyak uang, karena peran tradisional sering kali menempatkan laki-laki sebagai pencari nafkah utama. Ini dapat membatasi keinginan dan keberanian perempuan untuk mencapai kemandirian finansial yang lebih tinggi.', 'Pilihan ini tidak tepat. Norma gender konvensional biasanya tidak mendorong perempuan untuk lebih berani dalam mengambil risiko finansial, menjadi pencari nafkah utama, atau tidak berdampak pada keputusan keuangan mereka. Sebaliknya, norma-norma ini cenderung membatasi pandangan dan ambisi keuangan perempuan.', '2024-10-25 08:39:08', '2024-10-25 08:39:08'),
(45, 'Mana dari pernyataan berikut yang paling tepat menggambarkan money script®?', NULL, 'multiple_choice', 'Money script® adalah sistem keyakinan tentang uang yang memengaruhi perilaku keuangan seseorang. Keyakinan ini sering kali dibentuk oleh pengalaman masa lalu dan dapat memengaruhi cara seseorang mengelola keuangan mereka.', 'Pilihan ini tidak tepat. Money script® tidak berkaitan dengan rencana penganggaran, kebijakan pemerintah mengenai mata uang, atau metode untuk menghitung tingkat bunga. Ini lebih tentang keyakinan dan pandangan individu yang mendalam mengenai uang.', '2024-10-25 08:47:30', '2024-10-25 08:47:30'),
(46, 'Keyakinan mana yang umumnya terkait dengan menghindari uang (money avoidance)?', 'money_avoidance.webp', 'multiple_choice', 'Keyakinan \"Orang kaya serakah\" umumnya terkait dengan menghindari uang (money avoidance). Orang dengan keyakinan ini mungkin merasa bahwa memiliki banyak uang adalah sesuatu yang negatif atau tidak etis, sehingga mereka cenderung menjauhi uang atau tidak mengelolanya dengan baik.', 'Pilihan ini tidak tepat. Keyakinan seperti \"Uang sama dengan kekuatan,\" \"Lebih banyak uang berarti lebih banyak kebahagiaan,\" atau \"Uang adalah alat untuk mencapai kebebasan\" biasanya tidak terkait dengan money avoidance, melainkan dengan pandangan yang lebih positif atau netral terhadap uang.', '2024-10-25 08:51:01', '2024-10-25 08:51:01'),
(47, 'Apa dampak dari keyakinan menghindari uang (money avoidance) terhadap perilaku keuangan seseorang?', 'money_avoidance.webp', 'multiple_choice', 'Keyakinan menghindari uang (money avoidance) dapat membuat seseorang enggan mengumpulkan kekayaan. Mereka mungkin merasa tidak nyaman memiliki banyak uang atau percaya bahwa kekayaan adalah sesuatu yang negatif, sehingga menghindari aktivitas yang dapat meningkatkan kekayaan mereka.', 'Pilihan ini tidak tepat. Money avoidance biasanya tidak menyebabkan perilaku menabung yang disiplin, memotivasi seseorang untuk bekerja lebih keras, atau mendorong mereka untuk mengambil risiko investasi tinggi. Sebaliknya, orang dengan keyakinan ini cenderung menghindari kegiatan yang berhubungan dengan pengelolaan atau pengumpulan kekayaan.', '2024-10-25 08:55:30', '2024-10-25 08:55:30'),
(48, 'Apa yang diyakini oleh orang-orang yang memiliki fokus uang (money focus)?', 'money_focus.webp', 'multiple_choice', 'Orang-orang yang memiliki fokus uang (money focus) sering meyakini bahwa \"Lebih banyak uang akan membuat segalanya lebih baik.\" Mereka cenderung melihat uang sebagai solusi untuk berbagai masalah dan percaya bahwa memiliki lebih banyak uang akan meningkatkan kualitas hidup mereka.', 'Pilihan ini tidak tepat. Keyakinan seperti \"Uang adalah sumber semua masalah,\" \"Kebahagiaan tidak ada hubungannya dengan uang,\" atau \"Uang adalah sesuatu yang harus dihindari\" biasanya tidak sesuai dengan pandangan orang yang memiliki fokus uang. Orang dengan money focus cenderung melihat uang sebagai sesuatu yang positif dan penting untuk mencapai kebahagiaan dan kesuksesan.', '2024-10-25 08:58:26', '2024-10-25 08:58:26'),
(49, 'Bagaimana sikap orang yang memuja uang (money focus/worship) terhadap masalah keuangan mereka?', 'money_focus.webp', 'multiple_choice', 'Orang yang memuja uang (money focus/worship) sering berpikir bahwa uang akan menyelesaikan semua masalah mereka. Mereka cenderung percaya bahwa memiliki lebih banyak uang adalah kunci untuk mengatasi berbagai tantangan hidup dan mencapai kebahagiaan.', 'Pilihan ini tidak tepat. Orang yang memuja uang biasanya tidak berpikir bahwa kekayaan tidak akan memecahkan masalah mereka, bahwa uang tidak penting, atau bahwa mereka kekurangan uang untuk kebutuhan dasar. Sebaliknya, mereka melihat uang sebagai solusi utama untuk banyak aspek kehidupan.', '2024-10-25 08:59:45', '2024-10-25 08:59:45'),
(50, 'Apa keyakinan umum dari mereka yang mementingkan status uang (money status)?', 'money_status.webp', 'multiple_choice', 'Keyakinan umum dari mereka yang mementingkan status uang (money status) adalah \"Orang miskin tidak pantas memiliki uang.\" Mereka sering mengaitkan kekayaan dengan nilai atau status seseorang, sehingga mereka melihat uang sebagai tanda keberhasilan dan merasa bahwa orang miskin tidak layak memiliki kekayaan.', 'Pilihan ini tidak tepat. Orang yang mementingkan status uang biasanya tidak meyakini bahwa \"Uang tidak bisa membeli kebahagiaan,\" \"Uang hanya sebuah alat tukar,\" atau \"Kebahagiaan lebih penting dari kekayaan.\" Sebaliknya, mereka cenderung melihat uang sebagai indikator status dan kesuksesan dalam masyarakat.', '2024-10-25 09:02:55', '2024-10-25 09:02:55'),
(51, 'Bagaimana keyakinan status uang (money status) dapat mempengaruhi perilaku pengeluaran seseorang?', 'money_status.webp', 'multiple_choice', 'Keyakinan status uang (money status) dapat mengakibatkan pengeluaran yang melebihi kemampuan seseorang. Orang dengan keyakinan ini sering kali menghabiskan uang untuk barang-barang mewah atau simbol status lainnya untuk menunjukkan kesuksesan, meskipun hal itu bisa melampaui kemampuan finansial mereka.', 'Pilihan ini tidak tepat. Keyakinan status uang biasanya tidak mendorong penghematan, mengurangi kecenderungan untuk berbelanja, atau membuat seseorang merasa nyaman dengan pengeluarannya. Sebaliknya, keyakinan ini cenderung mendorong perilaku konsumtif yang dapat berdampak negatif pada keuangan pribadi.', '2024-10-25 09:04:08', '2024-10-25 09:04:08'),
(52, 'Apa yang biasanya diyakini oleh mereka yang memiliki kewaspadaan uang (money vigilance)?', 'money_vigilance.webp', 'multiple_choice', 'Mereka yang memiliki kewaspadaan uang (money vigilance) biasanya meyakini bahwa \"Uang harus disimpan dan tidak dihabiskan.\" Orang dengan keyakinan ini cenderung sangat berhati-hati dalam pengeluaran dan lebih fokus pada menabung untuk masa depan.', 'Pilihan ini tidak tepat. Orang dengan kewaspadaan uang cenderung tidak percaya bahwa uang harus dihabiskan untuk kesenangan, penting untuk meminjam uang ketika diperlukan, atau tidak perlu khawatir tentang masa depan keuangan. Sebaliknya, mereka lebih fokus pada pengelolaan uang yang hati-hati dan menabung untuk menjaga stabilitas finansial.', '2024-10-25 09:06:26', '2024-10-25 09:06:26'),
(53, 'Apa dampak dari kewaspadaan uang (money vigilance) yang berlebihan?', 'money_vigilance.webp', 'multiple_choice', 'Kewaspadaan uang (money vigilance) yang berlebihan dapat mengakibatkan stres yang tidak perlu tentang uang. Orang yang terlalu waspada dengan uang cenderung selalu khawatir tentang keuangan mereka, bahkan ketika situasi keuangan mereka sebenarnya aman.', 'Pilihan ini tidak tepat. Kewaspadaan uang yang berlebihan tidak mengarah pada pengeluaran yang boros, menyebabkan seseorang merasa aman dan nyaman, atau mengurangi kecemasan tentang masa depan keuangan. Sebaliknya, hal ini cenderung meningkatkan stres dan kecemasan terkait pengelolaan uang.', '2024-10-25 09:07:25', '2024-10-25 09:07:25'),
(54, 'Bagaimana seorang perencana keuangan dapat menggunakan hasil Klontz Money Script® Inventory (KMSI) untuk membantu klien?', NULL, 'multiple_choice', 'Seorang perencana keuangan dapat menggunakan hasil Klontz Money Script® Inventory (KMSI) untuk membantu klien dengan membantu mereka mengubah keyakinan finansial yang tidak sehat. KMSI mengidentifikasi keyakinan dan pola pikir klien terkait uang, sehingga perencana keuangan dapat memberikan nasihat yang lebih personal dan relevan untuk memperbaiki perilaku keuangan yang tidak sehat.', 'Pilihan ini tidak tepat. KMSI tidak digunakan untuk membuat keputusan investasi berdasarkan keyakinan pribadi perencana, menawarkan diskon khusus, atau menentukan tujuan keuangan yang tidak realistis. Tujuan KMSI adalah untuk memahami keyakinan finansial klien dan membantu mereka membuat perubahan positif dalam pengelolaan keuangan mereka.', '2024-10-25 09:08:51', '2024-10-25 09:08:51'),
(55, 'Apa dampak utama dari pengeluaran berlebihan (overspending) pada kesejahteraan seseorang?', NULL, 'multiple_choice', 'Dampak utama dari pengeluaran berlebihan (overspending) adalah menyebabkan utang konsumen yang tinggi dan masalah kesehatan. Pengeluaran yang tidak terkendali sering kali berujung pada akumulasi utang yang besar, yang dapat menyebabkan stres, kecemasan, dan masalah kesehatan lainnya. Dalam situasi seperti ini, sangat penting untuk mempertimbangkan dukungan dari profesional kesehatan mental jika diperlukan, sesuai dengan kode etik.', 'Pilihan ini tidak tepat. Pengeluaran berlebihan tidak meningkatkan tabungan, tidak membuat seseorang lebih bahagia dalam jangka panjang, dan tidak mengurangi kebutuhan untuk bekerja keras. Sebaliknya, ini cenderung menambah beban finansial dan emosional, yang mungkin memerlukan intervensi dari profesional jika dampaknya cukup parah.', '2024-10-25 09:20:45', '2024-10-25 09:20:45');
INSERT INTO `questions` (`id`, `question`, `image`, `question_type`, `correct_feedback`, `incorrect_feedback`, `created_at`, `updated_at`) VALUES
(56, 'Apa karakteristik utama dari penyangkalan keuangan (financial denial)?', NULL, 'multiple_choice', 'Karakteristik utama dari penyangkalan keuangan (financial denial) adalah menghindari realitas keuangan dan mengabaikan kondisi keuangan. Individu yang mengalami penyangkalan keuangan cenderung tidak mau menghadapi masalah keuangan mereka, yang bisa menyebabkan masalah yang lebih besar di masa depan. Jika perilaku ini berlanjut dan berdampak signifikan pada kesejahteraan, merujuk ke profesional kesehatan mental mungkin diperlukan sesuai dengan kode etik.', 'Pilihan ini tidak tepat. Penyangkalan keuangan tidak terkait dengan sering mengecek saldo bank, membuat anggaran, menginvestasikan uang, atau menabung lebih banyak dari yang diperlukan. Sebaliknya, ini melibatkan penghindaran aktif terhadap aspek-aspek penting dari pengelolaan keuangan.', '2024-10-25 09:21:45', '2024-10-25 09:21:45'),
(57, 'Apa yang menyebabkan paralisis keuangan (financial paralysis)?', NULL, 'multiple_choice', 'Paralisis keuangan (financial paralysis) disebabkan oleh terlalu banyak pilihan sehingga tidak mampu untuk membuat keputusan. Ketika seseorang merasa kewalahan oleh banyaknya opsi yang tersedia, mereka mungkin mengalami kesulitan untuk mengambil tindakan yang tepat. Dalam kasus yang parah, kondisi ini bisa memerlukan bantuan dari profesional untuk mengatasi ketidakmampuan membuat keputusan, sesuai dengan kode etik.', 'Pilihan ini tidak tepat. Paralisis keuangan bukan disebabkan oleh kurangnya pilihan investasi, masalah utang, atau penghindaran teknologi dalam manajemen keuangan. Sebaliknya, ini terjadi ketika seseorang dihadapkan dengan terlalu banyak opsi dan merasa kewalahan, yang akhirnya menghambat pengambilan keputusan.', '2024-10-25 09:23:04', '2024-10-25 09:23:04'),
(58, 'Apa yang dimaksud dengan ketidakjujuran keuangan (financial infidelity) dalam sebuah hubungan?', NULL, 'multiple_choice', 'Ketidakjujuran keuangan (financial infidelity) dalam sebuah hubungan berarti menyembunyikan informasi keuangan dari pasangan. Ini bisa melibatkan menyembunyikan pengeluaran, utang, atau aset, yang dapat merusak kepercayaan dan menyebabkan masalah serius dalam hubungan. Jika ketidakjujuran ini menyebabkan dampak signifikan pada kesejahteraan pasangan, merujuk ke profesional kesehatan mental mungkin diperlukan, sesuai dengan kode etik.', 'Pilihan ini tidak tepat. Ketidakjujuran keuangan tidak melibatkan berbagi semua informasi, menyimpan uang dalam rekening bersama, atau melakukan investasi bersama. Sebaliknya, ini berkaitan dengan menyembunyikan informasi keuangan dari pasangan, yang dapat mengganggu keharmonisan hubungan.', '2024-10-25 09:24:10', '2024-10-25 09:24:10'),
(59, 'Apa contoh dari keterikatan keuangan (financial enmeshment)?', NULL, 'multiple_choice', 'Contoh dari keterikatan keuangan (financial enmeshment) adalah melibatkan anak-anak dalam masalah keuangan pribadi orang tua secara tidak pantas. Ini bisa termasuk berbagi informasi keuangan yang tidak sesuai atau meminta anak-anak untuk terlibat dalam keputusan keuangan yang seharusnya ditangani oleh orang dewasa. Jika hal ini menyebabkan dampak negatif pada kesejahteraan anak, merujuk ke profesional kesehatan mental mungkin diperlukan, sesuai dengan kode etik.', 'Pilihan ini tidak tepat. Keterikatan keuangan bukan tentang memberikan dukungan dalam situasi darurat, mengajar anak-anak menabung, atau menggunakan jasa penasihat keuangan. Sebaliknya, ini melibatkan pelanggaran batas yang sehat antara urusan keuangan orang tua dan anak-anak.', '2024-10-25 09:25:11', '2024-10-25 09:25:11'),
(60, 'Apa dampak negatif dari pemberian keuangan yang berlebihan (financial enabling) oleh orang tua kepada anak dewasa mereka?', NULL, 'multiple_choice', 'Dampak negatif dari pemberian keuangan yang berlebihan (financial enabling) oleh orang tua kepada anak dewasa mereka adalah menghalangi anak-anak untuk menjadi mandiri. Ketika orang tua terus-menerus memberikan bantuan keuangan, anak-anak mungkin menjadi terlalu bergantung dan gagal mengembangkan keterampilan untuk mengelola keuangan mereka sendiri. Dalam situasi ini, penting bagi perencana keuangan untuk mempertimbangkan merujuk keluarga ke profesional kesehatan mental sesuai dengan kode etik.', 'Pilihan ini tidak tepat. Pemberian keuangan yang berlebihan tidak membantu anak-anak menjadi mandiri, meningkatkan stabilitas keuangan mereka, atau membuat mereka lebih bertanggung jawab terhadap keuangan. Sebaliknya, hal ini dapat menghambat perkembangan kemandirian finansial mereka, dan jika diperlukan, rujukan ke profesional kesehatan mental harus dipertimbangkan.', '2024-10-25 09:26:12', '2024-10-25 09:26:12'),
(61, 'Apa tanda utama dari ketergantungan keuangan (financial dependence)?', NULL, 'multiple_choice', 'Tanda utama dari ketergantungan keuangan (financial dependence) adalah menerima dukungan keuangan tanpa bekerja. Individu yang bergantung secara finansial pada orang lain, tanpa usaha untuk mandiri secara ekonomi, menunjukkan tanda-tanda ketergantungan keuangan. Sesuai dengan kode etik, merujuk individu yang menunjukkan tanda-tanda ketergantungan yang parah ke profesional kesehatan mental mungkin diperlukan.', 'Pilihan ini tidak tepat. Ketergantungan keuangan tidak terkait dengan kemampuan mengelola uang secara mandiri, memiliki penghasilan tinggi, atau menabung sebagian besar pendapatan. Sebaliknya, ini melibatkan ketergantungan pada dukungan keuangan dari orang lain tanpa upaya untuk menjadi mandiri, dan intervensi profesional mungkin diperlukan untuk membantu individu tersebut.', '2024-10-25 09:27:41', '2024-10-25 09:27:41'),
(62, 'Apa contoh dari seseorang yang mungkin mengalami gangguan judi (gambling disorder)?', NULL, 'multiple_choice', 'Contoh dari seseorang yang mungkin mengalami gangguan judi (gambling disorder) adalah seseorang yang terus-menerus berjudi meskipun mengalami kerugian finansial. Orang dengan gangguan ini sulit berhenti berjudi bahkan ketika mereka menghadapi konsekuensi negatif yang signifikan. Dalam situasi seperti ini, penting untuk merujuk individu tersebut ke profesional kesehatan mental sesuai dengan kode etik.', 'Pilihan ini tidak tepat. Gangguan judi tidak dicirikan oleh berjudi sesekali untuk bersenang-senang, menabung untuk bermain di masa depan, atau berjudi dalam jumlah kecil dan terkendali. Jika perilaku berjudi menjadi tidak terkendali, merujuk ke profesional kesehatan mental adalah langkah yang tepat untuk mendapatkan bantuan.', '2024-10-25 09:28:55', '2024-10-25 09:28:55'),
(63, 'Manakah dari situasi berikut yang paling menggambarkan seseorang dengan gangguan pembelian kompulsif (compulsive buying disorder)?', NULL, 'multiple_choice', 'Seseorang yang berlebihan membeli barang-barang yang tidak dibutuhkan paling menggambarkan seseorang dengan gangguan pembelian kompulsif (compulsive buying disorder). Individu dengan gangguan ini merasa terdorong untuk terus membeli barang, seringkali sebagai cara untuk mengatasi emosi negatif, meskipun pembelian tersebut tidak diperlukan. Dalam kasus seperti ini, merujuk ke profesional kesehatan mental sesuai dengan kode etik adalah langkah yang tepat.', 'Pilihan ini tidak tepat. Gangguan pembelian kompulsif tidak terkait dengan membeli barang hanya saat ada diskon, hanya membeli barang-barang penting, atau menghindari belanja barang-barang mewah. Sebaliknya, ini melibatkan pembelian berlebihan yang tidak diperlukan dan seringkali tidak terkendali, yang mungkin memerlukan intervensi dari profesional kesehatan mental.', '2024-10-25 09:29:57', '2024-10-25 09:29:57'),
(64, 'Situasi mana yang mencerminkan seseorang dengan gangguan penimbunan (hoarding disorder)?', NULL, 'multiple_choice', 'Seseorang yang menyimpan uang tunai dalam jumlah besar dapat mencerminkan seseorang dengan gangguan penimbunan (hoarding disorder), terutama jika perilaku tersebut menyebabkan ketidaknyamanan atau mempengaruhi fungsi sehari-hari. Gangguan penimbunan tidak hanya berkaitan dengan benda fisik, tetapi juga dapat mencakup penumpukan uang dalam jumlah yang tidak proporsional. Jika perilaku ini menunjukkan tanda-tanda gangguan, penting untuk merujuk individu tersebut ke profesional kesehatan mental sesuai dengan kode etik.', 'Pilihan ini tidak tepat. Menyimpan beberapa barang sebagai kenang-kenangan, memiliki koleksi barang hobi yang tertata rapi, atau membeli barang-barang hanya saat diperlukan tidak mencerminkan gangguan penimbunan. Gangguan penimbunan melibatkan akumulasi barang atau uang yang berlebihan hingga mengganggu kehidupan sehari-hari, dan mungkin memerlukan intervensi profesional.', '2024-10-25 09:30:56', '2024-10-25 09:30:56'),
(65, 'Bagaimana perencana keuangan dapat berkontribusi dalam menangani klien dengan berbagai gangguan keuangan (money disorders) seperti yang disebutkan sebelumnya?', 'money_disorder.webp', 'multiple_choice', 'Perencana keuangan dapat berkontribusi dalam menangani klien dengan berbagai gangguan keuangan (money disorders) dengan mengidentifikasi perilaku keuangan yang bermasalah dan merujuk klien ke profesional kesehatan mental. Ini sesuai dengan kode etik yang mengarahkan perencana keuangan untuk tidak menangani masalah yang berada di luar keahlian mereka, tetapi untuk membantu klien mendapatkan dukungan yang tepat.', 'Pilihan ini tidak tepat. Perencana keuangan tidak seharusnya mendiagnosis atau merawat gangguan keuangan sendiri, menyarankan klien untuk tidak mengubah perilaku mereka, atau mengabaikan masalah keuangan yang ada. Sebaliknya, mereka harus bekerja dalam batas profesional mereka dan merujuk klien ke ahli yang tepat ketika diperlukan.', '2024-10-25 09:33:06', '2024-10-25 09:33:06'),
(66, 'Apa yang dimaksud dengan konflik antara diri ideal dan diri sebenarnya dalam konteks keuangan?', 'conflict_self.webp', 'multiple_choice', 'Konflik antara diri ideal dan diri sebenarnya dalam konteks keuangan merujuk pada ketidaksesuaian antara tujuan keuangan dengan perilaku keuangan. Ini terjadi ketika seseorang memiliki tujuan atau aspirasi keuangan yang jelas tetapi berjuang untuk menerapkan tindakan yang sesuai dengan tujuan tersebut, yang dapat menyebabkan ketegangan internal dan perasaan tidak puas.', 'Pilihan ini tidak tepat. Konflik antara diri ideal dan diri sebenarnya tidak berkaitan dengan ketidaksesuaian antara keyakinan pribadi dan keyakinan orang lain, ketidakmampuan untuk membuat keputusan keuangan yang cepat, atau kesulitan dalam memahami kebijakan keuangan pemerintah. Sebaliknya, ini lebih terkait dengan perbedaan antara apa yang seseorang inginkan secara finansial dan bagaimana mereka benar-benar berperilaku dalam hal keuangan.', '2024-10-25 09:44:22', '2024-10-25 09:44:22'),
(67, 'Bagaimana perencana keuangan dapat membantu klien mengatasi konflik dengan diri sendiri terkait keuangan?', 'conflict_self.webp', 'multiple_choice', 'Perencana keuangan dapat membantu klien mengatasi konflik dengan diri sendiri terkait keuangan dengan membantu klien menyelaraskan tujuan keuangan ideal dengan tindakan nyata mereka. Ini melibatkan mendukung klien dalam mengidentifikasi tujuan finansial mereka dan mengembangkan strategi yang memungkinkan mereka untuk bertindak sesuai dengan tujuan tersebut, sehingga mengurangi ketegangan internal.', 'Pilihan ini tidak tepat. Mengabaikan keyakinan klien, mendorong mereka untuk menghabiskan lebih banyak uang, atau membuat semua keputusan keuangan tanpa melibatkan klien tidak sesuai dengan peran perencana keuangan yang berfokus pada pemberdayaan klien dan menghormati nilai serta keyakinan mereka.', '2024-10-25 09:49:12', '2024-10-25 09:49:12'),
(68, 'Apa yang sering menjadi penyebab konflik keuangan antara pasangan?', 'discontent_man_woman.webp', 'multiple_choice', 'Penyebab umum konflik keuangan antara pasangan adalah perbedaan keyakinan keuangan dan pengalaman finansial sebelumnya. Pasangan sering membawa keyakinan dan kebiasaan keuangan yang berbeda ke dalam hubungan mereka, yang dapat menyebabkan ketegangan dan perselisihan jika tidak dikelola dengan baik.', 'Pilihan ini tidak tepat. Konflik keuangan biasanya tidak disebabkan oleh kesamaan pandangan tentang pengeluaran dan tabungan, kemampuan komunikasi yang baik, atau keterbukaan tentang tujuan keuangan bersama. Sebaliknya, konflik sering muncul ketika pasangan memiliki keyakinan atau pengalaman keuangan yang berbeda, yang bisa menjadi sumber perselisihan.', '2024-10-25 09:51:06', '2024-10-25 09:51:06'),
(69, 'Bagaimana seorang perencana keuangan dapat membantu pasangan dengan tujuan keuangan yang bertentangan?', 'discontent_man_woman.webp', 'multiple_choice', 'Seorang perencana keuangan dapat membantu pasangan dengan tujuan keuangan yang bertentangan dengan mendorong pasangan untuk berkompromi secara terbuka tentang tujuan mereka. Ini melibatkan fasilitasi diskusi yang jujur dan terbuka sehingga pasangan dapat menemukan solusi yang memuaskan bagi kedua belah pihak, sehingga mengurangi potensi konflik.', 'Pilihan ini tidak tepat. Memutuskan tujuan keuangan tanpa melibatkan pasangan, menyarankan mereka untuk menghindari diskusi, atau memberikan perhatian hanya pada satu pasangan yang memiliki kendali lebih tidak sesuai dengan peran perencana keuangan yang seharusnya mendukung kerjasama dan keseimbangan dalam hubungan keuangan pasangan.', '2024-10-25 09:52:11', '2024-10-25 09:52:11'),
(70, 'Bagaimana konflik keuangan dapat terjadi pada generasi sandwich (sandwich generation)?', 'conflict_family.webp', 'multiple_choice', 'Konflik keuangan pada generasi sandwich (sandwich generation) terjadi ketika mereka berada dalam situasi di mana mereka harus mendukung baik anak-anak maupun orang tua secara finansial. Tanggung jawab ganda ini dapat menimbulkan tekanan finansial dan emosional, karena mereka harus menyeimbangkan kebutuhan berbagai anggota keluarga dengan sumber daya yang terbatas.', 'Pilihan ini tidak tepat. Generasi sandwich biasanya tidak hanya mengelola keuangan pribadi tanpa tanggung jawab tambahan, tidak selalu menerima dukungan finansial dari orang tua, dan tidak fokus hanya pada menabung untuk masa depan sendiri. Sebaliknya, mereka menghadapi tantangan dalam mendukung dua generasi, yang sering kali menjadi sumber konflik keuangan.', '2024-10-25 09:54:18', '2024-10-25 09:54:18'),
(71, 'Bagaimana perencana keuangan dapat membantu klien yang mengalami konflik keuangan dengan keluarga?', 'conflict_family.webp', 'multiple_choice', 'Perencana keuangan dapat membantu klien yang mengalami konflik keuangan dengan keluarga dengan membantu klien menetapkan batasan keuangan yang sehat dan mengurangi ketergantungan keluarga. Ini penting untuk memastikan bahwa klien dapat menjaga stabilitas finansial mereka sendiri sambil tetap mendukung keluarga mereka secara bertanggung jawab.', 'Pilihan ini tidak tepat. Mendorong klien untuk memberikan dukungan keuangan yang berlebihan, menyarankan mereka untuk meminjam uang dari anggota keluarga, atau mengabaikan masalah keuangan yang ada tidak akan menyelesaikan konflik dan justru dapat memperburuk situasi finansial klien dan keluarganya.', '2024-10-25 09:56:30', '2024-10-25 09:56:30'),
(72, 'Apa dampak dari meminjam uang kepada teman terhadap hubungan persahabatan?', 'conflict_others.webp', 'multiple_choice', 'Dampak dari meminjam uang kepada teman terhadap hubungan persahabatan dapat membuat hubungan menjadi tidak stabil jika tidak dibayar. Ketika pinjaman tidak dilunasi sesuai kesepakatan, hal ini bisa menimbulkan ketegangan, rasa tidak percaya, dan bahkan merusak hubungan persahabatan.', 'Pilihan ini tidak tepat. Meminjam uang kepada teman biasanya tidak meningkatkan hubungan, mengurangi ketegangan, atau membuat hubungan lebih dekat dan solid. Sebaliknya, jika tidak dikelola dengan baik, hal ini bisa menjadi sumber konflik dan ketegangan dalam persahabatan.', '2024-10-25 09:58:20', '2024-10-25 09:58:20'),
(73, 'Bagaimana perencana keuangan dapat membantu klien mengatasi konflik keuangan dengan orang lain?', 'conflict_others.webp', 'multiple_choice', 'Perencana keuangan dapat membantu klien mengatasi konflik keuangan dengan orang lain dengan membantu klien membuat rencana pelunasan yang jelas sesuai ekspektasi. Dengan adanya rencana yang terstruktur dan disepakati, klien dapat mengurangi potensi ketegangan dan menjaga hubungan baik dengan pihak yang terlibat.', 'Pilihan ini tidak tepat. Menyarankan klien untuk meminjam lebih banyak uang, menyarankan untuk tidak meminjam uang sama sekali, atau mengabaikan masalah keuangan tidak akan membantu mengatasi konflik yang ada dan justru dapat memperburuk situasi. Pendekatan terbaik adalah membantu klien menyelesaikan kewajiban mereka dengan cara yang jelas dan terukur.', '2024-10-25 09:59:04', '2024-10-25 09:59:04'),
(74, 'Apa kepanjangan dari \"S\" dalam model SCORE?', NULL, 'multiple_choice', 'Kepanjangan dari \"S\" dalam model SCORE adalah Gejala (symptom). Dalam konteks model SCORE, \"S\" merujuk pada gejala, yaitu aspek yang terlihat atau masalah yang diidentifikasi oleh klien, yang sering kali merupakan manifestasi dari masalah yang lebih dalam.', 'Pilihan ini tidak tepat. \"S\" dalam model SCORE tidak merujuk pada solusi, strategi, atau situasi, melainkan pada gejala yang merupakan tanda awal dari masalah yang harus dianalisis lebih lanjut untuk menemukan penyebab utamanya.', '2024-10-25 10:07:56', '2024-10-25 10:07:56'),
(75, 'Apa peran \"Cause\" dalam model SCORE?', NULL, 'multiple_choice', 'Peran \"Cause\" dalam model SCORE adalah untuk mengidentifikasi masalah mendasar di balik gejala. Penyebab ini adalah akar dari masalah yang tampak di permukaan dan harus diidentifikasi untuk memberikan solusi yang efektif dan menyeluruh.', 'Pilihan ini tidak tepat. \"Cause\" dalam model SCORE bukanlah solusi yang diberikan oleh perencana, tujuan jangka panjang dari klien, atau tindakan segera yang harus diambil. Sebaliknya, ini adalah penyebab utama yang mendasari gejala yang dihadapi klien, dan mengatasi penyebab ini adalah kunci untuk penyelesaian masalah yang efektif.', '2024-10-25 10:09:03', '2024-10-25 10:09:03'),
(76, 'Apa yang dimaksud dengan \"Objective\" dalam model SCORE?', NULL, 'multiple_choice', '\"Objective\" dalam model SCORE merujuk pada hasil atau tujuan yang diinginkan oleh klien. Ini adalah target yang ingin dicapai klien sebagai solusi atas masalah atau gejala yang mereka alami.', 'Pilihan ini tidak tepat. \"Objective\" dalam model SCORE bukanlah tindakan segera untuk mengatasi gejala, penyebab mendasar dari masalah, atau sumber daya yang tersedia untuk klien. Sebaliknya, ini adalah tujuan akhir yang ingin dicapai oleh klien melalui perencanaan dan tindakan yang tepat.', '2024-10-25 10:10:18', '2024-10-25 10:10:18'),
(77, 'Mengapa \"Resource\" dianggap penting dalam model SCORE?', NULL, 'multiple_choice', '\"Resource\" dianggap penting dalam model SCORE karena mereka adalah skills dan tools klien yang dapat diberdayakan. Sumber daya ini bisa berupa pengetahuan, keterampilan, atau alat yang dapat digunakan oleh klien untuk mengatasi masalah dan mencapai tujuan mereka.', 'Pilihan ini tidak tepat. \"Resource\" dalam model SCORE tidak merujuk hanya pada aset keuangan yang tersedia, tidak dianggap tidak relevan dengan gejala dan penyebab, atau mewakili solusi akhir dari masalah. Sebaliknya, sumber daya ini adalah segala sesuatu yang bisa digunakan untuk memberdayakan klien dalam mengatasi tantangan yang mereka hadapi.', '2024-10-25 10:11:16', '2024-10-25 10:11:16'),
(78, 'Apa pentingnya \"Effect\" dalam model SCORE?', NULL, 'multiple_choice', 'Pentingnya \"Effect\" dalam model SCORE adalah karena mereka menunjukkan dampak jangka panjang dari mencapai tujuan. \"Effect\" membantu klien memahami konsekuensi jangka panjang dari tindakan mereka, sehingga mereka dapat membuat keputusan yang lebih baik untuk masa depan mereka.', 'Pilihan ini tidak tepat. \"Effect\" dalam model SCORE bukanlah hasil langsung dari mengatasi gejala, manfaat jangka pendek, atau alat untuk menentukan penyebab masalah. Sebaliknya, \"Effect\" berfokus pada dampak jangka panjang yang dihasilkan dari pencapaian tujuan yang telah ditetapkan.', '2024-10-25 10:12:26', '2024-10-25 10:12:26'),
(79, 'Apa langkah pertama yang harus diambil oleh seorang perencana keuangan ketika seorang klien menyampaikan masalah keuangan?', NULL, 'multiple_choice', 'Langkah pertama yang harus diambil oleh seorang perencana keuangan ketika seorang klien menyampaikan masalah keuangan adalah mengatasi gejala yang terlihat dari masalah tersebut. Mengidentifikasi dan memahami gejala adalah langkah awal yang penting sebelum melangkah lebih jauh untuk menemukan penyebab mendasar dan merumuskan solusi yang tepat.', 'Pilihan ini tidak tepat. Mengabaikan masalah, fokus langsung pada tujuan klien tanpa memahami gejala, atau membuat keputusan tanpa melibatkan klien bukanlah langkah yang sesuai. Perencana keuangan harus terlebih dahulu mengatasi gejala yang dihadapi klien untuk memastikan solusi yang diberikan tepat dan relevan.', '2024-10-25 10:13:32', '2024-10-25 10:13:32'),
(80, 'Mengapa penting untuk membedakan antara gejala (symptom) dan penyebab (cause) dalam perencanaan keuangan?', NULL, 'multiple_choice', 'Penting untuk membedakan antara gejala (symptom) dan penyebab (cause) dalam perencanaan keuangan karena menangani gejala saja tidak akan menyelesaikan masalah mendasar. Mengidentifikasi dan mengatasi penyebab adalah kunci untuk memastikan bahwa solusi yang diterapkan benar-benar efektif dan berkelanjutan.', 'Pilihan ini tidak tepat. Gejala tidak selalu lebih mudah diperbaiki, dan penyebab tidak selalu lebih relevan untuk tindakan segera atau tidak terkait dengan tujuan klien. Justru, memahami perbedaan antara gejala dan penyebab membantu perencana keuangan untuk memberikan solusi yang komprehensif dan tepat sasaran.', '2024-10-25 10:14:40', '2024-10-25 10:14:40'),
(81, 'Yang manakah dari berikut ini BUKAN komponen dari model SCORE?', NULL, 'multiple_choice', 'Ekspektasi (expectation) BUKAN merupakan komponen dari model SCORE. Komponen utama dari model SCORE adalah Gejala (symptom), Tujuan (objective), Penyebab (cause), Efek (effect), dan Sumber daya (resource).', 'Pilihan ini tidak tepat. Gejala, Tujuan, dan Sumber daya semuanya adalah komponen dari model SCORE yang membantu dalam memahami dan menangani masalah keuangan klien secara menyeluruh.', '2024-10-25 10:15:27', '2024-10-25 10:15:27'),
(82, 'Apa tujuan dari memiliki rencana tindakan untuk setiap komponen dari model SCORE?', NULL, 'multiple_choice', 'Tujuan dari memiliki rencana tindakan untuk setiap komponen dari model SCORE adalah untuk memberikan pendekatan yang komprehensif dalam jangka panjang. Dengan merencanakan tindakan yang mencakup gejala, penyebab, tujuan, efek, dan sumber daya, perencana keuangan dapat memastikan bahwa masalah klien diatasi secara menyeluruh dan berkelanjutan.', 'Pilihan ini tidak tepat. Rencana tindakan yang komprehensif bukan hanya untuk perbaikan cepat terhadap gejala atau mengelola krisis segera, dan tentu bukan untuk menghindari pemahaman terhadap penyebab mendasar. Sebaliknya, ini dirancang untuk memberikan solusi yang efektif dan berkelanjutan.', '2024-10-25 10:16:43', '2024-10-25 10:16:43');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `tanggal_lahir` varchar(10) NOT NULL,
  `no_ktp` varchar(16) NOT NULL,
  `kota_domisili` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `social_media` varchar(100) NOT NULL,
  `no_cfp_rfp` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `nama_lengkap`, `gender`, `tanggal_lahir`, `no_ktp`, `kota_domisili`, `email`, `no_hp`, `social_media`, `no_cfp_rfp`, `created_at`, `updated_at`) VALUES
(1, 'Insan Putranda', 'Pria', '24/03/1989', '3174092403890005', 'Jakarta', 'insan.putranda@gmail.com', '08170860347', 'insanputra', '2300 0778', '2024-02-15 08:50:01', '2024-02-21 06:42:50'),
(2, 'Ray Burton', 'Pria', '24/10/1992', '3273172410920005', 'Bandung', 'ray.burton241092@gmail.com', '08112295895', 'IG: rayburton2410', '21000326', '2024-02-25 15:12:42', '2024-02-25 15:12:42'),
(3, 'Arwiyoto Purwono', 'Pria', '07/12/1958', '3578040712580012', 'Surabaya', 'arwiyoto@gmail.com', '0811347365', '', '08020016', '2024-03-05 07:57:02', '2024-03-05 07:57:02'),
(4, 'Agus Helly', 'Pria', '25/03/1975', '5171022503750007', 'Denpasar', 'agushelly@gmail.com', '08155705777', 'IG: agushelly', '16000351', '2024-03-05 07:57:27', '2024-03-05 07:57:27'),
(5, 'Bima Raditya', 'Pria', '13/10/1985', '5171021310850002', 'BSD', 'bima.raditya@gmail.com', '082117654073', 'IG: bimaraditya', '', '2024-03-05 07:58:03', '2024-03-05 07:58:03'),
(6, 'Boby Wiryawan Saputra', 'Pria', '30/01/1986', '3273033101860001', 'Bandung', 'saputra.w.boby@gmail.com', '08112330186', 'IG: bobywsaputra', '1300 2317', '2024-03-11 11:47:01', '2024-03-11 11:47:01'),
(7, 'David Gad Kapoyos', 'Pria', '22/03/1991', '3174012203910005', 'Jakarta', 'davidkapoyos@gmail.com', '08118109001', 'IG : davidkapoyos, TikTok : davidkapoyos', '23000487', '2024-03-14 11:54:08', '2024-03-14 11:54:08'),
(8, 'Putu Metta Buddhiyastini', 'Wanita', '17/12/1998', '5103065712980005', 'Depok', 'mettabuddhi@gmail.com', '083114201204', 'IG: @metta_tamtam', 'Baru AWP saja saat ini', '2024-03-24 09:07:59', '2024-03-24 09:07:59'),
(9, 'Fransisca Emi Hartanti', 'Wanita', '11/03/1986', '3404045103860001', 'Yogyakarta', 'fransisca.emi@gmail.com', '081568426684', '@fransiscaemi', '1800 0365', '2024-03-24 09:11:10', '2024-03-24 09:11:10'),
(10, 'Luna Mantyasih Makarti', 'Wanita', '29/08/1986', '3275096908860004', 'Bandung', 'luna_mantyasih@yahoo.com', '08161188249', 'IG: lunamantyasih', '2000 0009', '2024-03-24 09:12:22', '2024-03-24 09:12:22'),
(11, 'Beta Ubaya Nindya', 'Pria', '28/08/1993', '3302022808930002', 'Tangerang', 'betaubaya@gmail.com', '085186802078', 'betaubaya', '2100 0628', '2024-03-24 09:12:22', '2024-03-24 09:12:24'),
(12, 'Romualdus Doni Fendriwibowo', 'Pria', '06/02/1979', '3404100602790003', 'Banten', 'doni.fwibowo@gmail.com', '08176346796', 'IG: rdf_wibowo FB:Doni Fendriwibowo', '22000618', '2024-03-24 09:12:38', '2024-03-24 09:12:38'),
(13, 'Yudha Prawira', 'Pria', '25/03/1988', '3671112503880002', 'Tangerang', 'yudhap253@gmail.com', '087808074133', '', '2000 0623', '2024-03-24 09:19:33', '2024-03-24 09:19:33'),
(14, 'Shirley Boedihartono', 'Wanita', '21/11/1962', '3578076111620001', 'Surabaya', 'sboedihartono@gmail.com', '08113666666', 'Ig: https://instagram.com/shirley.boedihartono', '1800 0485', '2024-03-24 09:32:43', '2024-03-24 09:32:43'),
(15, 'Cindy Febriane Santoso', 'Wanita', '16/02/1981', '3171055602810002', 'Kab. Tangerang', 'Cindy.Santoso@astralife.co.id', '0811822829', 'IG: ciko1602', '22000324', '2024-03-27 10:49:15', '2024-03-27 10:49:15'),
(16, 'Devia Velicia Eliezer', 'Wanita', '03/08/1994', '3273044308940001', 'Bandung', 'devia.velicia@gmail.com', '08997016320', '', '20000440', '2024-03-30 09:53:28', '2024-03-30 09:53:28'),
(17, 'ANDO REYNALDO GULTOM', 'Pria', '06/05/1986', '3173050605860006', 'Jakarta', 'rey.gultom@gmail.com', '0818883416', '', '', '2024-07-22 08:27:55', '2024-07-22 08:27:55'),
(18, 'Agnes Yuliana', 'Wanita', '24/07/1993', '3175076407930005', 'Bekasi', 'agnes.business.24@gmail.com', '081310425052', 'IG: @agnesyuliana24', '21000639', '2024-08-10 03:17:59', '2024-08-10 03:17:59'),
(19, 'Raissudin Dina', 'Wanita', '13/04/1988', '6371025304880008', 'Jakarta', 'raissudindina@gmail.com', '081351088810', '@raissudin.dina', '2400 0049', '2024-09-04 03:31:56', '2024-09-04 03:31:56'),
(20, 'Leviana nattan', 'Wanita', '03/10/1987', '3674054310870007', 'Jakarta', 'leviana.nattan@gmail.com', '08129642434', 'leviana0310', '24000065', '2024-09-04 08:27:18', '2024-09-04 08:27:18'),
(21, 'Aswin', 'Pria', '12/02/1989', '7312011202890002', 'KOTA JAKARTA SELATAN', 'aswinnganro@yahoo.com', '085255426346', 'aswinganro (Instagram)', '20000736', '2024-09-04 09:23:32', '2024-09-04 09:23:32'),
(22, 'Allevia Syarif', 'Wanita', '03/02/1990', '1371094302900009', 'Depok', 'alleviasya@gmail.com', '08118467722', 'alleviasyarif', '1800 0776', '2024-09-04 10:57:20', '2024-09-06 09:03:03'),
(23, 'Heni widyana', 'Wanita', '25/10/1982', '3175056510821001', 'Jakarta', 'HENIWIDYANA.25@GMAIL.COM', '081514283255', 'WIDYANAHENI', '18000592', '2024-09-04 13:26:45', '2024-09-04 13:26:47'),
(24, 'Antonius Siahaan', 'Pria', '27/09/1970', '3173072709700006', 'Jakarta', 'antonius.siahaan1@gmail.com', '081296286006', 'IG: tony_atps', '2300 0287', '2024-09-04 23:57:00', '2024-09-04 23:57:00'),
(25, 'Veby Indriyana', 'Wanita', '29/10/1982', '3671136910820003', 'Bintaro Tangsel', 'vebyindriyana@yahoo.com', '087777971737', 'vb_veby', '1900 0673', '2024-09-04 23:59:04', '2024-09-04 23:59:08'),
(26, 'Eka Prasetia Afandi', 'Pria', '31/01/1991', '3509173107910001', 'Jember', 'eka.afandi@gmail.com', '081231243324', 'IG: @ekaafandi', '2100 0721', '2024-09-05 00:11:08', '2024-09-05 00:11:08'),
(27, 'Budhie Rachmanto ', 'Pria', '16/10/1980', '3276021610800011', 'Depok', 'budhierach2@gmail.com', '087875561910', 'Budhie Rachmanto', '20000691', '2024-09-05 00:12:09', '2024-09-05 00:12:09'),
(28, 'Anita Trihizkia Dewi', 'Wanita', '30/08/1994', '3305147008940002', 'Tangerang selatan', 'anitakia.ak@gmail.com', '082199952122', 'Anita Ramakko', '2400 0235', '2024-09-05 00:18:49', '2024-09-05 00:18:49'),
(29, 'Deasy MT Marpaung', 'Wanita', '08/09/1980', '3175074809800009', 'Jakarta', 'deasy.marpaung@gmail.com', '08129403320', 'IG: deasy.marpaung, FB: Deasy Marpaung', '', '2024-09-05 00:37:44', '2024-09-05 00:37:44'),
(30, 'Grand Aloha B2/3, SIDOARJO', 'Wanita', '10/01/1995', '3509195001950001', 'SURABAYA', 'rlin.chesa@gmail.com', '081575400763', 'IG dan tiktok : @eerl.in', '2300 0709', '2024-09-05 01:55:47', '2024-09-05 01:55:47'),
(31, 'Maureen Natasha Sangari', 'Wanita', '25/04/1989', '3174016504890002', 'Jakarta', 'maureen.natasha@yahoo.com', '08174963946', 'maureenatasha', '21000989', '2024-09-05 03:21:09', '2024-09-05 03:21:11'),
(32, 'Amanda Sangga Rosa', 'Pria', '02/10/1993', '3327100210930061', 'Tegal', 'dhe.mand93@gmail.com', '08112911400', '', '2400 0043', '2024-09-05 03:30:50', '2024-09-05 03:30:50'),
(33, 'Dra Chetyana Gunardi', 'Wanita', '08/05/1957', '3173084805570002', 'Jakarta', 'cgid77053@gmail.com', '0816914253', 'Chet  Gunardi', '08010133', '2024-09-05 03:37:00', '2024-09-05 03:37:00'),
(34, 'Dr Mohamad Adam SE ME', 'Pria', '24/06/1967', '1671042406670004', 'Palembang', 'mr_adam2406@yahoo.com', '08161141830', '', '21000701', '2024-09-05 03:46:15', '2024-09-05 03:46:15'),
(35, 'Virtina Thionita', 'Wanita', '30/08/1998', '1872017008980001', 'Jakarta', 'virtinathionita30@gmail.com', '081379404004', '@vitavirtina', '22000160', '2024-09-05 04:13:04', '2024-09-05 04:13:04'),
(36, 'Sarah Aulia Andriana', 'Wanita', '11/12/1994', '3174075112940004', 'Jakarta', 'sarah.aaa11@gmail.com', '0818169494', 'sarahastra', '2100 0120', '2024-09-05 04:39:37', '2024-09-05 04:39:37'),
(37, 'Rio Yanuar', 'Pria', '16/01/1989', '3671121601890001', 'KAB. TANGERANG', 'rioyanuar@gmail.com', '085716014635', '_rioyanuar', '21000209', '2024-09-05 04:48:33', '2024-09-05 04:48:33'),
(38, 'Indira Dhewanti', 'Wanita', '28/02/1983', '351508682830004', 'Surabaya', 'diradhewanti@gmail.com', '082146747755', '@indiradhe', '2000 0557', '2024-09-05 04:48:44', '2024-09-05 04:48:44'),
(39, 'CinCin Anggrek Kusuma', 'Wanita', '12/06/1974', '1272025206740006', 'Pematangsiantar', 'CinCinkusuma@yahoo.com', '08126408485', '@cincinanggrekkusuma(ig)', '17000322', '2024-09-05 05:37:59', '2024-09-05 05:38:03'),
(40, 'Firdaus Panangian Simatupang', 'Pria', '09/12/1971', '3174060912710005', 'jakarta', 'firdaussimatupang71@gmail.com', '081188808671', '', '23000675', '2024-09-05 05:45:28', '2024-09-05 05:45:28'),
(41, 'Rini Pinasthika', 'Wanita', '21/05/1991', '3374116105910001', 'Semarang', 'rini.pinasthika@gmail.com', '085721348851', '', '2400 0063', '2024-09-05 07:58:15', '2024-09-05 07:58:15'),
(42, 'Yudith Wahyuni', 'Wanita', '09/06/1984', '3173084906840002', 'Jakarta', 'Yudith.wahyuni@gmail.com', '081808889876', '@cici_keuangan', '21000927', '2024-09-05 10:15:51', '2024-09-05 10:15:51'),
(43, 'Alwyn Emmanuel', 'Pria', '01/10/1982', '3172020110820009', 'Jakarta', 'alwyn.emm@gmail.com', '08158836399', 'IG: alwyn_emm11 Linkedin: https://www.linkedin.com/in/alwyn-emmanuel-7b676915/', '2400 0079', '2024-09-05 12:52:25', '2024-09-05 12:52:25'),
(44, 'Djatmiko Ary Mulyono', 'Pria', '28/02/1972', '3515182802720004', 'Kota Malang', 'djatmikomulyono@gmail.com', '0811373469', 'IG : djatmiko_ary183', '18000719', '2024-09-05 13:34:03', '2024-09-05 13:34:03'),
(45, 'ALIT WIDIASTIKA, SE, MH', 'Pria', '13/06/1982', '5103011306820001', 'Kuta', 'anatawa.corp@gmail.com', '085739887748', 'IG : alit_widiastika , FB : alit.anatawa', '2000 0397', '2024-09-05 23:14:39', '2024-09-05 23:14:39'),
(46, 'ODE KUSTRIANI ATMAJA ', 'Wanita', '12/03/1995', '3216095203950014', 'Tangerang', 'odeatmaja@gmail.com', '085156146713', 'okatmaja', '2200 0610', '2024-09-06 03:01:16', '2024-09-06 03:01:16'),
(47, 'R. Muryo Suharsoyo', 'Pria', '25/12/1974', '3674062512740002', 'Tangerang Selatan', 'muryo.euy@gmail.com', '0811852823', '', '2400 0036', '2024-09-06 04:17:51', '2024-09-06 04:17:51'),
(48, 'Aldo Lammy', 'Pria', '21/05/1979', '3175072105790016', 'Jakarta', 'aldo.lammy@gmail.com', '081514002664', 'IG: @aldo.lammy', '1900 0320', '2024-09-06 05:08:51', '2024-09-06 05:08:51'),
(49, 'Safaruddin Tarigan SE', 'Pria', '11/02/1976', '1271041102750011', 'Medan', 'tarigansafar@gmail.com', '081262011722', '@rudi.tiegan', '14001203', '2024-09-06 05:26:48', '2024-09-06 05:26:49'),
(50, 'Lukman Hakim', 'Pria', '01/11/1971', '3171050111710001', 'Jakarta', 'abumufti2014@gmail.com', '085716168790', '@elha_voice,  tiktok kang elha', 'CFP : maaf, menyusul ya. Tks ????', '2024-09-06 06:19:09', '2024-09-06 06:19:35'),
(51, 'Mohammad Syafril Hamidi', 'Pria', '05/04/1978', '3175020504780013', 'Jakarta', 'hamidizy@gmail.com', '081584026269', '', '1600 0304', '2024-09-06 06:26:09', '2024-09-06 06:26:10'),
(52, 'Ayu utami', 'Wanita', '03/06/1991', '1306074306910001', 'Jakarta', 'ayu.fe09@gmail.com', '08118328853', 'Ayu.ayuutami', '22000677', '2024-09-06 06:33:50', '2024-09-06 06:33:50'),
(53, 'Made Suardhini', 'Wanita', '29/04/1970', '3175076904700010', 'Jakarta Selatan - Kota', 'Ninet@hotmail.com', '08551000259', 'UG: cittafinancial', '2200 0321', '2024-09-06 06:34:30', '2024-09-06 06:34:30'),
(54, 'Wilman San Marino, S.E., M.M.', 'Pria', '04/04/1987', '3206340404870002', 'Tasikmalaya', 'wilmansanmarino@gmail.com', '085223051113', 'wilmansanmarino', '23000023', '2024-09-06 06:35:14', '2024-09-06 06:35:14'),
(55, 'Cynthya Van Laurent', 'Wanita', '16/07/1984', '3172015607840002', 'Jakarta', 'cynthya.van.laurent@gmail.com', '08159162161', '@cynthyavanlaurent', '22000318', '2024-09-06 06:43:46', '2024-09-06 06:43:46'),
(56, 'Yose Stefanus', 'Pria', '30/11/1983', '3173033011830002', 'Tangerang selatan', 'yose.stefanus@gmail.com', '0818163964', 'IG : urusuang', '1600 0343', '2024-09-06 06:56:27', '2024-09-06 06:56:27'),
(57, 'YULIANI SE MM', 'Wanita', '25/08/1976', '1671046508760006', 'Palembang', 'yulianisyapril@gmail.com', '08127829200', 'IG: yuliani sukmah', '1800 0712', '2024-09-06 08:19:39', '2024-09-06 08:19:39'),
(58, 'CHRISTIAN HAMONANGAN SIHOTANG', 'Pria', '14/07/1997', '00000000', 'Jakarta Pusat', 'christianhsihotang@gmail.com', '087856722538', '', '', '2024-09-06 08:27:31', '2024-09-06 08:27:31'),
(59, 'Kurniasari Supriatin', 'Wanita', '10/02/1982', '3674035002820001', 'Jakarta', 'sarri.pranoto@gmail.com', '0818147897', 'IG: supersarri', '22000324', '2024-09-06 09:12:58', '2024-09-06 09:12:58'),
(60, 'Yirhan Sim', 'Pria', '20/06/1970', '3217082006700025', 'Bandung', 'thesims08@gmail.com', '0811225584', '', '20000524', '2024-09-06 09:17:39', '2024-09-06 09:17:42'),
(61, 'Dzikra S', 'Pria', '19/11/1996', '1304021911960002', 'Tangerang', 'dziikra35@gmail.com', '081270408977', 'dzikr.s', '2300 0209', '2024-09-07 06:34:37', '2024-09-07 06:34:37'),
(62, 'Rahma Tejawati Maryama', 'Wanita', '14/06/1990', '3273025406900008', 'Bandung', 'rahmamaryama.cfp@gmail.com', '082117489800', '@rahma.maryama', '18000420', '2024-09-08 14:10:23', '2024-09-08 14:10:23'),
(63, 'C. Rina Khairani', 'Wanita', '04/04/1987', '3273134404870001', 'Bandung', 'rinakhairani38@gmail.com', '081918880188', '', '19000017', '2024-09-09 00:06:51', '2024-09-09 00:06:51'),
(64, 'Richad Alamsyah', 'Pria', '03/12/1991', '3271030312910004', 'Bogor', 'alamsyahrichard@gmail.com', '087760086413', 'alamsyahrichad', '22000099', '2024-09-09 02:38:29', '2024-09-09 02:38:29'),
(65, 'ISABELLA SILALAHI, ST', 'Wanita', '09/12/1984', '1271034912840002', 'Medan', 'simplicity.bella@gmail.com', '085297149949', 'IG:@bellasilalahi', '1900 0207', '2024-09-09 04:19:18', '2024-09-09 04:19:21'),
(66, 'RAJA RAMOS HOT MONANG PURBA', 'Pria', '01/11/1994', '1272010111940002', 'PEMATANGSIANTAR (KOTA)', 'raja.purba@sequislife.com', '082116981680', '', '1900 0211', '2024-09-09 07:43:15', '2024-09-09 07:43:15'),
(67, 'Aditya Nugraha', 'Pria', '03/05/1984', '3275020305840015', 'Semarang', 'adit.nugraha02@gmail.com', '08122780502', 'IG:adithboncell', '20000469', '2024-09-09 10:39:56', '2024-09-09 10:39:56'),
(68, 'Dona', 'Wanita', '27/10/1985', '3172016710850006', 'Jakarta', 'dona_carlene@yahoo.com', '081932560334', 'Dona_@donacarlene', '2100 1020', '2024-09-09 16:08:44', '2024-09-09 16:08:44'),
(69, '3276056911950008', 'Wanita', '29/11/1995', '3276056911950008', 'Depok', 'novia.riani.putri@gmail.com', '081299696107', 'noviakelana', '', '2024-09-09 22:27:29', '2024-09-09 22:27:29'),
(70, 'STANISLAUS ADNANTO MASTAN', 'Pria', '05/12/1987', '3578090512870002', 'SURABAYA', 'stanislausadnanto@gmail.com', '08123456873', 'IG: StanislausAdnanto', '1800 0710', '2024-09-10 03:00:10', '2024-09-10 03:00:10'),
(71, 'Mohamad Taufiq Ismail', 'Pria', '16/09/1979', '1671141609790003', 'Kota Administrasi Jakarta Timur', 'mtaufiqismail@gmail.com', '08127161616', '', '1800 0304', '2024-09-11 04:50:01', '2024-09-11 04:50:01'),
(72, 'Yacinta Adelina', 'Wanita', '28/01/1982', '3174066801820009', 'Jakarta', 'yacinta.adelina@gmail.com', '08179413431', '', '14001691', '2024-09-12 02:19:02', '2024-09-12 02:19:02'),
(73, 'EKO SABOWO', 'Pria', '03/02/1987', '3174070302870001', 'JAKARTA', 'sabowo.gpos@gmail.com', '085280188801', '', '', '2024-09-12 08:00:32', '2024-09-12 08:00:32');

-- --------------------------------------------------------

--
-- Table structure for table `short_answers`
--

CREATE TABLE `short_answers` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `question_id` int(11) UNSIGNED DEFAULT NULL,
  `answer_text` text DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `answered_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) UNSIGNED NOT NULL,
  `topic_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `starting_statement` text DEFAULT NULL,
  `finishing_statement` text DEFAULT NULL,
  `type` enum('quiz','assignment','exam','project') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `topic_id`, `name`, `starting_statement`, `finishing_statement`, `type`, `created_at`, `updated_at`) VALUES
(1, 3, 'Introduction to Psychology of Financial Planning', 'Tes ini mengevaluasi pengetahuan Anda tentang hubungan antara psikologi dan perencanaan keuangan, menekankan pentingnya memahami profil psikologis klien.', 'Selamat! Anda telah menyelesaikan tes \"Introduction to Psychology of Financial Planning\".\r\n\r\nHasil Anda mencerminkan pemahaman Anda tentang hubungan kompleks antara psikologi dan pengambilan keputusan keuangan. Gunakan pengetahuan ini untuk memberikan nasihat keuangan yang lebih efektif dan personal.', 'quiz', '2024-10-18 07:30:56', '2024-10-18 07:30:56'),
(2, 2, 'Why People Do or Don\'t', 'Tes ini mengukur pemahaman Anda tentang faktor-faktor yang mempengaruhi mengapa orang mengambil atau menghindari tindakan, dengan fokus pada sistem keyakinan dan dampaknya terhadap perilaku.', 'Selamat! Anda telah menyelesaikan tes \"Why People Do or Don\'t\".\r\n\r\nHasil Anda menunjukkan pemahaman Anda tentang bagaimana sistem keyakinan menggerakkan perilaku melampaui keterampilan, pengetahuan, dan nasihat. Ingatlah wawasan ini saat menerapkannya pada situasi kehidupan nyata.', 'quiz', '2024-10-21 07:06:31', '2024-10-21 07:06:31'),
(3, 4, 'Financial Instincts', 'Tes ini mengeksplorasi pemahaman Anda tentang insting keuangan dan bagaimana psikologi evolusioner memengaruhi perilaku keuangan modern.', 'Selamat! Anda telah menyelesaikan tes \"Financial Instincts\".\r\n\r\nHasil Anda menunjukkan kesadaran Anda tentang bagaimana insting dasar memengaruhi cara kita mengelola uang di dunia modern. Gunakan pemahaman ini untuk membantu klien Anda mengatasi jebakan keuangan yang umum.', 'quiz', '2024-10-21 08:39:04', '2024-10-21 08:39:04'),
(4, 5, 'Behavioral Finance (Bias and Heuristics)', 'Tes ini mengukur pengetahuan Anda tentang bias kognitif dan heuristik yang memengaruhi perilaku keuangan dan cara mengatasinya.', 'Selamat! Anda telah menyelesaikan tes \"Behavioral Finance (Bias and Heuristics)\".\r\n\r\nHasil Anda menunjukkan pemahaman Anda tentang berbagai bias dan heuristik yang mempengaruhi pengambilan keputusan keuangan. Gunakan wawasan ini untuk membantu klien membuat keputusan yang lebih baik.', 'quiz', '2024-10-23 07:09:51', '2024-10-23 07:09:51'),
(5, 6, 'The Environment', 'Tes ini mengevaluasi pemahaman Anda tentang bagaimana lingkungan memengaruhi psikologi keuangan dan keputusan finansial individu.', 'Selamat! Anda telah menyelesaikan tes \"The Environment\".\r\n\r\nHasil Anda mencerminkan pemahaman Anda tentang dampak lingkungan terhadap pandangan dan perilaku keuangan. Gunakan pengetahuan ini untuk mempertimbangkan faktor-faktor lingkungan dalam memberikan nasihat keuangan.', 'quiz', '2024-10-24 08:20:50', '2024-10-24 08:20:50'),
(6, 7, 'Financial Flashpoints', 'Tes ini mengukur pemahaman Anda tentang peristiwa kehidupan yang membentuk keyakinan dan perilaku keuangan individu.', 'Selamat! Anda telah menyelesaikan tes \"Financial Flashpoints\".\r\n\r\nHasil Anda menunjukkan pemahaman Anda tentang bagaimana peristiwa penting dalam hidup membentuk keyakinan dan perilaku keuangan. Gunakan wawasan ini untuk membantu klien mengatasi dampak emosional dari flashpoints keuangan mereka.', 'quiz', '2024-10-25 08:26:47', '2024-10-25 08:26:47'),
(7, 8, 'Money Beliefs', 'Tes ini mengeksplorasi pemahaman Anda tentang berbagai keyakinan tentang uang yang memengaruhi keputusan dan perilaku keuangan individu.', 'Selamat! Anda telah menyelesaikan tes \"Money Beliefs\".\r\n\r\nHasil Anda menunjukkan pemahaman Anda tentang bagaimana keyakinan tentang uang mempengaruhi perilaku keuangan. Gunakan pengetahuan ini untuk membantu klien mengidentifikasi dan mengatasi keyakinan yang merugikan tentang uang.', 'quiz', '2024-10-25 08:43:37', '2024-10-25 08:43:37'),
(8, 9, 'Financial Behaviors and Outcomes', 'Tes ini mengevaluasi pemahaman Anda tentang perilaku keuangan yang memengaruhi kesejahteraan finansial.', 'Selamat! Anda telah menyelesaikan tes \"Financial Behaviors and Outcomes\".\r\n\r\nHasil Anda mencerminkan pemahaman Anda tentang berbagai perilaku keuangan dan dampaknya. Gunakan wawasan ini untuk mengidentifikasi perilaku keuangan yang mengkhawatirkan dan merujuk ke profesional kesehatan mental untuk membantu klien mencapai kesejahteraan finansial yang lebih baik.', 'quiz', '2024-10-25 09:16:42', '2024-10-25 09:16:42'),
(9, 11, 'Sources of Money Conflict', 'Tes ini mengukur pemahaman Anda tentang sumber konflik keuangan dalam hubungan pribadi dan profesional.', 'Selamat! Anda telah menyelesaikan tes \"Sources of Money Conflict\".\r\n\r\nHasil Anda menunjukkan pemahaman Anda tentang berbagai sumber konflik keuangan dan cara mengatasinya. Gunakan wawasan ini untuk membantu klien mengelola dan menyelesaikan konflik keuangan mereka.', 'quiz', '2024-10-25 09:39:52', '2024-10-25 09:39:52'),
(10, 12, 'S.C.O.R.E.', 'Tes ini mengevaluasi pemahaman Anda tentang model SCORE NLP dalam mengidentifikasi dan menangani masalah keuangan klien.', 'Selamat! Anda telah menyelesaikan tes \"S.C.O.R.E.\".\r\n\r\nHasil Anda menunjukkan pemahaman Anda tentang model SCORE NLP dan cara menerapkannya dalam perencanaan keuangan. Gunakan pengetahuan ini untuk membantu klien Anda mengidentifikasi gejala dan penyebab masalah keuangan mereka serta menetapkan tujuan yang jelas.', 'quiz', '2024-10-25 10:02:03', '2024-10-25 10:02:03'),
(11, 10, 'Financial Health Scale', 'Tes ini mengeksplorasi pemahaman Anda tentang penggunaan tools Financial Health Scale yang digunakan untuk menilai cepat kesehatan finansial klien.', 'Selamat! Anda telah menyelesaikan tugas \"Financial Health Scale\".\r\n\r\nGunakan pengetahuan penggunaan tools ini untuk membantu menilai cepat apakah klien memiliki kesehatan finansial yang baik dari sisi psikologi dan mampu untuk melanjutkan eksekusi rencana keuangan dari Anda.', 'assignment', '2024-10-25 10:20:18', '2024-10-25 10:20:18');

-- --------------------------------------------------------

--
-- Table structure for table `tasks_and_questions`
--

CREATE TABLE `tasks_and_questions` (
  `id` int(11) UNSIGNED NOT NULL,
  `task_id` int(11) UNSIGNED NOT NULL,
  `question_id` int(11) UNSIGNED NOT NULL,
  `order_num` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks_and_questions`
--

INSERT INTO `tasks_and_questions` (`id`, `task_id`, `question_id`, `order_num`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 2),
(3, 1, 3, 3),
(4, 1, 4, 4),
(5, 1, 5, 5),
(6, 1, 6, 6),
(7, 2, 7, 1),
(8, 2, 8, 2),
(9, 2, 9, 3),
(10, 2, 10, 4),
(11, 2, 11, 5),
(12, 2, 12, 6),
(13, 3, 13, 1),
(14, 3, 14, 2),
(15, 3, 15, 3),
(16, 3, 16, 4),
(17, 3, 17, 5),
(18, 3, 18, 6),
(19, 3, 19, 7),
(20, 3, 20, 8),
(21, 3, 21, 9),
(22, 3, 22, 10),
(23, 4, 23, 1),
(24, 4, 24, 2),
(25, 4, 25, 3),
(26, 4, 26, 4),
(27, 4, 27, 5),
(28, 4, 28, 6),
(29, 4, 29, 7),
(30, 4, 30, 8),
(31, 4, 31, 9),
(32, 4, 32, 10),
(33, 5, 33, 1),
(34, 5, 34, 2),
(35, 5, 35, 3),
(36, 5, 36, 4),
(37, 5, 37, 5),
(38, 5, 38, 6),
(39, 6, 39, 1),
(40, 6, 40, 2),
(41, 6, 41, 3),
(42, 6, 42, 4),
(43, 6, 43, 5),
(44, 6, 44, 6),
(45, 7, 45, 1),
(46, 7, 46, 2),
(47, 7, 47, 3),
(48, 7, 48, 4),
(49, 7, 49, 5),
(50, 7, 50, 6),
(51, 7, 51, 7),
(52, 7, 52, 8),
(53, 7, 53, 9),
(54, 7, 54, 10),
(55, 8, 55, 1),
(56, 8, 56, 2),
(57, 8, 57, 3),
(58, 8, 58, 4),
(59, 8, 59, 5),
(60, 8, 60, 6),
(61, 8, 61, 7),
(62, 8, 62, 8),
(63, 8, 63, 9),
(64, 8, 64, 10),
(65, 8, 65, 11),
(66, 9, 66, 1),
(67, 9, 67, 2),
(68, 9, 68, 3),
(69, 9, 69, 4),
(70, 9, 70, 5),
(71, 9, 71, 6),
(72, 9, 72, 7),
(73, 9, 73, 8),
(74, 10, 74, 1),
(75, 10, 75, 2),
(76, 10, 76, 3),
(77, 10, 77, 4),
(78, 10, 78, 5),
(79, 10, 79, 6),
(80, 10, 80, 7),
(81, 10, 81, 8),
(82, 10, 82, 9);

-- --------------------------------------------------------

--
-- Table structure for table `task_attempts`
--

CREATE TABLE `task_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `task_id` int(11) UNSIGNED DEFAULT NULL,
  `score` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) UNSIGNED NOT NULL,
  `course_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `cover_img` varchar(100) DEFAULT NULL,
  `template` varchar(100) NOT NULL COMMENT 'Template from application',
  `order_no` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `course_id`, `title`, `resume`, `cover_img`, `template`, `order_no`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pendahuluan', 'Selamat datang di LMS Qualified Financial Coach.', 'cover_afci.webp', 'qfc_1_pendahuluan', 1, '2024-10-16 13:05:47', '2024-10-16 13:05:47'),
(2, 1, 'Why People Do and Don\'t', 'Menjelajahi pentingnya sistem keyakinan dalam mempengaruhi perilaku seseorang. (~5 menit)', 'cover_alessio.webp', 'qfc_2_why_do_dont', 2, '2024-10-16 13:05:47', '2024-10-16 13:05:47'),
(3, 1, 'Introduction to Psychology of Financial Planning', 'Memahami hubungan antara psikologi dan keuangan sangat penting bagi perencana keuangan untuk memberikan nasihat yang efektif dan personal. (~50 menit)							', 'cover_judi.webp', 'qfc_3_introduction', 3, '2024-10-21 06:50:09', '2024-10-21 06:50:09'),
(4, 1, 'Financial Instinct', 'Mengapa insting manusia sering kali menghambat pengelolaan keuangan yang baik dan bagaimana memahami hal ini dapat membantu perencanaan keuangan. (~30 menit)', 'cover_imelda.webp', 'qfc_4_financial_instinct', 4, '2024-10-21 08:32:51', '2024-10-21 08:32:51'),
(5, 1, 'Behavioral Finance', 'Menyelidiki bias kognitif dan heuristik yang memengaruhi perilaku keuangan dan cara mengatasinya. (~50 menit)', 'cover_imelda.webp', 'qfc_5_behavioral_finance', 5, '2024-10-23 06:53:42', '2024-10-23 06:53:42'),
(6, 1, 'The Environment', 'Memahami bagaimana lingkungan mempengaruhi psikologi keuangan dan keputusan finansial individu. (~20 menit)', 'cover_imelda.webp', 'qfc_6_environment', 6, '2024-10-24 08:13:38', '2024-10-24 08:13:38'),
(7, 1, 'Financial Flashpoints', 'Menggali peristiwa kehidupan yang membentuk keyakinan dan perilaku keuangan individu. (~20 menit)', 'cover_hena.webp', 'qfc_7_financial_flashpoints', 7, '2024-10-24 09:28:26', '2024-10-24 09:28:26'),
(8, 1, 'Money Beliefs', 'Menggali keyakinan tentang uang yang memengaruhi keputusan dan perilaku keuangan individu. (~30 menit)', 'cover_hena2.webp', 'qfc_8_money_beliefs', 8, '2024-10-24 09:30:51', '2024-10-24 09:30:51'),
(9, 1, 'Financial Behaviors and Outcomes', 'Menganalisis perilaku keuangan yang memengaruhi kesejahteraan finansial dan cara mengatasinya. (~50 menit)', 'cover_hena2.webp', 'qfc_9_financial_behaviors_outcomes', 9, '2024-10-24 09:32:30', '2024-10-24 09:32:30'),
(10, 1, 'Inventory: Financial Health Scale', 'Mengeksplorasi perilaku keuangan dan hasilnya serta tools untuk menilai kesehatan keuangan klien. (~40 menit)', 'cover_anita.webp', 'qfc_10_fhs', 10, '2024-10-24 09:36:58', '2024-10-24 09:36:58'),
(11, 1, 'Sources of Money Conflict', 'Mengidentifikasi dan mengatasi sumber konflik keuangan dalam hubungan pribadi dan profesional. (~50 menit)', 'cover_desna.webp', 'qfc_11_sources_money_conflict', 11, '2024-10-24 09:39:04', '2024-10-24 09:39:04'),
(12, 1, 'S.C.O.R.E.', 'Menggunakan model SCORE NLP untuk mengidentifikasi dan menangani masalah keuangan klien dengan lebih efektif. (~15 menit)', 'cover_alessio.webp', 'qfc_12_score', 12, '2024-10-24 09:46:50', '2024-10-24 09:46:50'),
(13, 1, 'Conclusion', 'Selamat bagi Anda yang telah menyelesaikan semua materi. (~5 menit)', 'cover_tds.webp', 'qfc_13_conclusion', 13, '2024-10-24 09:47:33', '2024-10-24 09:47:33'),
(14, 1, 'Final Assessment', 'Ujian terakhir. (~45 menit)', 'cover_afci.webp', 'qfc_14_final_assessment', 14, '2024-10-24 09:49:30', '2024-10-24 09:49:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `member_id` varchar(8) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_fresh_acc` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `member_id`, `email`, `password`, `name`, `is_active`, `is_admin`, `is_fresh_acc`, `created_at`, `updated_at`, `last_login`) VALUES
(1, 'C0000000', 'info@financialcoachacademy.asia', '$2y$10$tTg7OIf8XqjICk/7cwyhnezTpjP/kpXs8bedbQmAdgkKyg4cNIt/i', 'Admin AFCI', 1, 1, 1, '2023-12-08 08:00:43', '2024-02-28 09:05:44', '2024-10-25 08:22:21'),
(3, 'C0000001', 'test@financialcoachacademy.asia', '$2y$10$FNsYRoimlXL3iltwoF8X.ew1hIgl6.mhheiU3wc1R6Sk9Nt8jbddq', 'Akun Testing', 1, 0, 0, '2024-01-31 04:18:43', '2024-08-18 09:30:37', '2024-08-30 09:03:39'),
(4, 'C2400001', 'anastasia.anita@fpsbindonesia.net', '$2y$10$1FHiJ57j2zC9K2qgU5BAbu1vbSHZ81tNuyXSiovC8sHtbEzUvHjFC', 'Anastasia Anita', 1, 1, 1, '2024-09-02 08:16:29', '2024-09-02 08:16:29', '0000-00-00 00:00:00'),
(5, 'C2400002', 'td.santoso@fpsbindonesia.net', '$2y$10$JWJYda9kaLGpMLD/ueQtiuMnN.n8kfG1jgkiLf31eN6Aaw1oZ4BWO', 'Tri Djoko Santoso', 1, 0, 1, '2024-09-02 08:17:34', '2024-09-02 08:17:34', '0000-00-00 00:00:00'),
(6, 'C2400003', 'choliqabdul104@gmail.com', '$2y$10$UfHmymVyT3BXF1iRo4X62u165kVSW5znU6NvMQwZN/WFNkdThZYV.', 'Abdul Choliq', 1, 0, 1, '2024-09-02 08:19:16', '2024-09-02 08:19:16', '0000-00-00 00:00:00'),
(7, 'C2400004', 'listiaanisa3791@gmail.com', '$2y$10$IFiQOzSqsj7UV5Vq8uNUneQXAYpsF/KYpIoI5aednqqcstK.9LtL2', 'Listia Anisa', 1, 0, 1, '2024-09-02 08:19:53', '2024-09-02 08:19:53', '0000-00-00 00:00:00'),
(8, 'C2400005', 'sabowo.gpos@gmail.com', '$2y$10$dEIvPOVTmyBtxWOPkijXFejfSOz0csfDu0U3ZJlWQ86g0Epkl2M32', 'Eko Sabowo', 1, 0, 1, '2024-09-02 08:20:18', '2024-09-02 08:20:18', '0000-00-00 00:00:00'),
(9, 'C2400006', 'ita.guntari@gmail.com', '$2y$10$xQnaTg00GcpjS65yC1EQxeFrv9jaJwY/iNSI7HRn2NAZDHIpZO.0K', 'Ita Guntari', 1, 0, 1, '2024-09-02 08:20:42', '2024-09-02 08:20:42', '0000-00-00 00:00:00'),
(10, 'C2400007', 'indra.orchidea@gmail.com', '$2y$10$k3A461PWS7.bv/.VXH0gdOAuy8EPx3lfsNa8Ejhr3JptPKukBUvm.', 'Indra Orchidea', 1, 0, 1, '2024-09-02 08:21:16', '2024-09-02 08:21:16', '0000-00-00 00:00:00'),
(11, 'C2400008', 'amri.hidayatulloh@gmail.com', '$2y$10$ha/fa9gbEZqf8W5fjA6BNeFuVWKbaLrD6h39NWG8bgAiqg8IcRBPm', 'Amri Hidayatulloh', 1, 0, 1, '2024-09-02 08:21:47', '2024-09-02 08:21:47', '0000-00-00 00:00:00'),
(12, 'C2400009', 'ichsan02@yahoo.com', '$2y$10$i5fQ/2cx2dMWowxDIBUmU.p4H7ZC2Ut6FiydG5mIgEgWviU8.7HIW', 'Mohamad Ichsan', 1, 0, 1, '2024-09-02 08:22:32', '2024-09-02 08:22:32', '0000-00-00 00:00:00'),
(13, 'C2400010', 'renikeristiana@gmail.com', '$2y$10$9Duvt/f3AA5eDIi7p/lU9eHb0G2zSBIcOL6yeMj.sTonSly8UeJXK', 'Reni Keristiana', 1, 0, 1, '2024-09-02 08:22:59', '2024-09-02 08:22:59', '2024-09-17 07:16:24'),
(14, 'C2400011', 'sandila.ekaputri@gmail.com', '$2y$10$Hodd2BZHRfTnWYc8l5dMPOytG0eYAXW7y8A/4XxasOyEAya4TnShK', 'Sandila Ekaputri', 1, 0, 1, '2024-09-02 08:23:20', '2024-09-02 08:23:20', '0000-00-00 00:00:00'),
(15, 'C2409001', 'aturuangmu89@gmail.com', '$2y$10$x8iUerRSBxa2AQnm0i1xouHx5VgmEhaTQilx11s.Sq1VshsC6li/S', 'Alit Widiastika', 1, 0, 1, '2024-09-18 07:16:12', '2024-09-18 07:18:14', '0000-00-00 00:00:00'),
(16, 'C2409002', 'alwyn.emm@gmail.com', '$2y$10$Im5trFV/iWqzfL.9VZdsWeFPqAFp6.xAYBrVKGMkeZf6xtV95ML5O', 'Alwyn Emmanuel', 1, 0, 1, '2024-09-18 07:16:45', '2024-09-18 07:18:04', '0000-00-00 00:00:00'),
(17, 'C2409003', 'nganroaswin@gmail.com', '$2y$10$/ac1ouvr3IWp3gGylNqNlOZkFJvdzVZhnjRAob9pKSc64E3rfKIjC', 'Aswin', 1, 0, 1, '2024-09-18 07:17:51', '2024-09-18 07:17:51', '0000-00-00 00:00:00'),
(18, 'C2409004', 'Cindy.Santoso@astralife.co.id', '$2y$10$6zjpquyECGsqVuaB2g/97O/88J5gwHnllg1wWFJg6gkFTPcXm67i6', 'Cindy Febriane Santoso', 1, 0, 1, '2024-09-18 07:19:09', '2024-09-18 07:19:09', '0000-00-00 00:00:00'),
(19, 'C2409005', 'dsukamto@outlook.com', '$2y$10$AWU2phoqa.aY24W90ytMGOeYVZ5272bpTKS0S/nfjG.Pk84ugofNe', 'Daniel Sukamto', 1, 0, 1, '2024-09-18 07:19:39', '2024-09-18 07:19:39', '0000-00-00 00:00:00'),
(20, 'C2409006', 'faieshagroup@yahoo.com.my', '$2y$10$yNrg5PfImm3fIdCgNs8kqe6BO/a/4Jb3cA68aiTwsVQnMr7MkS0DS', 'Dr Shahizan Md Noh', 1, 0, 1, '2024-09-18 07:20:10', '2024-09-18 07:20:10', '0000-00-00 00:00:00'),
(21, 'C2409007', 'okky@idayantisudiro.com', '$2y$10$mNt9jLX/K6nawXN4KwXM3ub0J5047dQcvLzdVezIQDZjXc96s/MtO', 'Idayanti Sudiro', 1, 0, 1, '2024-09-18 07:20:30', '2024-09-18 07:20:30', '0000-00-00 00:00:00'),
(22, 'C2409008', 'Jsuhadi@yahoo.com', '$2y$10$NQfnDP2fF8.wxEXCWvysrewYI.gF0rO.8yetsHL73sa7lIIzeXRzy', 'Johan Suhadi', 1, 0, 1, '2024-09-18 07:20:56', '2024-09-18 07:20:56', '0000-00-00 00:00:00'),
(23, 'C2409009', 'jonathan_hananto511@hotmail.com', '$2y$10$tLXpwiF.CEmknRtHGX7OZu9xRt58VGr//gjcYAwMQPyoeC1v.tyoi', 'Jonathan Ezra Hananto', 1, 0, 1, '2024-09-18 07:21:50', '2024-09-18 07:21:50', '0000-00-00 00:00:00'),
(24, 'C2409010', 'kartina.sury@gmail.com', '$2y$10$jS5bBnb4mgCs38ILxQfb6uHYTqfi1MY/esylAt0Zd77Zgq5KiNjCC', 'Kartina Sury', 1, 0, 1, '2024-09-18 07:22:18', '2024-09-18 07:22:18', '0000-00-00 00:00:00'),
(25, 'C2409011', 'leviana.nattan@gmail.com', '$2y$10$4tIIH/OBMLrXQ6q1tgoxhuWK12h6mGGdWuB9hRsRze8zT3jPcLcIW', 'Leviana Nattan', 1, 0, 1, '2024-09-18 07:22:41', '2024-09-18 07:22:41', '0000-00-00 00:00:00'),
(26, 'C2409012', 'Ninet@hotmail.com', '$2y$10$02yDQrT6Ba8GOUE.FFyFf.jmxT9vfpEJgzYRpMaAkFbd4b5yfRRSK', 'Made Suardhini', 1, 0, 1, '2024-09-18 07:23:06', '2024-09-18 07:23:06', '0000-00-00 00:00:00'),
(27, 'C2409013', 'mirah.putu@gmail.com', '$2y$10$qUIjh3GGkbT7J6Ai4A0XpOKn2Osy3FiKyfHfgzs1eTg3V4m7Q5H5i', 'Mirah Putu Nikita', 1, 0, 1, '2024-09-18 07:23:24', '2024-09-18 07:23:24', '0000-00-00 00:00:00'),
(28, 'C2409014', 'mtaufiqismail@gmail.com', '$2y$10$t/S382CH5uwb8dYaP7mWA.D2Oeo44KlJIXVohz8Sa88kiDm2vaegy', 'Mohamad Taufiq Ismail', 1, 0, 1, '2024-09-18 07:24:25', '2024-09-18 07:24:25', '0000-00-00 00:00:00'),
(29, 'C2409015', 'murniati@sakinahfinance.com', '$2y$10$MeRS1GQ4iY.47syvxMhTceklzWHCFy3l./Ce9EqJC.e7CBeVYFvPW', 'Murniati', 1, 0, 1, '2024-09-18 07:24:49', '2024-09-18 07:24:49', '0000-00-00 00:00:00'),
(30, 'C2409016', 'muryo.euy@gmail.com', '$2y$10$wXr3Vvjy85pUYNarLI4XauHTzv1mpP0XmwDPku45x6e0YWSw3az2u', 'Muryo Suharsoyo', 1, 0, 1, '2024-09-18 07:25:13', '2024-09-18 07:25:13', '0000-00-00 00:00:00'),
(31, 'C2409017', 'ray.burton241092@gmail.com', '$2y$10$M5np85UIuJbDuYS7VI011Oabh3mwb2stAhaKirtrrEKB6./bwGI8a', 'Ray Burton', 1, 0, 1, '2024-09-18 07:25:39', '2024-09-18 07:25:39', '0000-00-00 00:00:00'),
(32, 'C2409018', 'thesims08@gmail.com', '$2y$10$hS90Vr3BtknCkQxwwu1tU.ojXftdCKrc8Vn45kSJUd2oIjg23BR/i', 'Yirhan Sim', 1, 0, 1, '2024-09-18 07:25:54', '2024-09-18 07:25:54', '0000-00-00 00:00:00'),
(33, 'C2409019', 'Yudith.wahyuni@gmail.com', '$2y$10$8UNTBjwPusll7ngoYlUGf.5jYG2AhCjyEpiBNa1pbLIFW1PhE7OTC', 'Yudith Wahyuni', 1, 0, 1, '2024-09-18 07:26:37', '2024-09-18 07:26:37', '0000-00-00 00:00:00'),
(34, 'C2409020', 'yacinta.adelina@gmail.com', '$2y$10$YlYGFGn25gUkNFHR8/NkieLzUN6p.V3V811rECant5BPwTkLgOIDu', 'Yacinta Adelina', 1, 0, 1, '2024-09-18 07:26:53', '2024-09-18 07:26:53', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `author_id` (`author_id`) USING BTREE;

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_enrollment`
--
ALTER TABLE `course_enrollment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `mc_answers`
--
ALTER TABLE `mc_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mc_answers_ibfk_1` (`question_id`),
  ADD KEY `mc_answers_ibfk_2` (`selected_option_id`),
  ADD KEY `mc_answers_ibfk_3` (`task_attempt_id`);

--
-- Indexes for table `mc_options`
--
ALTER TABLE `mc_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `short_answers`
--
ALTER TABLE `short_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `tasks_and_questions`
--
ALTER TABLE `tasks_and_questions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `task_question_unique` (`task_id`,`question_id`);

--
-- Indexes for table `task_attempts`
--
ALTER TABLE `task_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `member_id` (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_enrollment`
--
ALTER TABLE `course_enrollment`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_answers`
--
ALTER TABLE `mc_answers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_options`
--
ALTER TABLE `mc_options`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=329;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `short_answers`
--
ALTER TABLE `short_answers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tasks_and_questions`
--
ALTER TABLE `tasks_and_questions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `task_attempts`
--
ALTER TABLE `task_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `course_enrollment`
--
ALTER TABLE `course_enrollment`
  ADD CONSTRAINT `course_enrollment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `course_enrollment_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `mc_answers`
--
ALTER TABLE `mc_answers`
  ADD CONSTRAINT `mc_answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `mc_answers_ibfk_2` FOREIGN KEY (`selected_option_id`) REFERENCES `mc_options` (`id`),
  ADD CONSTRAINT `mc_answers_ibfk_3` FOREIGN KEY (`task_attempt_id`) REFERENCES `task_attempts` (`id`);

--
-- Constraints for table `mc_options`
--
ALTER TABLE `mc_options`
  ADD CONSTRAINT `mc_options_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `progress`
--
ALTER TABLE `progress`
  ADD CONSTRAINT `progress_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `progress_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`);

--
-- Constraints for table `short_answers`
--
ALTER TABLE `short_answers`
  ADD CONSTRAINT `short_answers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `short_answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`);

--
-- Constraints for table `tasks_and_questions`
--
ALTER TABLE `tasks_and_questions`
  ADD CONSTRAINT `tasks_and_questions_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_and_questions_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `task_attempts`
--
ALTER TABLE `task_attempts`
  ADD CONSTRAINT `task_attempts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `task_attempts_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
