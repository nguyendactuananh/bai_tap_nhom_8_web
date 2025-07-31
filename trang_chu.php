<?php
session_start();
include('connect.php');

// Kiểm tra đăng nhập
if (!isset($_SESSION['email']) || !isset($_SESSION['role'])) {
    header('location: login.php');
    exit();
}

// Xử lý page_layout
if (isset($_GET['page_layout'])) {
    switch ($_GET['page_layout']) {
        case 'cai_dat':
            include('cai_dat.php');
            break;
        case 'login':
            include('login.php');
            break;
        case 'dang_xuat':
            session_destroy();
            session_unset();
            header('location: login.php');
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="trang_chu.css" />
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
    <div class="container_body">
        <div class="container_body_left">
            <div class="lesson_frame">
                <h1 style="text-align: center;color: #333333;margin:20px;"> Các bài học dành cho bé </h1>
                <?php
                $sql = "SELECT * FROM lesson";
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
                        <img class="img_menu" src="<?php echo ($lesson_image); ?>" alt="Ảnh đại diện" width="90%"
                            height="150px">
                    </div>
                    <div class="object_menu_right">
                        <h2 style="color: #333333;"><?php echo ($lesson_name); ?></h2>
                        <p style="color: #333333;"><?php echo ($description); ?></p>
                        <p style="color: #333333;"><?php echo ($duration); ?></p>
                        <a style="color: #ff0048c3;" href="bai_hoc_detail.php?id=<?php echo $lessonId; ?>">Xem bài học<i
                                style="padding-left:10px" class="fa fa-arrow-right" aria-hidden="true"></i></a>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <a href="sua_bai_hoc.php?id=<?php echo $lessonId; ?>" class="btn btn-warning">Sửa</a>
                        <a href="xoa_bai_hoc.php?id=<?php echo $lessonId; ?>" class="btn btn-danger"
                            onclick="return confirm('Bạn có chắc muốn xóa bài học này?')">Xóa</a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php } ?>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <div style="text-align: center; margin: 20px;">
                    <a href="them_bai_hoc.php" class="btn btn-success">+ Thêm bài học mới</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="container_body_right">
            <div class="news_frame">
                <h1 style="text-align: center;color: #333333;margin:20px;"> Tin tức, sự kiện</h1>
                <?php
                $sql = "SELECT * FROM news";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $newsID = $row['NewsID'];
                    $title = $row['title'];
                    $content = $row['content'];
                    $author = $row['author'];
                    $image = $row['image'];
                    $subtitle = $row['subtitle'];
                    ?>
                <div class="news">
                    <div class="object_news_left">
                        <img class="img_menu" src="<?php echo ($image); ?>" alt="Ảnh đại diện" width="100%"
                            height="90%">
                    </div>
                    <div class="object_news_right">
                        <h2 style="color: #333333;"><?php echo ($title); ?></h2>
                        <p style="color: #333333;"><?php echo ($subtitle); ?></p>
                        <a style="color: #ff0048c3;" href="news_detail.php?id=<?php echo $newsID; ?>">Xem thêm<i
                                style="padding-left:10px" class="fa fa-arrow-right" aria-hidden="true"></i></a>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <a href="edit_news.php?id=<?php echo $newsID; ?>">Sửa</a>
                        <a href="delete_news.php?id=<?php echo $newsID; ?>"
                            onclick="return confirm('Bạn có chắc muốn xóa tin tức này?')">Xóa</a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php } ?>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <div style="text-align: center; margin-bottom: 20px;">
                    <a href="add_news.php">+ Thêm tin tức</a>
                </div>
                <?php endif; ?>
            </div>
            <div class="test_frame">
                <h1 style="text-align: center;color: #333333;margin:20px;"> Bài kiểm tra</h1>
                <?php
                $sql = "SELECT * FROM test";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $TestName = $row['test_name'];
                    $Description = $row['description'];
                    $TestID = $row['TestID'];
                    ?>
                <div class="news">
                    <div class="object_news">
                        <h2 style="color: #333333;"><?php echo ($TestName); ?></h2>
                        <p style="color: #333333;"><?php echo ($Description); ?></p>
                        <a style="color: #ff0048c3;" href="test_detail.php?id=<?php echo $TestID; ?>">Xem thêm<i
                                style="padding-left:10px" class="fa fa-arrow-right" aria-hidden="true"></i></a>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <a href="edit_test.php?id=<?php echo $TestID; ?>">Sửa</a>
                        <a href="delete_test.php?id=<?php echo $TestID; ?>"
                            onclick="return confirm('Bạn có chắc muốn xóa bài kiểm tra này?')">Xóa</a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php } ?>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <div style="text-align: center; margin-bottom: 20px;">
                    <a href="add_test.php">+ Thêm bài kiểm tra</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
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