<?php
session_start();
include('connect.php');

// Lấy TestID từ URL
$TestID = isset($_GET['id']) ? ($_GET['id']) : 0;

if ($TestID == 0) {
    header('Location: trang_chu.php');
    exit();
}

// Truy vấn dữ liệu bài kiểm tra
$sql = "SELECT * FROM test WHERE TestID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $TestID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    header('Location: trang_chu.php');
    exit();
}

$row = mysqli_fetch_assoc($result);
$testID = $row['TestID'];
$test_name = htmlspecialchars($row['test_name']);
$description = htmlspecialchars($row['description']);
$content = htmlspecialchars($row['content']);

mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa bài kiểm tra - <?php echo $test_name; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="trang_chu.css" />
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
        .error {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <nav>
        <p style="font-weight: bold; color:rgba(255, 166, 0, 0.977);">Nhóm 8</p>
        <div class="container_nav">
            <input class="input_search" type="text" placeholder="Dịch tiếng anh">

            <div class="div_nav">
                <i class="fa fa-home" aria-hidden="true"></i>
                <a href="trang_chu.php">Trang chủ</a>
            </div>
            <div class="div_nav">
                <i class="fa fa-book" aria-hidden="true"></i>
                <a href="bai_hoc.php">Bài học</a>
            </div>
            <div class="div_nav">
                <i class="fa fa-user" aria-hidden="true"></i>
                <a href="ca_nhan.php">Cá nhân</a>
            </div>
            <div class="div_nav dropdown">
                <i class="fa fa-wrench" aria-hidden="true"></i>
                <a href="#" class="dropdown-toggle">Cài đặt</a>
                <div class="dropdown-menu">
                    <a href="#" class="theme-option" data-theme="toggle">Đổi chế độ</a>
                    <a href="trang_gioi_thieu.php">Đăng xuất</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Main -->
    <div class="container">
        <h1>
            <i class="fa fa-edit" aria-hidden="true"></i>
            Sửa bài kiểm tra: <?php echo $test_name; ?>
        </h1>

        <?php
        // Hiển thị thông báo lỗi nếu có
        if (isset($_SESSION['error'])) {
            echo '<p class="error">' . htmlspecialchars($_SESSION['error']) . '</p>';
            unset($_SESSION['error']);
        }
        ?>

        <form action="update_test.php" method="POST">
            <input type="hidden" name="testID" value="<?php echo $testID; ?>">
            <div class="form-group">
                <label for="test_name">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    Tên bài kiểm tra
                </label>
                <input type="text" id="test_name" name="test_name" required value="<?php echo $test_name; ?>">
            </div>
            <div class="form-group">
                <label for="description">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    Mô tả
                </label>
                <input type="text" id="description" name="description" required value="<?php echo $description; ?>">
            </div>
            <div class="form-group">
                <label for="content">
                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                    Nội dung bài kiểm tra
                </label>
                <textarea id="content" name="content" required style="height: 200px;"><?php echo $content; ?></textarea>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fa fa-save" aria-hidden="true"></i>
                    Cập nhật bài kiểm tra
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