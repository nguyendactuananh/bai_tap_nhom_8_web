<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng kí tài khoản</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Đăng ký tài khoản</h2>
        <form action="xuly_register.php" method="post">
            <div class="input-group">
                <label for="register-name">Họ và tên</label>
                <input type="text" name="register-name" id="register-name" required placeholder="Nhập đầy đủ họ tên">
            </div>
            <div class="input-group">
                <label for="register-email">Email</label>
                <input type="email" name="register-email" id="register-email" required placeholder="ducanhdz@gmail.com">
            </div>
            <div class="input-group">
                <label for="register-sdt">Số điện thoại</label>
                <input type="tel" name="register-sdt" required placeholder="Nhập số điện thoại">
            </div>
            <div class="input-group">
                <label for="gender">Giới tính</label>
                <div class="gender"
                    style=" display:flex; margin:10px; margin-left:40px; justify-content:space-center;gap:40px;">
                    Nam<input type="radio" name="gender" value="1">
                    Nữ <input type="radio" name="gender" value="0">
                </div>
            </div>
            <div class="input-group">
                <label for="Birth">Ngày Tháng Năm sinh</label>
                <input type="date" name="birth" required placeholder="Nhập mật khẩu">
            </div>
            <div class="input-group">
                <label for="register-password">Mật khẩu</label>
                <input type="password" name="register-password" id="register-password" required
                    placeholder="Nhập mật khẩu">
            </div>
            <div class="input-group">
                <label for="register-confirm-password">Xác nhận Mật khẩu</label>
                <input type="password" name="register-confirm-password" id="register-confirm-password" required
                    placeholder="Xác nhận mật khẩu">
            </div>
            <button type="submit" class="login-button">Tạo tài khoản</button>
        </form>
        <p class="login-link">Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
    </div>
</body>

</html>