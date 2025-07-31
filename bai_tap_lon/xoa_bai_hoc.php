<?php
session_start();
include('connect.php');

// Kiểm tra đăng nhập và quyền admin
if (!isset($_SESSION['email']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('location: login.php');
    exit();
}

// Lấy LessonID từ URL
$lesson_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($lesson_id == 0) {
    header('location: trang_chu.php');
    exit();
}

// Lấy thông tin bài học để lấy tên và ảnh
$sql_old = "SELECT lesson_image, lesson_name FROM lesson WHERE LessonID = ?";
$stmt_old = mysqli_prepare($conn, $sql_old);
mysqli_stmt_bind_param($stmt_old, "i", $lesson_id);
mysqli_stmt_execute($stmt_old);
$result_old = mysqli_stmt_get_result($stmt_old);
$lesson_name = "";
$lesson_image = "";

if (mysqli_num_rows($result_old) > 0) {
    $row_old = mysqli_fetch_assoc($result_old);
    $lesson_name = $row_old['lesson_name'];
    $lesson_image = $row_old['lesson_image'];
}
mysqli_stmt_close($stmt_old);

// Xóa bài học khỏi cơ sở dữ liệu
$sql = "DELETE FROM lesson WHERE LessonID = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $lesson_id);

    if (mysqli_stmt_execute($stmt)) {
        // Xóa ảnh liên quan nếu tồn tại
        if (!empty($lesson_image) && file_exists($lesson_image)) {
            unlink($lesson_image);
        }

        echo "<!DOCTYPE html>";
        echo "<html lang='vi'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Xóa thành công</title>";
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
        echo "<h1 class='success-title'>Xóa bài học thành công!</h1>";
        echo "<p class='success-message'>Bài học <strong>" . htmlspecialchars($lesson_name) . "</strong> đã được xóa khỏi hệ thống.</p>";
        echo "<a href='trang_chu.php' class='btn-home'><i class='fa fa-home' aria-hidden='true'></i> Về trang chủ</a>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
    } else {
        echo "<div style='text-align: center; margin-top: 50px;'>";
        echo "<p style='color: red; font-size: 18px;'>Lỗi khi xóa bài học: " . mysqli_error($conn) . "</p>";
        echo "<a href='trang_chu.php' style='color: #ff0048c3; text-decoration: none;'>← Quay lại</a>";
        echo "</div>";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "<div style='text-align: center; margin-top: 50px;'>";
    echo "<p style='color: red; font-size: 18px;'>Lỗi khi chuẩn bị câu truy vấn!</p>";
    echo "<a href='trang_chu.php' style='color: #ff0048c3; text-decoration: none;'>← Quay lại</a>";
    echo "</div>";
}

mysqli_close($conn);
?>