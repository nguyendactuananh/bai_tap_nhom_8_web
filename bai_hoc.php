<?php
// File này hiện tại có vẻ giống với trang_chu.php
// Nếu bạn muốn tạo một trang riêng để hiển thị danh sách bài học
// thì có thể sử dụng code này:

session_start();
include('connect.php');

// Kiểm tra đăng nhập
if (!isset($_SESSION['email']) || !isset($_SESSION['role'])) {
    header('location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bài học</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="trang_chu.css" />
</head>

<body>
    <!-- Header -->
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

    <!-- Main -->
    <div class="container_body">
        <div style="width: 100%; padding: 20px;">
            <div class="lesson_frame" style="width: 100%; height: auto;">
                <h1 style="text-align: center;color: #333333;margin:20px;"> Tất cả các bài học </h1>
                <?php
                $sql = "SELECT * FROM lesson ORDER BY LessonID ASC";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $lessonId = $row['LessonID'];
                    $lesson_name = $row['lesson_name'];
                    $description = $row['description'];
                    $duration = $row['duration'];
                    $lesson_image = $row['lesson_image'];
                    $content = $row['content'];
                    ?>
                <div class="menu">
                    <div class="object_menu_left">
                        <!-- Lấy ảnh bài học -->
                        <img class="img_menu" src="<?php echo ($lesson_image); ?>" alt="Ảnh bài học" width="100%">
                    </div>
                    <div class="object_menu_right">
                        <!-- Lấy stt bài học -->
                        <h2 style="color: #333333;">Bài <?php echo $lessonId; ?>:
                            <?php echo ($lesson_name); ?></h2>
                        <!-- Lấy tiêu đề bài học -->
                        <p style="color: #333333;"><?php echo ($description); ?></p>
                        <!-- Lấy thời lượng bài học -->
                        <p style="color: #666; font-size: 14px;">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            Thời lượng: <?php echo ($duration); ?> phút
                        </p>
                        <!-- Chuyển đến trang xem bài học -->
                        <a style="color: #ff0048c3;" href="bai_hoc_detail.php?id=<?php echo $lessonId; ?>">
                            Xem chi tiết bài học
                            <i style="padding-left:10px" class="fa fa-arrow-right" aria-hidden="true"></i>
                        </a>
                        <!-- Kiểm tra role admin để thực hiện các chức năng -->
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <br><br>
                        <!-- Sửa bài học -->
                        <a href="sua_bai_hoc.php?id=<?php echo $lessonId; ?>" class="btn btn-warning">Sửa</a>
                        <!-- Xóa bài học -->
                        <a href="xuly_xoa_bai_hoc.php?id=<?php echo $lessonId; ?>" class="btn btn-danger"
                            onclick="return confirm('Bạn có chắc muốn xóa bài học này?')">Xóa</a>
                        <?php endif; ?>
                    </div>

                </div>
                <?php } ?>
            </div>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <div style="text-align: center; margin: 20px;">
                <a href="them_bai_hoc.php" class="btn btn-success">+ Thêm bài học mới</a>
            </div>
            <?php endif; ?>
        </div>

    </div>

    <!-- Footer -->
    <hr>
    <nav>
        <p style="font-weight: bold; color:rgba(255, 166, 0, 0.977);">Nhóm 8</p>
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