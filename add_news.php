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
    <title>Thêm tin tức mới</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="trang_chu.css" />
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #b2eaff;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #333333;
        text-align: center;
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: bold;
        font-size: 16px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
        box-sizing: border-box;
        transition: border-color 0.3s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #ff0048c3;
        outline: none;
    }

    .form-group textarea {
        height: 150px;
        resize: vertical;
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
        transition: background-color 0.3s ease;
        margin-right: 10px;
    }

    .btn-submit:hover {
        background-color: #e60040;
    }

    .btn-back {
        background-color: #6c757d;
        color: #fff;
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.3s ease;
    }

    .btn-back:hover {
        background-color: #5a6268;
    }

    .form-actions {
        text-align: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }
    </style>
</head>

<body>
    <!-- Header -->
    <nav>
        <p style="font-weight: bold; color:rgba(255, 166, 0, 0.977);">Nhóm 8</p>
        <div class="container_nav">
            <div class="div_nav">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                <a href="trang_chu.php?page_layout=dang_xuat">Đăng xuất</a>
            </div>
            <div class="div_nav">
                <i class="fa fa-home" aria-hidden="true"></i>
                <a href="trang_chu.php">Trang chủ</a>
            </div>
            <div class="div_nav">
                <i class="fa fa-user" aria-hidden="true"></i>
                <a href="trang_chu.php?page_layout=ca_nhan">Cá nhân</a>
            </div>
            <div class="div_nav">
                <i class="fa fa-wrench" aria-hidden="true"></i>
                <a href="trang_chu.php?page_layout=cai_dat">Cài đặt</a>
            </div>
            <input class="input_search" type="text" placeholder="Dịch tiếng anh">
        </div>
    </nav>

    <!-- Main -->
    <div class="container">
        <h1>
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
            Thêm tin tức mới
        </h1>

        <form action="add_news_inside.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    Tên tiêu đề
                </label>
                <input type="text" id="title" name="title" required placeholder="Nhập tên tin tức">
            </div>

            <div class="form-group">
                <label for="subtitle">
                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                    Tên tiêu đề phụ
                </label>
                <input type="text" name="subtitle" id="subtitle" required placeholder="Nhập mô tả ngắn về tin tức">
            </div>

            <div class="form-group">
                <label for="content">
                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                    Nội dung tin tức
                </label>
                <textarea id="content" name="content" required placeholder="Nhập nội dung chi tiết của tin tức"
                    style="height: 200px;"></textarea>
            </div>
            <div class="form-group">
                <label for="author">
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                    Tác giả:
                </label>
                <input type="text" id="author" name="author" required placeholder="Nhập tên tác giả">
            </div>

            <div class="form-group">
                <label for="image">
                    <i class="fa fa-image" aria-hidden="true"></i>
                    Hình ảnh tin tức
                </label>
                <input type="file" id="image" name="image" accept="image/*">
                <small style="color: #666; font-size: 14px;">Chỉ chấp nhận file ảnh (jpg, png, gif)</small>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fa fa-save" aria-hidden="true"></i>
                    Thêm tin tức
                </button>
                <a href="trang_chu.php" class="btn-back">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    Quay lại
                </a>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <hr>
    <nav>
        <p style="font-weight: bold; color:rgba(255, 166, 0, 0.977);">Nhóm 8</p>
        <div class="container_nav">
            <div class="div_nav">
                <i class="fa fa-facebook-official" aria-hidden="true"></i>
                <a href="">Facebook</a>
            </div>
            <div class="div_nav">
                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                <a href="">Youtube</a>
            </div>
            <div class="div_nav">
                <i class="fa fa-instagram" aria-hidden="true"></i>
                <a href="">Instagram</a>
            </div>
            <div class="div_nav">
                <i class="fa fa-twitter" aria-hidden="true"></i>
                <a href="">Twitter</a>
            </div>
            <div>
                <p>Thành viên:</p>
                <ul>
                    <li>Nguyễn Đắc Tuấn Anh</li>
                    <li>Phạm Đức Anh</li>
                </ul>
            </div>
        </div>
    </nav>
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