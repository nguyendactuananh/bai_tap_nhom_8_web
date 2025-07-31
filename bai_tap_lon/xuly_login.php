<?php
session_start();
require('connect.php');

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Truy vấn kiểm tra thông tin người dùng
    $sql = "SELECT email, password, role FROM user WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Kiểm tra mật khẩu
        if ($password === $row['password']) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role']; // Lưu role vào session
            header('location: trang_chu.php');
            exit();
        } else {
            echo "<p style='color:red; text-align:center;'>Tên đăng nhập hoặc mật khẩu không chính xác</p>";
            echo "<p style='text-align:center;'><a href='login.php'>Quay lại đăng nhập</a></p>";
        }
    } else {
        echo "<p style='color:red; text-align:center;'>Tên đăng nhập hoặc mật khẩu không chính xác</p>";
        echo "<p style='text-align:center;'><a href='login.php'>Quay lại đăng nhập</a></p>";
    }
} else {
    echo "<p style='color:red; text-align:center;'>Vui lòng nhập đầy đủ thông tin</p>";
    echo "<p style='text-align:center;'><a href='login.php'>Quay lại đăng nhập</a></p>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>