<?php
session_start();
include('connect.php');

// Kiểm tra đăng nhập và quyền admin
if (!isset($_SESSION['email']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('location: login.php');
    exit();
}

// Kiểm tra dữ liệu từ form
if (
    !empty($_POST['title']) &&
    !empty($_POST['subtitle']) &&
    !empty($_POST['content']) &&
    !empty($_POST['author']) &&
    isset($_FILES['image']) && $_FILES['image']['error'] == 0
) {
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $content = $_POST['content'];
    $author = $_POST['author'];

    // Xử lý ảnh
    $upload_dir = "img/news/";
    $target_file = $upload_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File không phải là ảnh.";
        $uploadOk = 0;
    }

    if (file_exists($target_file)) {
        echo "File này đã tồn tại.";
        $uploadOk = 0;
    }

    if ($_FILES["image"]["size"] > 5242880) {
        echo "File quá lớn. Vui lòng chọn file dưới 5MB.";
        $uploadOk = 0;
    }

    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        echo "Chỉ chấp nhận JPG, JPEG, PNG, GIF.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Thêm tin tức vào CSDL
            $stmt = mysqli_prepare($conn, "INSERT INTO news (title, subtitle, content, author, image) VALUES (?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "sssss", $title, $subtitle, $content, $author, $target_file);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            // Chuyển hướng về trang chủ
            header('Location: trang_chu.php?page_layout=tintuc');
            exit();
        } else {
            echo "Lỗi khi tải ảnh lên.";
        }
    } else {
        echo "Ảnh không hợp lệ. File chưa được tải lên.";
    }

} else {
    echo "Vui lòng điền đầy đủ thông tin và chọn hình ảnh.";
}
?>
