-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 31, 2025 lúc 09:31 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `lesson`
--

INSERT INTO `lesson` (`LessonID`, `lesson_name`, `duration`, `description`, `content`, `lesson_image`) VALUES
(1, 'Bài học mở đầu', '00:02:30', 'Các câu chào hỏi cơ bản.', 'A: Hey, What\'s up bro?\r\nB: Very Good! And you?\r\nA: Me too, Let\'s play to Pubg together!', 'img/lessons/lesson1.png'),
(8, 'Học câu chuyện', '01:15:00', 'Tìm hiểu các khái niệm cơ bản về phát triển web, bao gồm HTML, CSS và JavaScript.', 'Nội dung chi tiết về HTML, CSS, JavaScript và cách chúng hoạt động cùng nhau để tạo nên một trang web động...', 'img/lessons/lesson2.png');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`NewsID`, `title`, `content`, `author`, `image`, `subtitle`) VALUES
(11, 'Nguyễn Đắc Tuấn Anh đẹp trai', 'Nguyễn Đắc Tuấn Anh đẹp traiNguyễn Đắc Tuấn Anh đẹp traiNguyễn Đắc Tuấn Anh đẹp traiNguyễn Đắc Tuấn Anh đẹp traiNguyễn Đắc Tuấn Anh đẹp traiNguyễn Đắc Tuấn Anh đẹp traiNguyễn Đắc Tuấn Anh đẹp traiNguyễn Đắc Tuấn Anh đẹp traiNguyễn Đắc Tuấn Anh đẹp traiNguyễn Đắc Tuấn Anh đẹp traiNguyễn Đắc Tuấn Anh đẹp traiNguyễn Đắc Tuấn Anh đẹp traiNguyễn Đắc Tuấn Anh đẹp traiNguyễn Đắc Tuấn Anh đẹp trai', 'NGUYỄN ĐẮC TUẤN ANH', 'img/news/Screenshot 2025-06-09 232655.png', 'Nguyễn Đắc Tuấn Anh đẹp trai');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `test`
--

CREATE TABLE `test` (
  `TestID` int(11) NOT NULL,
  `test_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `test`
--

INSERT INTO `test` (`TestID`, `test_name`, `description`, `content`) VALUES
(2, 'Kiểm tra Tiếng Anh', 'Kiểm tra từ vựng và ngữ pháp Tiếng Anh', 'Câu 1: What is the capital of France? \r\nCâu 2: Fill in the blank: I ___ a student.\r\ncâu 3: ai ngu hơn Đức Anhhh');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`email`, `full_name`, `phone_number`, `gender`, `birth_year`, `password`, `role`, `user_image`) VALUES
('admin@gmail.com', 'Admin Hansome', '09999999999', 'Khác', 2004, '123', 'admin', 'images/users/admin.jpg'),
('ducanh@edu.com', 'Phạm Đức Anh', '0987654321', 'Nam', 2004, '111', 'user', 'img/users/avt2.png'),
('ta2@gmail.com', 'Nguyễn Đắc Tuấn Anh', '0123456789', 'Nam', 2022, '321', 'user', NULL);

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
  MODIFY `LessonID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `NewsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `test`
--
ALTER TABLE `test`
  MODIFY `TestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
