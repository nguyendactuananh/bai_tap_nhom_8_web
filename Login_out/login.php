<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập - Học English</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <!-- Form Đăng nhập -->
        <h2>Đăng nhập</h2>
        <form action="xuly_login.php" method="post">
            <div class="input-group">
                <label for="login-email">Email</label>
                <input type="email" name="email" id="login-email" required placeholder="ducanhdz@gmail.com">
            </div>
            <div class="input-group">
                <label for="password">Mật khẩu</label>
                <input type="password" name="password" id="password" required placeholder="Nhập mật khẩu">
            </div>
            <button type="submit" class="login-button">Đăng nhập</button>
        </form>
        <p class="login-link"><a href="forgot_pass.php">Quên mật khẩu</a></p>
        <p class="login-link">Bạn chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
    </div>
</body>

</html>