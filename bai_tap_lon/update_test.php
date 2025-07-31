<?php
session_start();
include('connect.php');

// Kiểm tra quyền admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: trang_chu.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $testID = intval($_POST['testID']);
    $test_name = trim($_POST['test_name']);
    $description = trim($_POST['description']);
    $content = trim($_POST['content']);

    // Kiểm tra các trường bắt buộc
    if (empty($test_name) || empty($description) || empty($content)) {
        $_SESSION['error'] = 'Vui lòng điền đầy đủ tên bài kiểm tra, mô tả và nội dung.';
        header("Location: edit_test.php?id=$testID");
        exit();
    }

    // Kiểm tra độ dài tối đa
    if (strlen($test_name) > 255 || strlen($description) > 255) {
        $_SESSION['error'] = 'Tên bài kiểm tra hoặc mô tả quá dài.';
        header("Location: edit_test.php?id=$testID");
        exit();
    }

    // Cập nhật bài kiểm tra
    $sql = "UPDATE test SET test_name = ?, description = ?, content = ? WHERE TestID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $test_name, $description, $content, $testID);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = 'Cập nhật bài kiểm tra thành công!';
        header("Location: trang_chu.php");
        exit();
    } else {
        $_SESSION['error'] = 'Lỗi khi cập nhật: ' . mysqli_error($conn);
        header("Location: edit_test.php?id=$testID");
        exit();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header('Location: trang_chu.php');
    exit();
}
?>