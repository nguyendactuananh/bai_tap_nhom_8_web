<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang giới thiệu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Body */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f9f9f9;
        }

        /* Header */
        header {
            margin: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 40px;
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 0 0 10px 10px;
        }

        .logo img {
            width: 150px;
            height: 50px;
            border-radius: 10px;
            border: 1px solid #b3c1eeff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .logo img:hover {
            transform: scale(1.05);
        }

        .login {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .login i {
            font-size: 20px;
            color: #333;
        }

        .login a {
            text-decoration: none;
            align-items: center;
            padding: 15px 20px;
            font-size: 16px;
            color: #333;
            border-radius: 5px;
            border: 1 solid rgb(244, 242, 242);
            transition: all 0.3s ease;
            background: rgb(244, 242, 242);
        }

        .login a:hover {
            background: linear-gradient(135deg, #00c3ff, #ffff1c);
            color: #000;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            transform: scale(1.05);
        }

        /* Main */
        main {
            margin: 10px 5px 10px 5px;
            padding: 40px;
            text-align: center;
            background: lightblue;
            border-radius: 10px 10px 0 0;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
        }

        .gioi-thieu {
            width: 61%;
            margin: 0 auto;
        }

        main h1 {
            line-height: 1.3;
            font-size: 32px;
            color: #333;
            margin-bottom: 20px;
        }

        main p {
            font-size: 18px;
            color: #302f2f;
            line-height: 1.6;
            text-align: left;
        }

        .container {
            margin-top: 40px;
            padding: 10px;
            padding-bottom: 30px;
            background-color: rgb(248, 246, 246);
            border: 1px solid #ccff00;
            border-radius: 3px;
            width: 100%;
            justify-content: space-between;
        }

        .infor-container {
            display: flex;
        }

        .infor {
            width: 30%;
            margin: 15px 30px;
            padding: 10px;
            background-color: white;
            border: 2px solid #c3bbefff;
            border-radius: 15px;

        }

        .infor:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .infor img {
            margin-top: 10px;
            margin-bottom: 30px;
            width: 85%;
            height: 350px;
            border-radius: 20px;
            border: 1px solid #b3c1eeff;
            transition: transform 0.3s ease;
        }

        /* Footer */
        footer {
            display: flex;
            margin: 0;
            padding: 15px 40px;
            background-color: #c9c7c7ff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px 10px 0 0;
        }

        .logo-footer {
            display: flex;
            align-items: center;
        }

        .logo-footer img {
            width: 150px;
            height: 100px;
            border-radius: 10px;
            border: 1px solid #7d93aaff;
        }

        .main-footer {
            margin: 0 auto;
        }

        .icon {
            display: flex;
            gap: 30px;
            font-size: 25px;
            margin: 20px 0 30px 0;
        }

        .icon a {
            text-decoration: none;
            color: #000;
        }

        .icon-infor {
            padding: 5px;
        }

        .icon-infor:hover {
            background: linear-gradient(135deg, #00c3ff, #ffff1c);
            color: #000;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            transform: scale(1.05);
        }

        .intro {
            line-height: 1.6;
            width: 60%;
            margin-left: 30px;
        }
    </style>
</head>

<body>

    <header>
        <div class="logo">
            <img src="../img/logo.png" alt="Logo website">
        </div>
        <div class="login">
            <a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Hãy đăng nhập để sử dụng dịch vụ của
                chúng tôi!</a>
        </div>
    </header>

    <main>
        <div class="gioi-thieu">
            <h1>Chào mừng bạn đến với StarEnglish<br>Nền tảng học tiếng Anh trực tuyến hoàn toàn miễn phí!</h1>
            <hr><br>
            <p>Được thiết kế để giúp bạn chinh phục ngôn ngữ toàn cầu một cách nhanh chóng, hiệu quả và bền vững.
                Chúng tôi tin rằng bất kỳ ai cũng có thể thành thạo tiếng Anh nếu có phương pháp đúng đắn và công cụ hỗ
                trợ phù hợp.<br>
                Đến với dịch vụ học tiếng Anh trực tuyến miễn phí, giúp bạn học nhanh - nhớ lâu - ứng dụng hiệu quả.
                Khám phá các khóa học hấp dẫn!
            </p>
        </div>
        <div class="container">
            <h1 style="margin:30px;">Những bài học tiêu biểu của StarEnglish được nhiều người lựa chọn:</h1>
            <div class="infor-container">
                <div class="infor">
                    <h4>Tiếng Anh Toàn Diện Theo Chuẩn Cambridge</h4>
                    <img src="../img/logo.png">
                </div>
                <div class="infor">
                    <h4>Tiếng Anh Toàn Diện Theo Chuẩn Cambridge</h4>
                    <img src="../img/logo.png">
                </div>
                <div class="infor">
                    <h4>Tiếng Anh Toàn Diện Theo Chuẩn Cambridge</h4>
                    <img src="../img/logo.png">
                </div>
            </div>
            <div class="infor-container">
                <div class="infor">
                    <h4>Tiếng Anh Toàn Diện Theo Chuẩn Cambridge</h4>
                    <img src="../img/logo.png">
                </div>
                <div class="infor">
                    <h4>Tiếng Anh Toàn Diện Theo Chuẩn Cambridge</h4>
                    <img src="../img/logo.png">
                </div>
                <div class="infor">
                    <h4>Tiếng Anh Toàn Diện Theo Chuẩn Cambridge</h4>
                    <img src="../img/logo.png">
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="logo-footer">
            <img src="../img/logo.png" alt="Logo website">
        </div>
        <div class="main-footer">
            <div class="icon">
                <div class="icon-infor">
                    <i class="fa fa-facebook-official" aria-hidden="true"></i>
                    <a href="">Facebook</a>
                </div>
                <div class="icon-infor">
                    <i class="fa fa-youtube-play" aria-hidden="true"></i>
                    <a href="">Youtube</a>
                </div>
                <div class="icon-infor">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                    <a href="">Instagram</a>
                </div>
                <div class="icon-infor">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                    <a href="">Twitter</a>
                </div>
            </div>

            <div class="intro">
                <h3>Thành viên:</h3>
                <ul>Nguyễn Đắc Tuấn Anh - 2221050045</ul>
                <ul>Phạm Đức Anh - 2221050045</ul>
            </div>
        </div>
    </footer>

</body>

</html>