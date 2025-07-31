<?php
session_start();
include('connect.php');

// Kiểm tra đăng nhập và quyền admin
if (!isset($_SESSION['email']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('location: login.php');
    exit();
}

// Lấy LessonID từ URL
$lessonID = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($lessonID == 0) {
    header('location: trang_chu.php');
    exit();
}

// Truy vấn dữ liệu bài học
$sql = "SELECT * FROM lesson WHERE LessonID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $lessonID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    header('location: trang_chu.php');
    exit();
}

$row = mysqli_fetch_assoc($result);
$lesson_name = $row['lesson_name'];
$description = $row['description'];
$content = $row['content'];
$duration = $row['duration'];
$lesson_image = $row['lesson_image'];

mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa bài học<?php echo htmlspecialchars($lesson_name); ?></title>
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

    .current-image {
        margin-top: 10px;
        text-align: center;
    }

    .current-image img {
        max-width: 200px;
        max-height: 150px;
        border-radius: 8px;
        border: 2px solid #ddd;
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
            <i class="fa fa-edit" aria-hidden="true"></i>
            Sửa bài học: <?php echo htmlspecialchars($lesson_name); ?>
        </h1>

        <form action="xuly_sua_bai_hoc.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="lesson_id" value="<?php echo $lessonID; ?>">

            <div class="form-group">
                <label for="lesson_name">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    Tên bài học
                </label>
                <input type="text" id="lesson_name" name="lesson_name" required
                    value="<?php echo htmlspecialchars($lesson_name); ?>">
            </div>

            <div class="form-group">
                <label for="description">
                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                    Mô tả bài học
                </label>
                <textarea id="description" name="description"
                    required><?php echo htmlspecialchars($description); ?></textarea>
            </div>

            <div class="form-group">
                <label for="content">
                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                    Nội dung bài học
                </label>
                <textarea id="content" name="content" required
                    style="height: 200px;"><?php echo htmlspecialchars($content); ?></textarea>
            </div>

            <div class="form-group">
                <label for="duration">
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                    Thời lượng (phút)
                </label>
                <input type="number" id="duration" name="duration" required min="1" value="<?php echo $duration; ?>">
            </div>

            <div class="form-group">
                <label for="lesson_image">
                    <i class="fa fa-image" aria-hidden="true"></i>
                    Hình ảnh bài học
                </label>
                <input type="file" id="lesson_image" name="lesson_image" accept="image/*">
                <small style="color: #666; font-size: 14px;">Để trống nếu không muốn thay đổi ảnh</small>

                <?php if (!empty($lesson_image)): ?>
                <div class="current-image">
                    <p style="color: #666; font-size: 14px; margin: 10px 0 5px 0;">Ảnh hiện tại:</p>
                    <img src="<?php echo htmlspecialchars($lesson_image); ?>" alt="Ảnh bài học hiện tại">
                </div>
                <?php endif; ?>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fa fa-save" aria-hidden="true"></i>
                    Cập nhật bài học
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
</body>

</html>