<?php
require('../connect.php');
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['email'])) {
    header("Location: ../Login_out/login.php");
    exit();
}

// Lấy email từ session
$email = $_SESSION['email'];

// Truy vấn để lấy StudentName dựa trên email
$sql = "SELECT StudentName FROM `student` WHERE Email = '$email'";
$result = mysqli_query($conn, $sql);

// Kiểm tra kết quả truy vấn
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $student_name = $row['StudentName'];
} else {
    // Nếu không tìm thấy StudentName, có thể hiển thị thông báo lỗi hoặc đăng xuất
    $student_name = "Người dùng";
    echo "<p style='color:red; text-align:center;'>Không tìm thấy thông tin người dùng.</p>";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Học English - Trang chủ</title>
    <link rel="stylesheet" href="../Login_out/style.css">
</head>

<body>
    <div class="container">
        <h2>Chào mừng, <?php echo $student_name; ?>!</h2>
        <p>Chào mừng bạn đến với website học tiếng Anh!</p>
        <h3>Một số từ vựng cơ bản:</h3>
        <ul>
            <li><strong>Hello</strong>: Xin chào</li>
            <li><strong>Book</strong>: Sách</li>
            <li><strong>Learn</strong>: Học</li>
            <li><strong>School</strong>: Trường học</li>
        </ul>
        <a href="../Login_out/logout.php" class="login-button">Đăng xuất</a>
    </div>
</body>

</html>