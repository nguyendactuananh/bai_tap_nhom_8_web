<?php
session_start();
include('connect.php');

// Kiểm tra đăng nhập và quyền admin
if (!isset($_SESSION['email']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('location: login.php');
    exit();
}

// Kiểm tra dữ liệu từ form
if (
    !empty($_POST['test_name']) &&
    !empty($_POST['description']) &&
    !empty($_POST['content'])
) {
    $test_name = ($_POST['test_name']);
    $description = ($_POST['description']);
    $content = ($_POST['content']);

    // Thêm bài kiểm tra vào CSDL
    $stmt = mysqli_prepare($conn, "INSERT INTO test (test_name, description, content) VALUES (?, ?, ?)");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $test_name, $description, $content);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header('Location: trang_chu.php');
        exit();
    } else {
        echo "Lỗi truy vấn: " . mysqli_error($conn);
    }
} else {
    echo "Vui lòng điền đầy đủ thông tin cho bài kiểm tra.";
}
?>
