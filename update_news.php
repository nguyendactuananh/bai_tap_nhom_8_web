<?php
session_start();
include('connect.php');

// Kiểm tra quyền admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: trang_chu.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $newsID = ($_POST['newsID']);
    $title = ($_POST['title']);
    $subtitle = ($_POST['subtitle']);
    $content = ($_POST['content']);
    $author = ($_POST['author']);

    // Kiểm tra các trường bắt buộc
    if (empty($title) || empty($subtitle) || empty($content) || empty($author)) {
        $_SESSION['error'] = 'Vui lòng điền đầy đủ';
        header("Location: edit_news.php?id=$newsID");
        exit();
    }
    // Lấy ảnh cũ
    $stmt = mysqli_prepare($conn, "SELECT image FROM news WHERE NewsID = ?");
    mysqli_stmt_bind_param($stmt, "i", $newsID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $old_image = $row['image'] ?? '';
    mysqli_stmt_close($stmt);

    $image = $old_image;

    // Xử lý tải ảnh mới
    if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === 0) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $max_size = 5 * 1024 * 1024; // 5MB

        $upload_dir = "img/news/";
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
        $new_image = $upload_dir . "news_" . time() . "." . $ext;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $new_image)) {
            if (!empty($old_image) && file_exists($old_image)) unlink($old_image);
            $image = $new_image;
        } else {
            $_SESSION['error'] = 'Lỗi khi tải ảnh lên.';
            header("Location: edit_news.php?id=$newsID");
            exit();
        }
    }

    // Cập nhật bài viết
    $sql = "UPDATE news SET title = ?, subtitle = ?, content = ?, author = ?, image = ? WHERE NewsID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssi", $title, $subtitle, $content, $author, $image, $newsID);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = 'Cập nhật bài học thành công!';
        header("Location: trang_chu.php");
        exit();
    } else {
        $_SESSION['error'] = 'Lỗi khi cập nhật: ' . mysqli_error($conn);
        header("Location: edit_news.php?id=$newsID");
        exit();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header('Location: trang_chu.php');
    exit();
}
?>