<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link rel="stylesheet" href="style.css">
</head>


<body>
    <!-- Form Quên mật khẩu -->
    <div class="container">
        <h2>Quên mật khẩu</h2>
        <form action="xuly_forgot.php" method="post">
            <div class="input-group">
                <label for="forgot-email">Email</label>
                <input type="email" name="forgot-email" id="forgot-email" required placeholder="ducanhdz@gmail.com">
            </div>
            <div class="input-group">
                <label for="forgot-password">Mật khẩu mới</label>
                <input type="password" name="forgot-password" id="forgot-password" required
                    placeholder="Nhập mật khẩu mới">
            </div>
            <div class="input-group">
                <label for="forgot-confirm-password">Xác nhận Mật khẩu</label>
                <input type="password" name="forgot-confirm-password" id="forgot-confirm-password" required
                    placeholder="Xác nhận mật khẩu">
            </div>
            <button type="submit" class="login-button">Xác nhận</button>
        </form>
        <p class="login-link">Bạn chưa có tài khoản?<a href="register.php"> Đăng ký ngay</a></p>
    </div>

</body>

</html>