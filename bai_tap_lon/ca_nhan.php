
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <link rel="stylesheet" type="text/css" href="trang_chu.css" />
    <style>
        body {
        font-family: Arial, sans-serif;
        background-color:#b2eaff;
        }
        nav {
            background-color: #f2f2f2;
            padding: 12px;
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-left: -7px;
            margin-top: -8px;
            margin-bottom: -8px;
        }

        nav a {
            margin: 0 12px;
            text-decoration: none;
            color: #333;
        }
        a {
            margin: 0 12px;
            text-decoration: none;
            color: #333;
        }
        a:hover{
            background: linear-gradient(135deg, #00c3ff, #ffff1c);
            border-radius: 5px;
            padding: 5px;
        }
        .div_nav{
            margin: 0 12px;
            text-decoration: none;
            color: #333;
            display: flex;
            align-items: center;
        }
        .div_nav:hover{
            background: linear-gradient(135deg, #00c3ff, #ffff1c);
            border-radius: 5px;
            padding: 5px;
        }
        .container_nav{
            display: flex;
            align-items: center;
            padding-right: 20px;
        }
        .input_search{
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
            margin-right: 10px;
            width: 200px;
            height: 100%;
        }
            table {
            border: 1px solid black;
            width: 100%;
            }

        th,td {
            border: 1px solid #ddd;
            padding: 8px;

        }

        th {
            background-color: #f8d4eeff;
            text-align: left;
        }
    </style>
</head>
<body>
    <nav>
        <p style="font-weight: bold; color:rgba(255, 166, 0, 0.977);">Nhóm 8</p>
        <div class="container_nav">
            <input class="input_search" type="text" placeholder="Dịch tiếng anh">

            <div class="div_nav">
                <i class="fa fa-home" aria-hidden="true"></i>
                <a href="trang_chu.php">Trang chủ</a>
            </div>
            <div class="div_nav">
                <i class="fa fa-book" aria-hidden="true"></i>
                <a href="bai_hoc.php">Bài học</a>
            </div>
            <div class="div_nav">
                <i class="fa fa-user" aria-hidden="true"></i>
                <a href="ca_nhan.php">Cá nhân</a>
            </div>
            <div class="div_nav dropdown">
                <i class="fa fa-wrench" aria-hidden="true"></i>
                <a href="#" class="dropdown-toggle">Cài đặt</a>
                <div class="dropdown-menu">
                    <a href="#" class="theme-option" data-theme="toggle">Đổi chế độ</a>
                    <a href="trang_gioi_thieu.php">Đăng xuất</a>
                </div>
            </div>
        </div>
    </nav>
    <caption>
        <h1 style="text-align: center;">Thông tin cá nhân</h1>
    </caption>

    <table class="table">
        <tr style="text-align: center; background-color: pink;">
            <th>email</th>
            <th>Họ và tên</th>
            <th>Số điện thoại</th>
            <th>Giới tính</th>
            <th>Năm sinh</th>
            <th>Mật khẩu</th>
            <th>Ảnh đại diện</th>
        </tr>
        <?php
            session_start();
            include('connect.php');

            // Kiểm tra người dùng đã đăng nhập chưa
            if (!isset($_SESSION['email'])) {
                header("Location: login.php"); // Nếu chưa, chuyển hướng về trang đăng nhập
                exit();
            }

            $user_email = $_SESSION['email'];
            $sql = "SELECT * FROM `user` WHERE email = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $user_email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['full_name']; ?></td>
                <td><?php echo $row['phone_number']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td><?php echo $row['birth_year']; ?></td>
                <td><?php echo $row['password']; ?></td>
                <td><img src="<?php echo $row['user_image']; ?>" alt="Ảnh đại diện" width="50"></td>
            </tr>
        <?php
            }
        ?>
    </table>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Khởi tạo chế độ từ localStorage
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.body.classList.add(savedTheme + '-mode');

        // Xử lý sự kiện đổi chế độ
        const themeOption = document.querySelector('.theme-option');
        themeOption.addEventListener('click', function(e) {
            e.preventDefault();
            const currentTheme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';

            document.body.classList.remove('light-mode', 'dark-mode');
            document.body.classList.add(newTheme + '-mode');
            localStorage.setItem('theme', newTheme);
        });
    });
    </script>
</body>
</html>
