<?php
session_start();
include('connect.php');

// Kiểm tra đăng nhập
if (!isset($_SESSION['email']) || !isset($_SESSION['role'])) {
    header('location: login.php');
    exit();
}

// Lấy LessonID từ URL
$lessonID = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Truy vấn dữ liệu từ bảng lesson
$sql = "SELECT * FROM lesson WHERE LessonID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $lessonID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Kiểm tra xem có bản ghi nào không
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $lesson_name = $row['lesson_name'];
    $description = $row['description'];
    $content = $row['content'];
    $duration = $row['duration'];
    $lesson_image = $row['lesson_image'];
} else {
    $lesson_name = "Không tìm thấy bài học";
    $description = "";
    $content = "Bài học không tồn tại hoặc đã bị xóa.";
    $duration = "";
    $lesson_image = "";
}

// Đóng kết nối
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($lesson_name); ?>Chi tiết bài học</title>
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
        max-width: 1000px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #333333;
        text-align: center;
        margin-bottom: 20px;
    }

    .lesson-info {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
    }

    .lesson-image {
        flex: 1;
        max-width: 400px;
    }

    .lesson-image img {
        width: 100%;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
    }

    .lesson-details {
        flex: 2;
        padding-left: 20px;
    }

    .description {
        color: #666;
        font-style: italic;
        font-size: 18px;
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .duration {
        color: #ff0048c3;
        font-weight: bold;
        font-size: 16px;
        margin-bottom: 20px;
    }

    .content {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        border-left: 4px solid #ff0048c3;
        white-space: pre-wrap;
        color: #333333;
        line-height: 1.8;
        font-size: 16px;
    }

    .btn-back {
        display: inline-block;
        margin-top: 30px;
        padding: 12px 25px;
        background-color: #ff0048c3;
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .btn-back:hover {
        background-color: #e60040;
    }

    .lesson-header {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f0f0f0;
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
        <!-- Lấy tiêu đề bài học -->
        <div class="lesson-header">
            <h1><?php echo htmlspecialchars($lesson_name); ?></h1>
        </div>

        <div class="lesson-info">
            <?php if (!empty($lesson_image)): ?>
            <div class="lesson-image">
                <img src="<?php echo htmlspecialchars($lesson_image); ?>"
                    alt="<?php echo htmlspecialchars($lesson_name); ?>">
            </div>
            <?php endif; ?>

            <div class="lesson-details">
                <p class="description"><?php echo htmlspecialchars($description); ?></p>

                <?php if (!empty($duration)): ?>
                <p class="duration">
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                    Thời lượng: <?php echo htmlspecialchars($duration); ?> phút
                </p>
                <?php endif; ?>
            </div>
        </div>

        <div class="content">
            <h3 style="color: #333; margin-bottom: 15px;">
                <i class="fa fa-book" aria-hidden="true"></i>
                Nội dung bài học:
            </h3>
            <div style="font-size: 16px; line-height: 1.8;">
                <?php echo nl2br(htmlspecialchars($content)); ?>
            </div>
        </div>

        <a href="trang_chu.php" class="btn-back">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
            Quay lại trang chủ
        </a>
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
</body>

</html>