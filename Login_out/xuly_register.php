<?php
require('../connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['register-name'];
    $email = $_POST['register-email'];
    $phone = $_POST['register-sdt'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
    $password = $_POST['register-password'];
    $confirm_password = $_POST['register-confirm-password'];

    // Kiểm tra mật khẩu trùng khớp
    if ($password !== $confirm_password) {
        echo "<p class='fail' style='color:red; text-align:center;'>Mật khẩu xác nhận không khớp</p>";
    } else {
        // Kiểm tra email đã tồn tại
        $sql = "SELECT * FROM `student` WHERE Email = '$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<p class='fail' style='color:red; text-align:center;'>Email đã được sử dụng</p>";
        } else {
            // Tạo StudentID
            $student_id = 'ST' . time();
            // Lưu thông tin vào database
            $sql = "INSERT INTO `student` ( Email, StudentName, Gender, Password, PhoneNumber) VALUES ( '$email', '$name', '$gender', '$password', '$phone')";
            if (mysqli_query($conn, $sql)) {
                session_start();
                $_SESSION["email"] = $email;
                header('location:../Home/trang_chu.php');
                exit();
            } else {
                echo "<p class='fail' style='color:red; text-align:center;'>Đăng ký thất bại. Vui lòng thử lại.</p>";
            }
        }
    }
    mysqli_close($conn);
}
?>