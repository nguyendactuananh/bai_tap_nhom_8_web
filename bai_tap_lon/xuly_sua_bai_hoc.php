<?php
session_start();
include('connect.php');

// Kiểm tra đăng nhập và quyền admin
if (!isset($_SESSION['email']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lesson_id = intval($_POST['lesson_id']);
    $lesson_name = trim($_POST['lesson_name']);
    $description = trim($_POST['description']);
    $content = trim($_POST['content']);
    $duration_minutes = intval($_POST['duration']);

    // Chuyển đổi phút sang định dạng HH:MM:SS
    $hours = floor($duration_minutes / 60);
    $minutes = $duration_minutes % 60;
    $duration = sprintf("%02d:%02d:00", $hours, $minutes);

    // Lấy ảnh cũ
    $sql_old = "SELECT lesson_image FROM lesson WHERE LessonID = ?";
    $stmt_old = mysqli_prepare($conn, $sql_old);
    mysqli_stmt_bind_param($stmt_old, "i", $lesson_id);
    mysqli_stmt_execute($stmt_old);
    $result_old = mysqli_stmt_get_result($stmt_old);
    $old_image = "";

    if (mysqli_num_rows($result_old) > 0) {
        $row_old = mysqli_fetch_assoc($result_old);
        $old_image = $row_old['lesson_image'];
    }
    mysqli_stmt_close($stmt_old);

    $lesson_image = $old_image;

    // Xử lý ảnh mới
    if (isset($_FILES['lesson_image']) && $_FILES['lesson_image']['error'] == 0) {
        $upload_dir = "img/lessons/";
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $file_name = $_FILES['lesson_image']['name'];
        $file_tmp = $_FILES['lesson_image']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (in_array($file_ext, $allowed_types)) {
            $new_file_name = "lesson_" . time() . "." . $file_ext;
            $upload_path = $upload_dir . $new_file_name;
            if (move_uploaded_file($file_tmp, $upload_path)) {
                $lesson_image = $upload_path;
                if (!empty($old_image) && file_exists($old_image)) {
                    unlink($old_image);
                }
            } else {
                echo "<div style='text-align: center; margin-top: 50px;'>";
                echo "<p style='color: red; font-size: 18px;'>Lỗi khi tải ảnh lên!</p>";
                echo "<a href='sua_bai_hoc.php?id=$lesson_id'>← Quay lại</a>";
                echo "</div>";
                exit();
            }
        } else {
            echo "<div style='text-align: center; margin-top: 50px;'>";
            echo "<p style='color: red; font-size: 18px;'>Chỉ chấp nhận file ảnh (jpg, jpeg, png, gif)!</p>";
            echo "<a href='sua_bai_hoc.php?id=$lesson_id'>← Quay lại</a>";
            echo "</div>";
            exit();
        }
    }

    // Cập nhật bài học
    $sql = "UPDATE lesson SET lesson_name = ?, description = ?, content = ?, duration = ?, lesson_image = ? WHERE LessonID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssi", $lesson_name, $description, $content, $duration, $lesson_image, $lesson_id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = 'Cập nhật bài học thành công!';
        header("Location: trang_chu.php");
        exit();
    } else {
        $_SESSION['error'] = 'Lỗi khi cập nhật: ' . mysqli_error($conn);
        header("Location: sua_bai_hoc.php?id=$lesson_id");
        exit();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header('Location: trang_chu.php');
    exit();
}
?>
