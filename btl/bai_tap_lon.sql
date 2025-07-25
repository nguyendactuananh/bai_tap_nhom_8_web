-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 25, 2025 lúc 07:46 PM
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
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `AdminID` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `AdminName` varchar(100) NOT NULL,
  `YearOfBirth` int(11) DEFAULT NULL CHECK (`YearOfBirth` between 1900 and 2025),
  `Gender` enum('M','F') DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL CHECK (`PhoneNumber` regexp '^[0-9]{10,15}$'),
  `avatar_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lesson`
--

CREATE TABLE `lesson` (
  `LessonID` varchar(50) NOT NULL,
  `LessonName` varchar(100) NOT NULL,
  `Duration` int(11) DEFAULT NULL CHECK (`Duration` > 0),
  `Description` text DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `NewsID` varchar(50) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Content` text NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `AdminID` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student`
--

CREATE TABLE `student` (
  `StudentID` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `StudentName` varchar(100) NOT NULL,
  `YearOfBirth` int(11) DEFAULT NULL CHECK (`YearOfBirth` between 1900 and 2025),
  `Gender` enum('M','F') DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL CHECK (`PhoneNumber` regexp '^[0-9]{10,15}$'),
  `Achievement` int(11) DEFAULT 0,
  `avatar_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `student`
--

INSERT INTO `student` (`StudentID`, `Email`, `StudentName`, `YearOfBirth`, `Gender`, `Password`, `PhoneNumber`, `Achievement`, `avatar_path`) VALUES
('', 'sung@edu.com', 'Hồ Thị Sung', NULL, '', 'sung321', '0321654987', 0, NULL),
('1', 'ducanh15@gmail.com', 'Phạm Đức Anh', 2004, 'M', 'ducanh15', '0943560104', 0, NULL),
('2', 'binh11@edu.com', 'Nguyễn Thị Bình', 2004, 'F', '123', '0123456789', 0, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `test`
--

CREATE TABLE `test` (
  `TestID` varchar(50) NOT NULL,
  `TestName` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `LessonID` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `testresult`
--

CREATE TABLE `testresult` (
  `ResultID` varchar(50) NOT NULL,
  `StudentID` varchar(50) DEFAULT NULL,
  `TestID` varchar(50) DEFAULT NULL,
  `Score` float DEFAULT NULL CHECK (`Score` between 0 and 100),
  `CompletionDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `PhoneNumber` (`PhoneNumber`);

--
-- Chỉ mục cho bảng `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`LessonID`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`NewsID`),
  ADD KEY `AdminID` (`AdminID`);

--
-- Chỉ mục cho bảng `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`StudentID`),
  ADD UNIQUE KEY `PhoneNumber` (`PhoneNumber`);

--
-- Chỉ mục cho bảng `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`TestID`),
  ADD KEY `LessonID` (`LessonID`);

--
-- Chỉ mục cho bảng `testresult`
--
ALTER TABLE `testresult`
  ADD PRIMARY KEY (`ResultID`),
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `TestID` (`TestID`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `test_ibfk_1` FOREIGN KEY (`LessonID`) REFERENCES `lesson` (`LessonID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `testresult`
--
ALTER TABLE `testresult`
  ADD CONSTRAINT `testresult_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`) ON DELETE CASCADE,
  ADD CONSTRAINT `testresult_ibfk_2` FOREIGN KEY (`TestID`) REFERENCES `test` (`TestID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
