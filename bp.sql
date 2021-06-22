-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 01 Haz 2021, 23:53:24
-- Sunucu sürümü: 10.4.18-MariaDB
-- PHP Sürümü: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `bp`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin_users`
--

CREATE TABLE `admin_users` (
  `user_id` int(11) NOT NULL,
  `photo` varchar(2000) NOT NULL,
  `name_surname` varchar(2000) NOT NULL,
  `user_name` varchar(2000) NOT NULL,
  `password` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(2000) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `web_site` text NOT NULL,
  `facebook` text NOT NULL,
  `instagram` text NOT NULL,
  `twitter` text NOT NULL,
  `linkedin` text NOT NULL,
  `pinterest` text NOT NULL,
  `gender` varchar(1) NOT NULL,
  `status` varchar(1) NOT NULL,
  `authorization_id` int(11) NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `admin_users`
--

INSERT INTO `admin_users` (`user_id`, `photo`, `name_surname`, `user_name`, `password`, `birthday`, `email`, `phone_number`, `web_site`, `facebook`, `instagram`, `twitter`, `linkedin`, `pinterest`, `gender`, `status`, `authorization_id`, `registration_date`) VALUES
(1, 'GameMaster_photo_160723c592597f.jpg', 'Barış KURT', 'GameMaster', '03f05869450ea1b4d18c3f5191f29050', '2000-01-30', 'kurt-bar07@hotmail.com', '(532) 497-3873', 'http://barisyazilim.net/', 'https://www.facebook.com/kurt.baris07', 'https://www.instagram.com/kurtbar07/', 'https://twitter.com/Barkurt14443348', 'https://www.linkedin.com/in/bar%C4%B1%C5%9F-kurt-31ba65201/', '', '1', '1', 2, '2021-04-04 21:15:45'),
(6, 'shnbsra_photo_160723b36f2251.jpg', 'Büşra ŞAHİN', 'shnbsra', '7484ab7797fa691445ed3ef8dec6e4da', '2000-03-15', 'shnbsra270@gmail.com', '(546) 688-2028', '', 'https://www.facebook.com/busra.sahin.589', 'https://www.instagram.com/shn_busraa/', '', '', '', '0', '1', 2, '2021-04-09 19:26:08'),
(7, 'sem_photo_160723df92ce2a.jpg', 'Semih ACAR', 'sem', '8f41a76dad78a5a334826729bdedf7c7', '1996-11-16', 'semih_acar01@hotmail.com', '(535) 683-4185', '', 'https://www.facebook.com/smhacar', 'https://www.instagram.com/smhacarr/', '', '', '', '1', '1', 2, '2021-04-09 19:30:27'),
(8, 'ibrahimbykdmr_photo_1607243d5d8b47.jpg', 'Ibrahim Bedir BÜYÜKDEMİR', 'ibrahimbykdmr', '59a917a0cad8087d935c9c462e4781f0', '1998-04-03', 'ibrahim.buyukdemir@outlook.com', '(537) 397-3550', '', 'https://www.facebook.com/ibrahimbedir.buyukdemir', 'https://www.instagram.com/ibrahim.buyukdemir/', '', '', '', '1', '1', 2, '2021-04-09 19:54:17'),
(17, 'Mr_profile_photo.png', 'Ömer IŞIK', 'omer61', '72f225f126fc4656ad07f32fc1c52c5e', '2000-08-12', 'omer.isik.1025@gmail.com', '(555) 193-9098', '', '', '', '', '', '', '1', '1', 3, '2021-04-16 18:52:27');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `coming_soon`
--

CREATE TABLE `coming_soon` (
  `id` int(11) NOT NULL,
  `header` varchar(2000) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `coming_soon`
--

INSERT INTO `coming_soon` (`id`, `header`, `description`, `user_id`, `time`) VALUES
(1, 'Bakımdayız...', 'Sizin Için Yenileniyoruz. Site Yapımızı Daha Iyi Hale Getiriyoruz', 1, '2021-04-24');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `photo` varchar(2000) NOT NULL,
  `header` varchar(1000) NOT NULL,
  `description` varchar(3000) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `gallery`
--

INSERT INTO `gallery` (`id`, `photo`, `header`, `description`, `user_id`, `date`) VALUES
(1, 'Resim_1_photo_16076dcc9d6bad.jpg', 'Resim 1', 'merhaba iyi günler burası kahramanmaraş', 1, '2021-04-14 15:15:05'),
(3, 'Resim_2_photo_16079b847f11b7.jpg', 'Resim 2', 'merhaba burası 2.resim açıklaması', 1, '2021-04-16 19:16:07');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `homepage_settings`
--

CREATE TABLE `homepage_settings` (
  `id` int(11) NOT NULL,
  `background` varchar(2000) NOT NULL,
  `top_header` varchar(2000) NOT NULL,
  `bottom_header` text NOT NULL,
  `history` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `homepage_settings`
--

INSERT INTO `homepage_settings` (`id`, `background`, `top_header`, `bottom_header`, `history`, `user_id`, `date`) VALUES
(1, 'homepage_background_16079a6f2406ff.jpg', 'KAHRAMANMARAŞ', 'Kahramanmaraş Il Nüfusu: 1.168.163 (2020 Sonu). İlin Yüzölçümü 14.519  Km2&#039;Dir. İlde  Km2&#039;Ye 80 Kişi Düşmektedir.', 'Kahramanmaraş, eski ve halk arasındaki adıyla Maraş, Türkiye&#039;nin Akdeniz Bölgesinde bulunan bir ili ve en kalabalık on sekizinci kentidir. Kurtuluş Savaşı&#039;nda işgale direnişi nedeniyle TBMM tarafından 5 Nisan 1925&#039;te şehre İstiklal Madalyası verilmiştir. Maraş olan adı, 7 Şubat 1973&#039;te Kahramanmaraş olarak değiştirilmiştir.', 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `url` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `icon` varchar(2000) NOT NULL,
  `logo` varchar(2000) NOT NULL,
  `admin_logo` varchar(2000) NOT NULL,
  `login_background` varchar(2000) NOT NULL,
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  `status` int(1) NOT NULL,
  `theme` varchar(20) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(2000) NOT NULL,
  `address` text NOT NULL,
  `facebook` text NOT NULL,
  `instagram` text NOT NULL,
  `linkedin` text NOT NULL,
  `pinterest` text NOT NULL,
  `twitter` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `datetime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`id`, `url`, `title`, `icon`, `logo`, `admin_logo`, `login_background`, `description`, `keywords`, `status`, `theme`, `phone_number`, `email`, `address`, `facebook`, `instagram`, `linkedin`, `pinterest`, `twitter`, `user_id`, `datetime`) VALUES
(1, 'http://localhost/bp', 'Kahramanmaraş', 'icon_16072d9485a1ff.png', 'logo_16074aecda4a93.png', 'admin_logo_16074bc5a9d7f4.png', 'login_background_16077376d822dd.jpg', 'Açıklama', 'Büşra,Barış,Semih', 1, 'default', '(532) 497-3873', 'kurt-bar07@hotmail.com', 'hacet mah.  berk sok.', 'https://www.facebook.com/kurt.baris07', 'https://www.instagram.com/kurtbar07/', 'https://www.linkedin.com/in/bar%C4%B1%C5%9F-kurt-31ba65201/', '', 'https://twitter.com/Barkurt14443348', 1, '2021-04-08');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `system_archives`
--

CREATE TABLE `system_archives` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `operation` varchar(2000) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `system_archives`
--

INSERT INTO `system_archives` (`id`, `description`, `operation`, `user_id`, `datetime`) VALUES
(1, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-05 15:08:27'),
(2, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-05 17:27:57'),
(3, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-05 17:32:43'),
(4, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-05 18:10:05'),
(5, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-05 19:32:55'),
(6, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-05 19:33:24'),
(7, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-05 19:40:29'),
(8, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-05 19:40:43'),
(9, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-05 23:16:25'),
(10, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-05 23:39:26'),
(11, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-05 23:39:40'),
(12, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-05 23:40:46'),
(13, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-05 23:41:48'),
(14, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-05 23:42:11'),
(15, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-06 03:13:35'),
(16, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-06 03:34:42'),
(17, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-06 03:34:47'),
(18, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-06 03:35:16'),
(19, 'Profil bilgileri güncellendi', 'Profil Güncellendi', 1, '2021-04-06 10:29:10'),
(20, 'Profil şifresi güncellendi', 'Profil Güncellendi', 1, '2021-04-06 10:31:15'),
(21, 'Profil şifresi güncellendi', 'Profil Güncellendi', 1, '2021-04-06 10:51:53'),
(22, 'Profil bilgileri güncellendi', 'Profil Güncellendi', 1, '2021-04-06 11:46:04'),
(23, 'Barış Kurt isimli yetki eklendi', 'Yetki Eklendi', 1, '2021-04-07 03:15:02'),
(24, '4 id\'li Yazar yetkisi silindi', 'Yetki Silindi', 1, '2021-04-07 14:43:58'),
(25, 'Editör isimli yetki eklendi', 'Yetki Eklendi', 1, '2021-04-07 14:48:00'),
(26, 'Yazar isimli yetki eklendi', 'Yetki Eklendi', 1, '2021-04-07 14:51:33'),
(27, '7 id li Yazar yetkisi silindi', 'Yetki Silindi', 1, '2021-04-07 14:54:10'),
(28, '6 id li Editör yetkisi silindi', 'Yetki Silindi', 1, '2021-04-07 14:55:58'),
(29, 'Editör isimli yetki eklendi', 'Yetki Eklendi', 1, '2021-04-07 14:56:46'),
(30, 'Yazar isimli yetki eklendi', 'Yetki Eklendi', 1, '2021-04-07 14:59:53'),
(31, '9 id li Yazar yetkisi silindi', 'Yetki Silindi', 1, '2021-04-07 15:49:54'),
(32, 'Okur isimli yetki eklendi', 'Yetki Eklendi', 1, '2021-04-07 15:59:37'),
(33, 'Okur isimli yetki eklendi', 'Yetki Eklendi', 1, '2021-04-07 16:00:14'),
(34, '5 id li Okur yetkisi silindi', 'Yetki Silindi', 1, '2021-04-07 16:05:59'),
(35, '4 id li Yazar yetkisi silindi', 'Yetki Silindi', 1, '2021-04-07 16:06:20'),
(36, '2 id li Site Yöneticisi yetkisi silindi', 'Yetki Silindi', 1, '2021-04-07 16:29:38'),
(37, 'Site Yöneticisi isimli yetki eklendi', 'Yetki Eklendi', 1, '2021-04-07 16:31:24'),
(38, '2 id li Editör yetkisi silindi', 'Yetki Silindi', 1, '2021-04-07 16:31:45'),
(39, 'Yazar isimli yetki eklendi', 'Yetki Eklendi', 1, '2021-04-07 19:11:31'),
(40, 'Site Yöneticisi isimli yetki güncellendi', 'Yetki Güncellendi', 1, '2021-04-08 00:31:11'),
(41, 'Site Yöneticisi isimli yetki güncellendi', 'Yetki Güncellendi', 1, '2021-04-08 00:31:54'),
(42, 'Site Yöneticisi isimli yetki güncellendi', 'Yetki Güncellendi', 1, '2021-04-08 00:32:06'),
(43, '2 id li Site Yöneticisi yetkisi silindi', 'Yetki Silindi', 1, '2021-04-08 00:33:31'),
(44, 'Site Yöneticisi isimli yetki eklendi', 'Yetki Eklendi', 1, '2021-04-08 00:42:49'),
(45, 'Site Yöneticisi isimli yetki güncellendi', 'Yetki Güncellendi', 1, '2021-04-08 19:59:41'),
(46, 'Site Yöneticisi isimli yetki güncellendi', 'Yetki Güncellendi', 1, '2021-04-08 20:00:41'),
(47, '2 id li Site Yöneticisi yetkisi silindi', 'Yetki Silindi', 1, '2021-04-08 20:01:14'),
(48, 'Site Yöneticisi isimli yetki eklendi', 'Yetki Eklendi', 1, '2021-04-08 20:03:24'),
(49, 'Editör isimli yetki eklendi', 'Yetki Eklendi', 1, '2021-04-08 20:04:14'),
(50, '2 id li Site Yöneticisi yetkisi silindi', 'Yetki Silindi', 1, '2021-04-08 20:05:40'),
(51, 'Profil bilgileri güncellendi', 'Profil Güncellendi', 1, '2021-04-08 20:14:04'),
(52, 'Profil bilgileri güncellendi', 'Profil Güncellendi', 1, '2021-04-08 20:14:26'),
(53, 'Profil bilgileri güncellendi', 'Profil Güncellendi', 1, '2021-04-09 01:03:12'),
(54, 'Profil bilgileri güncellendi', 'Profil Güncellendi', 1, '2021-04-09 01:03:22'),
(55, 'Yeni admin panel üyesi eklendi', 'Admin Üyesi Eklendi', 1, '2021-04-09 20:34:34'),
(56, 'Yeni admin panel üyesi eklendi', 'Admin Üyesi Eklendi', 1, '2021-04-09 20:36:23'),
(57, 'Editör isimli yetki güncellendi', 'Yetki Güncellendi', 1, '2021-04-10 11:51:24'),
(58, 'Editör isimli yetki güncellendi', 'Yetki Güncellendi', 1, '2021-04-10 11:53:16'),
(59, 'Editör isimli yetki güncellendi', 'Yetki Güncellendi', 1, '2021-04-10 11:53:32'),
(60, 'Editör isimli yetki güncellendi', 'Yetki Güncellendi', 1, '2021-04-10 14:07:56'),
(61, 'Elbise isimli yetki eklendi', 'Yetki Eklendi', 1, '2021-04-10 16:00:19'),
(62, '3 id li Elbise yetkisi silindi', 'Yetki Silindi', 1, '2021-04-10 16:00:25'),
(63, 'Yazar isimli yetki eklendi', 'Yetki Eklendi', 1, '2021-04-10 22:36:11'),
(64, 'Profil bilgileri güncellendi', 'Profil Güncellendi', 1, '2021-04-11 00:53:47'),
(65, 'Profil bilgileri güncellendi', 'Profil Güncellendi', 1, '2021-04-11 02:30:59'),
(66, 'Profil bilgileri güncellendi', 'Profil Güncellendi', 1, '2021-04-11 02:46:30'),
(67, 'Profil bilgileri güncellendi', 'Profil Güncellendi', 1, '2021-04-11 02:47:12'),
(68, 'Profil bilgileri güncellendi', 'Profil Güncellendi', 1, '2021-04-11 02:50:25'),
(69, 'Profil bilgileri güncellendi', 'Profil Güncellendi', 1, '2021-04-11 02:54:09'),
(70, 'shnbsra üyesi başarıyla güncellendi', 'Üye Güncellendi', 1, '2021-04-11 02:56:39'),
(71, 'Profil bilgileri güncellendi', 'Profil Güncellendi', 1, '2021-04-11 03:01:29'),
(72, 'sem üyesi başarıyla güncellendi', 'Üye Güncellendi', 1, '2021-04-11 03:08:25'),
(73, 'ibrahimbykdmr üyesi başarıyla güncellendi', 'Üye Güncellendi', 1, '2021-04-11 03:33:25'),
(74, 'asdasds admin paneli üyesi eklendi', 'Admin Üyesi Eklendi', 1, '2021-04-11 04:28:29'),
(75, 'asdasds admin paneli üyesi silindi', 'Admin Üyesi Silindi', 1, '2021-04-11 04:28:36'),
(76, 'Site Yöneticisi isimli yetki güncellendi', 'Yetki Güncellendi', 1, '2021-04-11 04:29:36'),
(77, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-11 14:11:04'),
(78, 'Site Yöneticisi isimli yetki güncellendi', 'Yetki Güncellendi', 1, '2021-04-11 15:04:27'),
(79, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-12 16:34:03'),
(80, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-12 16:52:34'),
(81, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-12 16:53:41'),
(82, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-12 22:40:11'),
(83, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-12 23:34:21'),
(84, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-13 00:32:10'),
(85, 'Bakımda sayfası güncellendi', 'Bakımda sayfası Güncellendi', 1, '2021-04-13 23:28:08'),
(86, 'Bakımda sayfası güncellendi', 'Bakımda sayfası Güncellendi', 1, '2021-04-13 23:32:36'),
(87, 'Bakımda sayfası güncellendi', 'Bakımda sayfası Güncellendi', 1, '2021-04-13 23:33:05'),
(88, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-13 23:53:26'),
(89, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-14 01:00:39'),
(90, 'Site Yöneticisi isimli yetki güncellendi', 'Yetki Güncellendi', 1, '2021-04-14 01:37:54'),
(91, 'tas_erkan üyesi eklendi', 'Üye Eklendi', 1, '2021-04-14 02:07:03'),
(92, 'isikomer üyesi eklendi', 'Üye Eklendi', 1, '2021-04-14 10:39:10'),
(93, 'tas_erkan üyesi başarıyla güncellendi', 'Üye Güncellendi', 1, '2021-04-14 11:32:31'),
(94, 'isikomer üyesi silindi', 'Üye Silindi', 1, '2021-04-14 11:41:21'),
(95, 'Resim 1 fotoğraf eklendi', 'Fotoğraf Eklendi', 1, '2021-04-14 15:15:05'),
(96, 'Resim 2 fotoğraf eklendi', 'Fotoğraf Eklendi', 1, '2021-04-14 15:20:40'),
(97, 'qweqwe üyesi eklendi', 'Üye Eklendi', 1, '2021-04-14 15:56:01'),
(98, 'qweqwe üyesi silindi', 'Üye Silindi', 1, '2021-04-14 16:19:31'),
(99, 'asdads üyesi eklendi', 'Üye Eklendi', 1, '2021-04-14 16:40:11'),
(100, 'asdads üyesi silindi', 'Üye Silindi', 1, '2021-04-14 16:40:33'),
(101, 'Resim 2 fotoğrafı başarıyla güncellendi', 'Fotoğraf Güncellendi', 1, '2021-04-14 20:03:36'),
(102, 'Resim 2 fotoğrafı silindi', 'Fotoğraf Silindi', 1, '2021-04-14 20:08:02'),
(103, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-14 21:41:03'),
(104, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-14 21:41:49'),
(105, 'Anasayfa ayarları güncellendi', 'Anasayfa Ayarları Güncellendi', 1, '2021-04-16 17:40:06'),
(106, 'Anasayfa ayarları güncellendi', 'Anasayfa Ayarları Güncellendi', 1, '2021-04-16 17:58:20'),
(107, 'Anasayfa ayarları güncellendi', 'Anasayfa Ayarları Güncellendi', 1, '2021-04-16 18:02:10'),
(108, 'omer61 admin paneli üyesi eklendi', 'Admin Üyesi Eklendi', 1, '2021-04-16 18:52:27'),
(109, 'Site Yöneticisi isimli yetki güncellendi', 'Yetki Güncellendi', 1, '2021-04-16 18:58:22'),
(110, 'Site Yöneticisi isimli yetki güncellendi', 'Yetki Güncellendi', 1, '2021-04-16 18:59:03'),
(111, 'Resim 2 fotoğraf eklendi', 'Fotoğraf Eklendi', 1, '2021-04-16 19:16:07'),
(112, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-16 19:25:10'),
(113, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-17 12:48:25'),
(114, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-18 20:22:31'),
(115, 'Site ayarları güncellendi', 'Site Ayarları Güncellendi', 1, '2021-04-18 20:23:51'),
(116, 'Site Yöneticisi isimli yetki güncellendi', 'Yetki Güncellendi', 1, '2021-04-19 22:40:51'),
(117, 'Site Yöneticisi isimli yetki güncellendi', 'Yetki Güncellendi', 1, '2021-04-19 22:41:13'),
(118, 'Site Yöneticisi isimli yetki güncellendi', 'Yetki Güncellendi', 1, '2021-04-19 22:48:41');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `photo` varchar(2000) NOT NULL,
  `name_surname` varchar(2000) NOT NULL,
  `user_name` varchar(2000) NOT NULL,
  `password` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(2000) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `status` varchar(1) NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `photo`, `name_surname`, `user_name`, `password`, `birthday`, `email`, `phone_number`, `gender`, `status`, `registration_date`) VALUES
(1, 'tas_erkan_photo_1607624176e5c3.jpg', 'Erkan TAŞ', 'tas_erkan', '202cb962ac59075b964b07152d234b70', '1999-05-23', 'erkant0665@gmail.com', '(538) 617-8224', '1', '1', '2021-04-14 02:07:03');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_authorization`
--

CREATE TABLE `user_authorization` (
  `authorization_id` int(11) NOT NULL,
  `name` varchar(2000) NOT NULL,
  `authorization_color` varchar(50) NOT NULL,
  `pages` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `user_authorization`
--

INSERT INTO `user_authorization` (`authorization_id`, `name`, `authorization_color`, `pages`, `user_id`, `datetime`) VALUES
(1, 'Kurucu', 'info', 'settings,admin_authorization,admin_user_transactions,user_transactions,gallery_transactions', 1, '2021-04-07 12:44:53'),
(2, 'Site Yöneticisi', 'success', 'settings,admin_authorization,system_archives,admin_user_transactions,user_transactions,gallery_transactions', 1, '2021-04-08 20:04:14'),
(3, 'Yazar', 'primary', '', 1, '2021-04-10 22:36:11');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `visitor_book`
--

CREATE TABLE `visitor_book` (
  `id` int(11) NOT NULL,
  `name_surname` varchar(2000) NOT NULL,
  `email` varchar(2000) NOT NULL,
  `message` text NOT NULL,
  `ip` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `visitor_book`
--

INSERT INTO `visitor_book` (`id`, `name_surname`, `email`, `message`, `ip`) VALUES
(1, 'Barış Kurt', 'kurt-bar07@hotmail.com', 'site çok kötü', '::1'),
(2, 'Barış Kurt', 'kurt-bar07@hotmail.com', 'asdasd', '::1');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Tablo için indeksler `coming_soon`
--
ALTER TABLE `coming_soon`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `homepage_settings`
--
ALTER TABLE `homepage_settings`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `system_archives`
--
ALTER TABLE `system_archives`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `user_authorization`
--
ALTER TABLE `user_authorization`
  ADD PRIMARY KEY (`authorization_id`);

--
-- Tablo için indeksler `visitor_book`
--
ALTER TABLE `visitor_book`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Tablo için AUTO_INCREMENT değeri `coming_soon`
--
ALTER TABLE `coming_soon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `homepage_settings`
--
ALTER TABLE `homepage_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `system_archives`
--
ALTER TABLE `system_archives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `visitor_book`
--
ALTER TABLE `visitor_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
