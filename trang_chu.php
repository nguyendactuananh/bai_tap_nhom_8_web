<?php
    include('config.php');
    if (isset($_GET['page_layout'])) {
        switch ($_GET['page_layout']) {
            case 'ca_nhan':
                include('ca_nhan.php');
                break;
            case 'cai_dat':
                include('cai_dat.php');
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="trang_chu.css" />
    <style>

    </style>
    
</head>
<body>
    <nav>
        <p style="font-weight: bold; color:rgba(255, 166, 0, 0.977);">Nhóm 8</p>
        <div class="container_nav">
            <div class="div_nav">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                <a href="trang_chu.php?page_layout=dang_xuat">Đăng xuất</a>
            </div>
            <div class="div_nav">
                <i class="fa fa-home" aria-hidden="true"></i>
                <a href="trang_chu.php">Trang chủ</a>
            </div>
            <div class="div_nav">
                <i class="fa fa-user" aria-hidden="true"></i>
                 <a href="trang_chu.php?page_layout=ca_nhan">Cá nhân</a>
            </div>
            <div class="div_nav">
                <i class="fa fa-wrench" aria-hidden="true"></i>
                <a href="trang_chu.php?page_layout=cai_dat">cài đặt</a>
            </div>
            <input class="input_search" type="text" placeholder="Dịch tiếng anh">
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
                    $lessonName = $row['LessonName'];
                    $description = $row['Description'];
                    $img = $row['img'];
                    ?>
            <div class="menu">
                <div class="object_menu_left">
                    <img class="img_menu" src="<?php echo $img; ?>" alt="Ảnh đại diện" width="50">
                </div>
                <div class="object_menu_right">
                    <h2 style="color: #333333;"><?php echo $lessonName; ?></h2>
                    <p style="color: #333333;"><?php echo $description; ?></p>
                    <a style = "color: #ff0048c3;" href="trang_chu.php?page_layout=bai_hoc&id=<?php echo $lessonId; ?>" class="btn btn-primary">Xem bài học<i style="padding-left:10px" class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </div>
                </div>
                <?php } ?>
            </div>
            </div>
        <div class="container_body_right">
            <div class="news_frame">
                <h1 style="text-align: center;color: #333333;margin:20px  ;"> Tin tức, sự kiện</h1>
                <?php
                    $sql = "SELECT * FROM news";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $newsID = $row['NewsID'];
                        $Title = $row['Title'];
                        $Content = $row['Content'];
                        $CreatedDate = $row['CreatedDate'];
                        $AdminID = $row['AdminID'];
                        $image = $row['image'];
                        $subtitle = $row['Subtitle'];
                        ?>
                    <div class="news">
                        <div class="object_news_left">
                            <img class="img_menu" src="<?php echo $image; ?>" alt="Ảnh đại diện" width="50">
                        </div>
                        <div class="object_news_right">
                            <h2 style="color: #333333;"><?php echo $Title; ?></h2>
                            <p style="color: #333333;"><?php echo $subtitle; ?></p>
                            <a style = "color: #ff0048c3;" href="trang_chu.php?page_layout=tin_tuc&id=<?php echo $newsID; ?>" class="btn btn-primary">Xem thêm<i style="padding-left:10px" class="fa fa-arrow-right" aria-hidden="true"></i></a>
                        </div>
                        </div>
                    <?php } ?>
                </div>
            <div class="test_frame">
                <h1 style="text-align: center;color: #333333;margin:20px  ;"> Bài kiểm tra</h1>
                <?php
                    $sql = "SELECT * FROM test";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $TestName = $row['TestName'];
                        $Description = $row['Description'];
                        $TestID = $row['TestID'];
                        ?>
                    <div class="news">
                        <div class="object_news">
                            <h2 style="color: #333333;"><?php echo $TestName; ?></h2>
                            <p style="color: #333333;"><?php echo $Description; ?></p>
                            <a style = "color: #ff0048c3;" href="trang_chu.php?page_layout=tin_tuc&id=<?php echo $TestID; ?>" class="btn btn-primary">Xem thêm<i style="padding-left:10px" class="fa fa-arrow-right" aria-hidden="true"></i></a>
                        </div>
                        </div>
                    <?php } ?>
            </div>
        </div>
    </div>
    <hr>
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
</body>
</html>