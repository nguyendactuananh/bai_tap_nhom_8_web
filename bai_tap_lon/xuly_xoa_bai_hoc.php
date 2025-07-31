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

// Lấy tên và ảnh để xóa ảnh nếu có
$sql_old = "SELECT lesson_image FROM lesson WHERE LessonID = ?";
$stmt_old = mysqli_prepare($conn, $sql_old);
mysqli_stmt_bind_param($stmt_old, "i", $lesson_id);
mysqli_stmt_execute($stmt_old);
$result_old = mysqli_stmt_get_result($stmt_old);
$lesson_image = "";

if ($row_old = mysqli_fetch_assoc($result_old)) {
    $lesson_image = $row_old['lesson_image'];
}
mysqli_stmt_close($stmt_old);

// Xóa bản ghi bài học
$sql = "DELETE FROM lesson WHERE LessonID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $lesson_id);

if (mysqli_stmt_execute($stmt)) {
    // Xóa ảnh nếu tồn tại
    if (!empty($lesson_image) && file_exists($lesson_image)) {
        @unlink($lesson_image);
    }

    $_SESSION['success'] = 'Xóa bài học thành công!';
    header("Location: trang_chu.php");
    exit();
} else {
    $_SESSION['error'] = 'Lỗi khi xóa bài học: ' . mysqli_error($conn);
    header("Location: trang_chu.php");
    exit();
}
?>
