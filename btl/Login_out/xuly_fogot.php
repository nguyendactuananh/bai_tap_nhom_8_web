<?php
require('../connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['forgot-email'];
    $password = $_POST['forgot-password'];
    $confirm_password = $_POST['forgot-confirm-password'];

    // Kiểm tra mật khẩu trùng khớp
    if ($password !== $confirm_password) {
        echo "<p class='fail' style='color:red; text-align:center;'>Mật khẩu xác nhận không khớp</p>";
        echo "<p style='text-align:center;'><a href='forgot_pass.php'>Quay lại</a></p>";
    } else {
        // Kiểm tra email tồn tại
        $sql = "SELECT * FROM `student` WHERE Email = '$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Cập nhật mật khẩu
            $sql = "UPDATE `student` SET Password = '$confirm_password' WHERE Email = '$email'";
            if (mysqli_query($conn, $sql)) {
                session_start();
                $_SESSION["Password"] = $confirm_password;
                echo "thành công rồi bây";
                
            } else {
                echo "<p class='fail' style='color:red; text-align:center;'>Đặt lại mật khẩu thất bại: " . mysqli_error($conn) . "</p>";
                echo "<p style='text-align:center;'><a href='forgot_pass.php'>Quay lại</a></p>";
                
            }
        } else {
            echo "<p class='fail' style='color:red; text-align:center;'>Email không tồn tại</p>";
            echo "<p style='text-align:center;'><a href='forgot_pass.php'>Quay lại</a></p>";
        }
    }
}

?>