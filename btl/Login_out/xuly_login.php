<?php
require('../connect.php');
session_start();

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Truy vấn kiểm tra thông tin người dùng
    $sql = "SELECT * FROM `student` WHERE Email = '$email' AND Password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION["email"] = $email;
        header('location:../Home/trang_chu.php');
        exit();
    } else {
        echo "<p class='fail' style='color:red; text-align:center;'>Tên đăng nhập hoặc mật khẩu không chính xác</p>";
        echo "<p style='text-align:center;'><a href='login.php'>Quay lại đăng nhập</a></p>";
    }
} else {
    echo "<p class='fail' style='color:red; text-align:center;'>Vui lòng nhập đầy đủ thông tin</p>";
    echo "<p style='text-align:center;'><a href='login.php'>Quay lại đăng nhập</a></p>";
}
mysqli_close($conn);
?>