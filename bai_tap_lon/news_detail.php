<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root"; // Thay bằng username MySQL của bạn
$password = ""; // Thay bằng password MySQL của bạn
$dbname = "bai_tap_lon";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Lấy NewsID từ URL
$NewsID = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Truy vấn dữ liệu từ bảng news
$sql = "SELECT title, subtitle, content, author, image FROM news WHERE NewsID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $NewsID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Kiểm tra xem có bản ghi nào không
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $title = $row['title'];
    $subtitle = $row['subtitle'];
    $content = $row['content'];
    $author = $row['author'];
    $image = $row['image'];
} else {
    $title = "Không tìm thấy bài báo";
    $subtitle = "";
    $content = "Bài báo không tồn tại hoặc đã bị xóa.";
    $author = "";
    $image = "";
}

// Đóng kết nối
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="trang_chu.css" />
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color:#b2eaff;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
        }
        h1 {
            color: #333333;
            text-align: center;
        }
        .subtitle {
            color: #333333;
            font-style: italic;
            text-align: center;
            margin-bottom: 20px;
        }
        .author {
            color: #555;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .news-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }
        .content {
            white-space: pre-wrap; 
            color: #333333;
            line-height: 1.6;
        }
        .btn-back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #ff0048c3;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-back:hover {
            background-color: #e60040;
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
    <div class="container">
        <h1><?php echo ($title); ?></h1>
            <p class="subtitle"><?php echo ($subtitle); ?></p>
            <p class="author">Tác giả: <?php echo ($author); ?></p>
            <img class="news-image" src="<?php echo ($image); ?>" alt="Ảnh bài báo">
        <div class="content">
            <h3>Nội dung bài báo:</h3>
            <p><?php echo ($content); ?></p>
        </div>
        <a href="trang_chu.php" class="btn-back">Quay lại <i style="padding-left: 10px;" class="fa fa-arrow-left" aria-hidden="true"></i></a>
    </div>

    <nav>
        <p style=" font-weight: bold; color:rgba(255, 166, 0, 0.977);">Nhóm 8</p>
        <div class="container_nav">
            <div class="div_nav">
                <i class="fa fa-facebook-official" aria-hidden="true"></i>
                <a href="">Facebook</a>
            </div>
            <div class="div_nav">
                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                <a href="">Youtube</a>
            </div>
            <div class="div_nav">
                <i class="fa fa-instagram" aria-hidden="true"></i>
                <a href="">Instagram</a>
            </div>
            <div class="div_nav">
                <i class="fa fa-twitter" aria-hidden="true"></i>
                <a href="">Twitter</a>
            </div>
            <div> 
                <p>Thành viên:</p>
                <ul>
                    <li>Nguyễn Đắc Tuấn Anh</li>
                    <li>Phạm Đức Anh</li>
                </ul>
            </div>
        </div>
    </nav>
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