<?php
include('config.php');
session_start();
require_once 'config.php';
if (isset($_SESSION['StudentID'])) {
    header("Location: trang_chu.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentID = trim($_POST['student_id'] ?? '');
    $password  = trim($_POST['password'] ?? '');

    if ($studentID === '' || $password === '') {
        $error = 'Vui lòng nhập đầy đủ mã sinh viên và mật khẩu.';
    } else {
        $stmt = $conn->prepare("SELECT StudentID, Password FROM Student WHERE StudentID = ?");
        $stmt->bind_param('s', $studentID);
        $stmt->execute();

        // Lấy kết quả như với PDO (chỉ hoạt động nếu PHP có mysqlnd)
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            if (password_verify($password, $user['Password'])) {
                $_SESSION['StudentID'] = $user['StudentID'];
                header("Location:trang_chu.php");
                exit();
            } else {
                $error = 'Mật khẩu không đúng.';
            }
        } else {
            $error = 'Mã sinh viên không tồn tại.';
        }

        $stmt->close();
    }
}
?>
<!-- HTML giống trước, nhớ dùng <form> -->

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Nhóm 8</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-blue-600">Nhóm 8</h1>
            <h2 class="text-xl font-semibold mt-2">Đăng nhập</h2>
        </div>

        <?php if ($error): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <!-- FORM ĐĂNG NHẬP -->
        <form action="" method="POST" class="space-y-4">
            <div>
                <label for="student_id" class="block text-sm font-medium text-gray-700">Mã sinh viên</label>
                <input type="text" name="student_id" id="student_id" 
                       class="mt-1 w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500" 
                       required>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Mật khẩu</label>
                <input type="password" name="password" id="password" 
                       class="mt-1 w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500" 
                       required>
            </div>
            <button type="submit" 
                    class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
                Đăng nhập
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
            Chưa có tài khoản? <a href="register.php" class="text-blue-600 hover:underline">Đăng ký</a>
        </p>
    </div>
</body>
</html>
