<?php
session_start();
include('connect.php');

// Kiểm tra đăng nhập và quyền admin
if (!isset($_SESSION['email']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lesson_name = trim($_POST['lesson_name']);
    $description = trim($_POST['description']);
    $content = trim($_POST['content']);
    $duration = intval($_POST['duration']);

    // Xử lý upload ảnh
    $upload_dir = "img/lessons/";
    $lesson_image = "";

    // Tạo thư mục nếu chưa tồn tại
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (isset($_FILES['lesson_image']) && $_FILES['lesson_image']['error'] == 0) {
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['lesson_image']['name'];
        $file_tmp = $_FILES['lesson_image']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (in_array($file_ext, $allowed_types)) {
            // Tạo tên file unique
            $new_file_name = "lesson_" . time() . "." . $file_ext;
            $upload_path = $upload_dir . $new_file_name;

            if (move_uploaded_file($file_tmp, $upload_path)) {
                $lesson_image = $upload_path;
            } else {
                echo "<div style='text-align: center; margin-top: 50px;'>";
                echo "<p style='color: red; font-size: 18px;'>Lỗi khi upload ảnh!</p>";
                echo "<a href='them_bai_hoc.php' style='color: #ff0048c3; text-decoration: none;'>← Quay lại</a>";
                echo "</div>";
                exit();
            }
        } else {
            echo "<div style='text-align: center; margin-top: 50px;'>";
            echo "<p style='color: red; font-size: 18px;'>Chỉ chấp nhận file ảnh (jpg, jpeg, png, gif)!</p>";
            echo "<a href='them_bai_hoc.php' style='color: #ff0048c3; text-decoration: none;'>← Quay lại</a>";
            echo "</div>";
            exit();
        }
    }

    // Thêm bài học vào database
    $sql = "INSERT INTO lesson (lesson_name, description, content, duration, lesson_image) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssis", $lesson_name, $description, $content, $duration, $lesson_image);

        if (mysqli_stmt_execute($stmt)) {
            echo "<!DOCTYPE html>";
            echo "<html lang='vi'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>Thành công</title>";
            echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>";
            echo "<style>";
            echo "body { font-family: Arial, sans-serif; background-color: #b2eaff; margin: 0; padding: 50px; }";
            echo ".success-container { max-width: 600px; margin: 0 auto; background: white; padding: 40px; border-radius: 15px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }";
            echo ".success-icon { color: #28a745; font-size: 60px; margin-bottom: 20px; }";
            echo ".success-title { color: #333; font-size: 24px; margin-bottom: 15px; }";
            echo ".success-message { color: #666; font-size: 16px; margin-bottom: 30px; }";
            echo ".btn-home { background-color: #ff0048c3; color: white; padding: 12px 30px; text-decoration: none; border-radius: 8px; font-weight: bold; display: inline-block; transition: background-color 0.3s ease; }";
            echo ".btn-home:hover { background-color: #e60040; }";
            echo "</style>";
            echo "</head>";
            echo "<body>";
            echo "<div class='success-container'>";
            echo "<div class='success-icon'><i class='fa fa-check-circle' aria-hidden='true'></i></div>";
            echo "<h1 class='success-title'>Thêm bài học thành công!</h1>";
            echo "<p class='success-message'>Bài học <strong>" . htmlspecialchars($lesson_name) . "</strong> đã được thêm vào hệ thống.</p>";
            echo "<a href='trang_chu.php' class='btn-home'><i class='fa fa-home' aria-hidden='true'></i> Về trang chủ</a>";
            echo "</div>";
            echo "</body>";
            echo "</html>";
        } else {
            echo "<div style='text-align: center; margin-top: 50px;'>";
            echo "<p style='color: red; font-size: 18px;'>Lỗi khi thêm bài học: " . mysqli_error($conn) . "</p>";
            echo "<a href='them_bai_hoc.php' style='color: #ff0048c3; text-decoration: none;'>← Quay lại</a>";
            echo "</div>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<div style='text-align: center; margin-top: 50px;'>";
        echo "<p style='color: red; font-size: 18px;'>Lỗi khi chuẩn bị câu truy vấn!</p>";
        echo "<a href='them_bai_hoc.php' style='color: #ff0048c3; text-decoration: none;'>← Quay lại</a>";
        echo "</div>";
    }
} else {
    header('location: them_bai_hoc.php');
    exit();
}

mysqli_close($conn);
?>