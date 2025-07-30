-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 30, 2025 lúc 06:27 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bai_tap_lon`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lesson`
--

CREATE TABLE `lesson` (
  `LessonID` int(11) NOT NULL,
  `lesson_name` varchar(255) NOT NULL,
  `duration` time DEFAULT NULL,
  `description` text DEFAULT NULL,
  `content` text NOT NULL,
  `lesson_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lesson`
--

INSERT INTO `lesson` (`LessonID`, `lesson_name`, `duration`, `description`, `content`, `lesson_image`) VALUES
(1, 'Bài học mở đầu b', '00:00:00', 'Câu chào\r\nCâu hỏi thăm xã giao', 'Hello!\r\nWhat\'s up bro?\r\nHow are you?\r\n- I\'m fine. And you?', 'images/lessons/math_addition.jpg'),
(2, 'Tiếng Anh: Từ vựng cơ bản', '02:00:00', 'Học các từ vựng Tiếng Anh thông dụng.', 'Nội dung: Từ vựng về gia đình, công việc...', 'images/lessons/english_vocabulary.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `NewsID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`NewsID`, `title`, `content`, `author`, `image`, `subtitle`) VALUES
(1, 'Tầm quan trọng của giáo dục trực tuyến', 'Bài viết thảo luận về lợi ích của học trực tuyến trong thời đại số.', 'Nguyễn Văn C', 'images/news/online_education.jpg', 'Học tập mọi lúc, mọi nơi'),
(2, 'Công nghệ AI trong giáo dục', 'AI đang thay đổi cách chúng ta học tập và giảng dạy.', 'Trần Thị D', 'images/news/ai_education.jpg', 'Tương lai của giáo dục');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `test`
--

CREATE TABLE `test` (
  `TestID` int(11) NOT NULL,
  `test_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `test`
--

INSERT INTO `test` (`TestID`, `test_name`, `description`, `content`) VALUES
(1, 'Kiểm tra Toán cơ bản', 'Bài kiểm tra về các khái niệm toán học cơ bản', 'Câu 1: 2 + 2 = ? \nCâu 2: Giải phương trình x + 5 = 10'),
(2, 'Kiểm tra Tiếng Anh', 'Kiểm tra từ vựng và ngữ pháp Tiếng Anh', 'Câu 1: What is the capital of France? \nCâu 2: Fill in the blank: I ___ a student.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `email` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `gender` enum('Nam','Nữ','Khác') DEFAULT 'Khác',
  `birth_year` int(11) DEFAULT NULL CHECK (`birth_year` > 1900 and `birth_year` <= 2025),
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `user_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`email`, `full_name`, `phone_number`, `gender`, `birth_year`, `password`, `role`, `user_image`) VALUES
('binh11@edu.com', 'Nguyễn Thị Bình', '0147852369', 'Nữ', 2025, '321', 'user', NULL),
('nguyen.van.a@gmail.com', 'Nguyễn Văn A', '0912345678', 'Nam', 1995, 'hashed_password_1', 'user', 'images/users/nguyen_van_a.jpg'),
('oke@gmail.com', 'Ô Văn Kê', '0321654987', 'Nam', 2025, '123', 'user', NULL),
('sung@edu.com', 'Hồ Thị Sung', '0123456789', 'Nữ', 2025, '123', 'user', NULL),
('tran.thi.b@gmail.com', 'Trần Thị B', '0987654321', 'Nữ', 1998, '123', 'admin', 'images/users/tran_thi_b.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`LessonID`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`NewsID`);

--
-- Chỉ mục cho bảng `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`TestID`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `lesson`
--
ALTER TABLE `lesson`
  MODIFY `LessonID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `NewsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `test`
--
ALTER TABLE `test`
  MODIFY `TestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
