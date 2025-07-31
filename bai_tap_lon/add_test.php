<?php
session_start();
include('connect.php');

// Kiểm tra đăng nhập và quyền admin
if (!isset($_SESSION['email']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm bài kiểm tra</title>
    <link rel="stylesheet" type="text/css" href="trang_chu.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #b2eaff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            background-color: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .form-group textarea {
            resize: vertical;
            height: 150px;
        }

        .form-actions {
            text-align: center;
            margin-top: 30px;
        }

        .btn-submit {
            background-color: #ff0048c3;
            color: #fff;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #e60040;
        }

        .btn-back {
            margin-left: 10px;
            background-color: #6c757d;
            color: #fff;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Thêm bài kiểm tra</h1>

        <form action="add_test_inside.php" method="POST">
            <div class="form-group">
                <label for="test_name">Tên bài kiểm tra:</label>
                <input type="text" name="test_name" id="test_name" required placeholder="Nhập tên bài kiểm tra">
            </div>

            <div class="form-group">
                <label for="description">Mô tả ngắn:</label>
                <input type="text" name="description" id="description" required placeholder="Nhập mô tả ngắn">
            </div>

            <div class="form-group">
                <label for="content">Nội dung chi tiết:</label>
                <textarea name="content" id="content" required placeholder="Nhập nội dung chi tiết của bài kiểm tra"></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Thêm bài kiểm tra</button>
                <a href="trang_chu.php" class="btn-back">Quay lại</a>
            </div>
        </form>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Khởi tạo chế độ từ localStorage
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.body.classList.add(savedTheme + '-mode');

        // Xử lý sự kiện đổi chế độ
        const themeOption = document.querySelector('.theme-option');
        themeOption.addEventListener('click', function(e) {
            e.preventDefault();
            const currentTheme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';

            document.body.classList.remove('light-mode', 'dark-mode');
            document.body.classList.add(newTheme + '-mode');
            localStorage.setItem('theme', newTheme);
        });
    });
    </script>
</body>
</html>
