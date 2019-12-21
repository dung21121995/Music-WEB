-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8888
-- Generation Time: Dec 21, 2019 at 02:31 AM
-- Server version: 5.7.24-log
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinemusicdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `album1`
--

CREATE TABLE `album1` (
  `id_album` int(11) NOT NULL,
  `album_name` varchar(100) DEFAULT NULL,
  `alnum_img` varchar(200) DEFAULT NULL,
  `view_album` int(11) DEFAULT '0',
  `date_add` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `album1`
--

INSERT INTO `album1` (`id_album`, `album_name`, `alnum_img`, `view_album`, `date_add`) VALUES
(1, 'Nhạc trẻ gây nghiện', '2cb23c354ebb44867c20f46516d4c523.jpg', 8, '2019-12-20 19:19:36'),
(2, 'Sau Tất Cả', '55a2e33a5d4d6a70f5144181c28eacb0_1452855672.jpg', 1, '2019-12-20 19:19:36'),
(3, 'còn gì đâu hai chữ đã từng (Single)', '22cddc53c8f5a2098ff6d1dfd70aa8ca.jpg', 1, '2019-12-20 19:19:36'),
(4, 'Việt Nam Tôi (single)', '8bf90008a57a96e1f376e76a32c26f0c.jpg', 2, '2019-12-20 19:19:36'),
(5, 'Top bài hát nhạc trẻ hay nhất', '9a75a103483e3789696dbce3e5dc07d8.jpg', 4, '2019-12-20 19:19:36'),
(6, 'I Love You 3000', 'I-love-you-3000.jpg', 0, '2019-12-20 19:19:36'),
(7, 'Giọng Ca Mới Nổi', '6a7ad28d9c81802dd5189096ed1300fb.jpg', 1, '2019-12-20 19:19:36'),
(8, 'Mashup V-Pop', 'dc4e430692c1e363ffe7482d1b122c52.jpg', 2, '2019-12-20 19:19:36'),
(9, 'Nhẹ Nhàng Cùng V-Pop', 'f9ff52f4eb2100da692a8036cc5e9a2f.jpg', 0, '2019-12-20 19:19:36'),
(10, 'Tớ Thích Cậu', 'b3ee3ed0274c147827047eb57d6e5519.jpg', 0, '2019-12-20 19:19:36'),
(11, 'Thời Thanh Xuân', '93a1fcb9376220172e51bf2d8988ab18.jpg', 0, '2019-12-20 19:19:36'),
(12, 'Mình Yêu Nhau Đi', '1e04683821afb20300f7636f30e88a2f.jpg', 1, '2019-12-20 19:19:36'),
(13, 'Nhạc Nhẹ Giành Cho Quán Cà Phê', '23215818_916565618495441_820435381661691273_o.jpg', 0, '2019-12-20 19:19:36'),
(14, 'Chưa Cập Nhật', NULL, 0, '2019-12-20 19:19:36');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `id_region` int(11) DEFAULT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `category_img` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `id_region`, `category_name`, `category_img`) VALUES
(1, 1, 'Nhạc Trẻ', 'a0ec6c6a7752b6fea60480c0e48716b1_1479888087.jpg'),
(2, 2, 'EDM', 'maxresdefault.jpg'),
(3, 1, 'Nhạc trữ Tình', 'bolero1.jpg'),
(4, 2, 'HipHop', 'hiphop.jpg'),
(5, 2, 'POP', 'pop.jpg'),
(6, 1, 'Dance', 'dance.jpg'),
(7, 3, 'K-POP', 'k-pop.jpg'),
(8, 2, 'Country', 'country.jpg'),
(9, 1, 'Nhạc Thiếu Nhi', 'kidsong.jpg'),
(10, 2, 'Latin', 'latin.jpg'),
(11, 1, 'Rap Việt', 'rap.jpg'),
(12, 4, 'Nhạc Không Lời', 'khongloi.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `detail_album`
--

CREATE TABLE `detail_album` (
  `id_detailA` int(11) NOT NULL,
  `id_album` int(11) DEFAULT NULL,
  `id_title` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detail_album`
--

INSERT INTO `detail_album` (`id_detailA`, `id_album`, `id_title`) VALUES
(1, 1, 1),
(2, 5, 1),
(3, 6, 1),
(4, 4, 1),
(5, 7, 2),
(6, 3, 1),
(7, 2, 1),
(8, 8, 2),
(9, 9, 2),
(10, 11, 3),
(11, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `detail_song`
--

CREATE TABLE `detail_song` (
  `id_album` int(11) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `id_song` int(11) DEFAULT NULL,
  `id_singer` int(11) DEFAULT NULL,
  `id_detail` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detail_song`
--

INSERT INTO `detail_song` (`id_album`, `id_category`, `id_song`, `id_singer`, `id_detail`) VALUES
(1, 1, 11, 14, 1),
(1, 1, 8, 11, 2),
(1, 1, 1, 1, 3),
(1, 1, 5, 8, 4),
(1, 1, 4, 7, 5),
(1, 1, 12, 15, 6),
(1, 1, 2, 5, 7),
(1, 1, 6, 8, 8),
(1, 1, 7, 8, 9),
(1, 1, 10, 12, 10),
(1, 1, 9, 9, 11),
(1, 1, 3, 6, 12),
(2, 1, 6, 8, 13),
(2, 1, 7, 8, 14),
(3, 1, 8, 11, 15),
(4, 1, 9, 9, 16),
(5, 1, 13, 16, 17),
(5, 1, 14, 9, 18),
(5, 1, 15, 9, 19),
(6, 5, 16, 17, 20),
(7, 1, 17, 18, 21),
(12, 1, 18, 7, 22),
(12, NULL, NULL, NULL, 23),
(12, 1, 19, 12, 24),
(12, 1, 21, 20, 25),
(12, NULL, NULL, NULL, 26),
(12, NULL, 20, 19, 27),
(12, NULL, 22, 12, 28),
(NULL, 5, 29, 21, 29),
(14, 5, 31, 23, 31),
(14, 5, 32, 24, 32);

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id_region` int(11) NOT NULL,
  `region_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id_region`, `region_name`) VALUES
(1, 'Việt Nam'),
(2, 'Âu Mỹ'),
(3, 'Hàn Quốc'),
(4, 'Hòa Tấu');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` varchar(10) NOT NULL,
  `name_role` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `name_role`) VALUES
('A', 'Admin'),
('N', 'Staff'),
('S', 'Singer'),
('U', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `singer`
--

CREATE TABLE `singer` (
  `id_singer` int(11) NOT NULL,
  `singer_name` varchar(100) DEFAULT NULL,
  `des_singer` varchar(1000) DEFAULT NULL,
  `singer_img` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `singer`
--

INSERT INTO `singer` (`id_singer`, `singer_name`, `des_singer`, `singer_img`) VALUES
(1, 'Hiền Hồ', NULL, NULL),
(2, 'Phương Ly', NULL, NULL),
(5, 'Khổng Tú Quỳnh', NULL, NULL),
(6, 'Rhymastic', NULL, NULL),
(7, 'Đức Phúc', NULL, NULL),
(8, 'Erik', NULL, NULL),
(9, 'Jack', NULL, NULL),
(10, 'K-ICM', NULL, NULL),
(11, 'Quân AP', NULL, NULL),
(12, 'Amee', NULL, NULL),
(13, 'Viruss', NULL, NULL),
(14, 'Hương Giang', NULL, NULL),
(15, 'Hoàng Yến Chibi', NULL, NULL),
(16, 'Đình Dũng', NULL, NULL),
(17, 'Stephanie Dougharty', NULL, NULL),
(18, 'Liz Kim Cương', NULL, NULL),
(19, 'Suni Hạ Linh', NULL, NULL),
(20, 'Min', NULL, NULL),
(21, 'Danny Avila', NULL, NULL),
(22, 'Sobin Hoàng Sơn', NULL, NULL),
(23, '911', NULL, NULL),
(24, 'The Chainsmokers', NULL, NULL),
(25, 'Danny Avila', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `id_song` int(11) NOT NULL,
  `song_name` varchar(200) DEFAULT NULL,
  `link_song` varchar(200) DEFAULT NULL,
  `status_song` varchar(10) DEFAULT NULL,
  `liycs_song` varchar(2000) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `song_img` varchar(200) DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  `week` int(11) DEFAULT '0',
  `date_add` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`id_song`, `song_name`, `link_song`, `status_song`, `liycs_song`, `id_user`, `song_img`, `views`, `week`, `date_add`) VALUES
(1, 'có như không có', 'Co-Nhu-Khong-Co-Hien-Ho-Dat-G.mp3', '1', NULL, 1, '3f588b3f74b49a8b2c70bc771df103bd.jpg', 0, 0, '2019-12-09 21:44:58'),
(2, 'Mãi mãi là một lời nói dối', 'Mai-Mai-La-Mot-Loi-Noi-Doi-Khong-Tu-Quynh-RIN9.mp3', '1', NULL, 1, '505542ae2e34eb444279ea8c1baad23e.jpg', 51, 51, '2019-12-15 21:44:58'),
(3, 'đâu chịu ngồi yên', 'Dau-Chiu-Ngoi-Yen-Rhymastic-Phuong-Ly-Touliver.mp3', '1', NULL, 1, '0902a8b57b8ce801dab8b2ca452c8b5b.jpg', 21, 0, '2019-12-15 21:44:58'),
(4, 'hết thương cạn nhớ', 'Het-Thuong-Can-Nho-Duc-Phuc.mp3', '1', NULL, 1, '97fa122b55eefd723d7b97f887ee8786.jpg', 3, 0, '2019-12-15 21:44:58'),
(5, 'Có tất cả nhưng thiếu anh', 'Co-Tat-Ca-Nhung-Thieu-Anh-ERIK.mp3', '1', NULL, 1, '6be430e44902db6e3e28e8a39034f4df.jpg', 51, 0, '2019-12-15 21:44:58'),
(6, 'mùa đông', 'Mua-Dong-ERIK.mp3', '1', NULL, 1, 'af3c21693516f42c95dd451cd447449c_1513743601.jpg', 0, 0, '2019-12-15 21:44:58'),
(7, 'sau tất cả', 'Sau-Tat-Ca-ERIK.mp3', '1', NULL, 1, '55a2e33a5d4d6a70f5144181c28eacb0_1452855672.jpg', 6, 0, '2019-12-15 21:44:58'),
(8, 'còn gì đâu hai chữ đã từng', 'Con-Gi-Dau-Hon-Chu-Da-Tung-Quan-A-P.mp3', '1', 'Lyrics:\r\nV1:\r\n\r\nCòn gì đau hơn chữ \"đã từng\"?\r\nĐã yêu đã hy vọng\r\nTừng cho nhau những ký ức không úa màu.\r\nCòn gì đau hơn chữ \"đã từng\"?\r\nĐã từng tay níu tay\r\nMà chẳng thể giữ lấy nên lạc nhau.\r\n\r\nPre:\r\n\r\nTình đẹp khi tình lỡ\r\nNếu không chúng ta phải biết vấn vương những gì?\r\nNếu không nợ nhau?\r\nNếu không tiếc nuối?\r\n\r\nChorus:\r\n\r\nVì ngày xưa ấy nghĩ rằng tay trong tay\r\nSẽ chiến thắng tất cả, mình dại khờ thế đấy.\r\nThời gian tàn nhẫn, ta chỉ biết im lặng\r\nĐành mặc cho nhân duyên sắp đặt.\r\nTừng lời đã hứa nay chẳng thể giữ nữa\r\nĐành phải nhờ người khác gánh vác.\r\nChúng ta sau này sẽ có tất cả\r\nChỉ tiếc rằng không thể có nhau như đã từng.\r\n\r\nV2:\r\nPhải chăng ta đã quá bồng bột?\r\nCứ yêu cứ mơ mộng\r\nMà không hề biết phải yêu một người thế nào.\r\nĐể khi học được cách yêu rồi\r\nMới nhận ra chúng ta\r\nChẳng còn lại gì ngoài chữ đã từng.', 1, '5651a16e61472b25af4af405a8c3df2c.jpg', 17, 0, '2019-12-15 21:44:58'),
(9, 'Việt nam tôi', 'Viet-Nam-Toi-Jack-K-ICM.mp3', '1', NULL, 1, '8bf90008a57a96e1f376e76a32c26f0c.jpg', 11, 0, '2019-12-15 21:44:58'),
(10, 'trời giấu trời mang đi', 'Troi-Giau-Troi-Mang-Di-AMEE-ViruSs.mp3', '1', NULL, 1, '9d9648688a40aecb85f8b70ebe21e82e.jpg', 10, 0, '2019-12-15 21:44:58'),
(11, 'anh ta bỏ em rồi', 'Anh-Ta-Bo-Em-Roi-Huong-Giang.mp3', '1', NULL, 1, 'd34b167ca36dcb3ee02f1a902ea57c57.jpg', 4, 0, '2019-12-15 21:44:58'),
(12, 'là anh đấy nhưng không còn yêu', 'La-Anh-Day-Nhung-Khong-Con-Yeu-Hoang-Yen-Chibi.mp3', '1', NULL, 1, '150b4b45aae7a12c1cce59426384b663.jpg', 7, 0, '2019-12-15 21:44:58'),
(13, 'Sai lầm của anh', 'Sai-Lam-Cua-Anh-Dinh-Dung.mp3', '1', NULL, 1, '1348cacf4068d3f69fc457e99e1e9801.jpg', 20, 0, '2019-12-15 21:44:58'),
(14, 'Sóng gió', 'Song-Gio-Jack-K-ICM.mp3', '1', NULL, 1, '836cf31f036fb8f89b78cfd07cd77477.jpg', 7, 0, '2019-12-15 21:44:58'),
(15, 'em gì ơi', 'Em-Gi-Oi-Jack-K-ICM.mp3', '1', NULL, 1, '353f305006cc99e50ef00877e4135d0e.jpg', 30, 0, '2019-12-15 21:44:58'),
(16, 'I love you 3000', 'I Love You 3000 - Stephanie Poetri.mp3', '1', 'Baby, take my hand\r\nI want you to be my husband\r\nCause you\'re my Iron Man\r\nAnd I love you three thousand\r\nBaby, take a chance\r\nCause I want this to be something\r\nStraight out of a Hollywood movie\r\nI see you standing there\r\nIn your Hulk outerwear\r\nAnd all I can think\r\nIs where is the ring\r\nCause I know you wanna ask\r\nScared the moment will pass\r\nI can see it in your eyes\r\nJust take me by surprise\r\nAnd all my friends they tell me they see\r\nYou planing to get on one knee\r\nBut I want it to be out of the blue\r\nSo make sure I have no clue\r\nWhen you ask\r\nBaby, take my hand\r\nI want you to be my husband\r\nCause you\'re my Iron Man\r\nAnd I love you three thousand\r\nBaby, take a chance\r\nCause I want this to be something\r\nStraight out of a Hollywood movie\r\nNow we\'re having dinner\r\nAnd baby you\'re my winner\r\nI see the way you smile\r\nYou\'re thinking about the aisle\r\nYou reach in your pocket\r\nEmotion unlocking\r\nAnd before you could ask\r\nI answer too fast\r\nAnd all my friends they tell me they see\r\nYou planing to get on one knee\r\nSo now I can\'t stop thinking about you\r\nI figured out all the clues\r\nSo now I ask\r\nBaby, take my hand\r\nI want you to be my husband\r\nCause you\'re my Iron Man\r\nAnd I love you three thousand\r\nBaby, take a chance\r\nCause I want this to be something\r\nStraight out of a Hollywood movie\r\nPa da da da da dam\r\nNo spoilers please\r\nPa da da da da dam\r\nNo spoilers please\r\nBaby, take my hand\r\nI want you to be my husband\r\nCause you\'re my Iron Man\r\nAnd I love you three thousand\r\nBaby, take a chance\r\nCause I want this to be something\r\nStraight out of a Hollywood movie, baby\r\nPa da da da da dam\r\nNo spoilers please\r\nPa da da da da dam\r\nNo spoilers please\r\nPa da da da da dam\r\nNo spoiler please\r\nPa da da da da dam\r\nAnd I love you three thousand', 1, 'A1Nto-44oXL._SS500_.jpg', 17, 0, '2019-12-15 21:44:58'),
(17, 'Nói Hết Lòng Mình', 'Noi-Het-Long-Minh-Liz-Kim-Cuong.mp3', '1', NULL, 1, 'c8438aaf614245ed48a027946f4bda55.jpg', 2, 0, '2019-12-15 21:44:58'),
(18, 'Yêu Được Không', 'Yeu-Duoc-Khong-Duc-Phuc.mp3', '1', NULL, 1, '50971fb6fecd447214299c6e659eaab2.jpg', 6, 0, '2019-12-15 21:44:58'),
(19, 'Anh Nhà Ở Đâu Thế', 'Anh-Nha-O-Dau-The-AMEE-B-Ray.mp3', '1', NULL, 1, 'artworks-000515118057-lx7joy-t500x500.jpg', 11, 0, '2019-12-15 21:44:58'),
(20, 'Đi Tìm Người Yêu', 'Di-Tim-Nguoi-Yeu-Suni-Ha-Linh.mp3', '1', NULL, 1, 'acb981e2a7cd422a07a34c46631093dd.jpg', 1, 0, '2019-12-15 21:44:58'),
(21, 'Hôn Anh', 'Hon-Anh-MIN.mp3', '1', NULL, 1, '1500862883609_500.jpg', 1, 0, '2019-12-15 21:44:58'),
(22, 'Đen ĐÁ Không Đường', 'Den-Da-Khong-Duong-AMEE.mp3', '1', NULL, 1, '8c9f583a79f97a92cd585c8c2d526cfc.jpg', 6, 0, '2019-12-15 21:44:58'),
(29, 'End Of The Night', 'EndOfTheNight-DannyAvila-5755247.mp3', '2', '', NULL, './public/images/Online Music System UC.png', 0, 0, '2019-12-18 20:04:38'),
(31, 'I Do', 'IDo-911-2757427.mp3', '1', '', 10, '911.jpg', 5, 0, '2019-12-19 10:17:41'),
(32, 'Don&#39;t Let Me Down', 'Don\'t Let Me Down - The Chainsmokers, Daya.mp3', '2', 'Crashing, hit a wall\r\nRight now I need a miracle\r\nHurry up now, I need a miracle\r\nStranded, reaching out\r\nI call your name but you&#39;re not around\r\nI say your name but you&#39;re not around\r\n\r\nI need you, I need you, I need you right now\r\nYeah, I need you right now\r\nSo don&#39;t let me, don&#39;t let me, don&#39;t let me down\r\nI think I&#39;m losing my mind now\r\nIt&#39;s in my head, darling I hope\r\nThat you&#39;ll be here, when I need you the most\r\nSo don&#39;t let me, don&#39;t let me, don&#39;t let me down\r\nD-Don&#39;t let me down\r\n\r\nDon&#39;t let me down\r\nDon&#39;t let me down, down, down\r\nDon&#39;t let me down, don&#39;t let me down, down, down\r\n\r\nR-r-running out of time\r\nI really thought you were on my side\r\nBut now there&#39;s nobody by my side\r\n\r\nI need you, I need you, I need you right now\r\nYeah, I need you right now\r\nSo don&#39;t let me, don&#39;t let me, don&#39;t let me down\r\nI think I&#39;m losing my mind now\r\nIt&#39;s in my head, darling I hope\r\nThat you&#39;ll be here, when I need you the most\r\nSo don&#39;t let me, don&#39;t let me, don&#39;t let me down\r\nD-Don&#39;t let me down\r\n\r\nDon&#39;t let me down\r\nDon&#39;t let me down, down, down\r\nDon&#39;t let me down, down, down\r\nDon&#39;t let me down, down, down\r\nDon&#39;t let me down, don&#39;t let me down, down, down\r\n\r\nOh, I think I&#39;m losing my mind now, yeah, yeah, yeah\r\nOh, I think I&#39;m losing my mind now, yeah, yeah\r\n\r\nI need you, I need you, I need you right now\r\nYeah, I need you right now\r\nSo don&#39;t let me, don&#39;t let me, don&#39;t let me down\r\nI think I&#39;m losing my mind now\r\nIt&#39;s in my head, darling I hope\r\nThat you&#39;ll be here, when I need you the most\r\nSo don&#39;t let me, don&#39;t let me, don&#39;t let me down\r\nDon&#39;t let me down\r\n\r\nYeah, don&#39;t let me down\r\nYeah, don&#39;t let me down\r\nDon&#39;t let me down, oh no\r\nSaid don&#39;t let me down\r\nDon&#39;t let me down\r\nDon&#39;t let me down\r\nDon&#39;t let me down, down, down', 10, 'The Chainsmokers, Daya.jpg', 1, 0, '2019-12-19 10:41:23');

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

CREATE TABLE `title` (
  `id_title` int(11) NOT NULL,
  `title_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`id_title`, `title_name`) VALUES
(1, 'Album Hot'),
(2, 'Nổi Bật'),
(3, 'Giai Điệu Yêu Thương'),
(4, 'Cuối Tuần Nghe Gì?'),
(5, 'Giây Phút Thư Giãn'),
(6, 'Cà Phê Sáng');

-- --------------------------------------------------------

--
-- Table structure for table `user_web`
--

CREATE TABLE `user_web` (
  `id_user` int(11) NOT NULL,
  `user_fullname` varchar(200) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `user_password` varchar(100) DEFAULT NULL,
  `id_role` varchar(10) DEFAULT NULL,
  `user_img` varchar(100) DEFAULT NULL,
  `date_cre` datetime DEFAULT CURRENT_TIMESTAMP,
  `time_lock` int(11) DEFAULT '1',
  `note` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_web`
--

INSERT INTO `user_web` (`id_user`, `user_fullname`, `birthday`, `address`, `user_name`, `email`, `user_password`, `id_role`, `user_img`, `date_cre`, `time_lock`, `note`) VALUES
(1, 'Nguyen van A', '2000-02-18', NULL, 'chinhhuy', 'chinh@123', 'chinh89', 'A', '6be430e44902db6e3e28e8a39034f4df.jpg', '2019-12-19 20:35:31', 1, NULL),
(3, 'Tran Van C', NULL, NULL, 'ui', 'hj@78', 'vn2019', 'U', NULL, '2019-12-19 20:35:31', 2, NULL),
(4, NULL, NULL, NULL, 'gh', 'hj', NULL, 'U', NULL, '2019-12-19 20:35:31', 1, NULL),
(6, NULL, NULL, NULL, 'gggg', 'dshjdh@dnsds', '$2y$10$DE9pWuLXGNGxytXdEK.vTeUv.N7RllK04wYbPWlEBaKaAYWmvGkP2', NULL, NULL, '2019-12-19 20:35:31', 1, NULL),
(7, NULL, NULL, NULL, 'gggg', 'dshjdh@dnsds', '$2y$10$VsIjfWnE0q.BJ7ohw1dipO.Z/QPXW7/pst9iGdOw6MlqxmfS0W8.K', NULL, NULL, '2019-12-19 20:35:31', 1, NULL),
(8, NULL, NULL, NULL, 'gggg', 'dshjdh@dnsds', '$2y$10$AR50VoFcdh5ex4R4E/LyV.oqi.4YBy9JQvrDWhGWmfLZk4pfVySl.', NULL, NULL, '2019-12-19 20:35:31', 1, NULL),
(9, NULL, NULL, NULL, 'dd', 'a@sdsds', '$2y$10$wOZJCkSddeTqV97f/6El.OFnmXNVG3PxSNmm6BdYoZTH6CY.lZvtG', 'U', NULL, '2019-12-11 20:35:31', 1, NULL),
(10, 'Phùng Đức Chính', NULL, NULL, 'as', 'a@ww', '$2y$10$xYK4R5T4PtXa2MWfrF8O8uTYcZqAUB2WStoFRekHElC7z7hWPUG56', 'A', NULL, '2019-12-19 20:35:31', 1, NULL),
(11, NULL, NULL, NULL, 'sssss', 'f@www', '$2y$10$8wuAVVSzSE3SRlx9obFf/.nl.GpZ36FN59Jeo.iIDtttQTFAXE7gu', NULL, NULL, '2019-12-19 20:35:31', 1, NULL),
(12, NULL, NULL, NULL, 'sssn', 'nm@334', '$2y$10$pss7nig9pf8HaT2h7m5Cj.aKwDbz2CY65gAShMI8zrQ0tV/1ro3uK', NULL, NULL, '2019-12-19 20:35:31', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album1`
--
ALTER TABLE `album1`
  ADD PRIMARY KEY (`id_album`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`),
  ADD KEY `id_region` (`id_region`);

--
-- Indexes for table `detail_album`
--
ALTER TABLE `detail_album`
  ADD PRIMARY KEY (`id_detailA`),
  ADD KEY `id_album` (`id_album`),
  ADD KEY `id_title` (`id_title`);

--
-- Indexes for table `detail_song`
--
ALTER TABLE `detail_song`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_song` (`id_song`),
  ADD KEY `id_singer` (`id_singer`),
  ADD KEY `id_album` (`id_album`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id_region`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `singer`
--
ALTER TABLE `singer`
  ADD PRIMARY KEY (`id_singer`);

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`id_song`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`id_title`);

--
-- Indexes for table `user_web`
--
ALTER TABLE `user_web`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album1`
--
ALTER TABLE `album1`
  MODIFY `id_album` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `detail_album`
--
ALTER TABLE `detail_album`
  MODIFY `id_detailA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `detail_song`
--
ALTER TABLE `detail_song`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id_region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `singer`
--
ALTER TABLE `singer`
  MODIFY `id_singer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `id_song` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `title`
--
ALTER TABLE `title`
  MODIFY `id_title` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_web`
--
ALTER TABLE `user_web`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`);

--
-- Constraints for table `detail_album`
--
ALTER TABLE `detail_album`
  ADD CONSTRAINT `detail_album_ibfk_1` FOREIGN KEY (`id_album`) REFERENCES `album1` (`id_album`),
  ADD CONSTRAINT `detail_album_ibfk_2` FOREIGN KEY (`id_title`) REFERENCES `title` (`id_title`);

--
-- Constraints for table `detail_song`
--
ALTER TABLE `detail_song`
  ADD CONSTRAINT `detail_song_ibfk_1` FOREIGN KEY (`id_song`) REFERENCES `song` (`id_song`),
  ADD CONSTRAINT `detail_song_ibfk_2` FOREIGN KEY (`id_singer`) REFERENCES `singer` (`id_singer`),
  ADD CONSTRAINT `detail_song_ibfk_3` FOREIGN KEY (`id_album`) REFERENCES `album1` (`id_album`),
  ADD CONSTRAINT `detail_song_ibfk_4` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`);

--
-- Constraints for table `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `song_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user_web` (`id_user`);

--
-- Constraints for table `user_web`
--
ALTER TABLE `user_web`
  ADD CONSTRAINT `user_web_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
