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
        .container_body{
            display: flex;
            justify-content: space-between;
            padding-top: 20px;
        }
        .container_body_left{
            width: 69%;
            height: 800px;
            background-color: #b2cdffff;
        }
        .container_body_right{
            width: 30%;
            height: 800px;
            background-color: #b2fff1ff;
        }
        .menu{
            width: 95%;
            background-color: #f2f2f2;
            padding: 12px;
            border-radius: 20px;
            border:1px solid #ccff00;
            height: 235px;
            margin: 12px;
            display: flex;
        }
        .object_menu_left{
            width: 30%;
            background-color: #f2f2f2;
            padding: 12px;
            border-radius: 20px;
            border:1px solid #ccff00;
            margin-right: 12px;
        }
        .object_menu_right{
            width: 65%;
            background-color: #f2f2f2;
            padding: 12px;
            border-radius: 20px;
            border:1px solid #ccff00;
        }
        .img_menu{
            padding-top: 20px;
            display: block;
            border-radius: 20px;
        }
        .news{
            margin-left:12px;
            width: 90%;
            background-color: #f2f2f2;
            padding: 12px;
            border-radius: 20px;
            border:1px solid #ccff00;
            height: 150px;
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
        }
        .object_news_left{
            width: 100px;
            background-color: #f2f2f2;
            padding: 12px;
            border-radius: 20px;
            border:1px solid #ff0000ff;
            margin-right: 12px;
        }
        .object_news_right{
            width: auto;
            background-color: #f2f2f2;
            padding: 5px;
            border-radius: 20px;
            border:1px solid #ccff00;
        }
        .img_news{
            padding-top: 20px;
            display: block;
            border-radius: 20px;
        }
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
            <h1 style="text-align: center;color: #333333;padding:10px 100px ;"> Các bài học dành cho bé </h1>
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
        <div class="container_body_right">
            <h1 style="text-align: center;color: #333333;padding:10px 100px ;"> Một vài tin tức và sự kiện mới </h1>
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
                    ?>
                <div class="news">
                    <div class="object_news_left">
                        <img class="img_menu" src="<?php echo $image; ?>" alt="Ảnh đại diện" width="50">
                    </div>
                    <div class="object_news_right">
                        <h2 style="color: #333333;"><?php echo $Title; ?></h2>
                        <p style="color: #333333;"><?php echo $Content; ?></p>
                        <a style = "color: #ff0048c3;" href="trang_chu.php?page_layout=tin_tuc&id=<?php echo $newsID; ?>" class="btn btn-primary">Xem thêm<i style="padding-left:10px" class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    </div>
                    </div>
                <?php } ?>
                </div>
        </div>
    </div>
</body>
</html>