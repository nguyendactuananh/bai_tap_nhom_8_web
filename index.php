<?php
require_once 'config.php';
session_start();
if (!isset($_SESSION['StudentID'])) {
    header("Location: login.php");
    exit();
}
// Giả định học sinh đã đăng nhập với StudentID
$studentID = "ST001"; // Thay bằng ID thực tế từ session sau khi đăng nhập

// Lấy danh sách bài học
$lessonsStmt = $conn->prepare("SELECT LessonID, LessonName, Description, Image FROM Lesson");
$lessonsStmt->execute();
$lessons = $lessonsStmt->fetchAll(PDO::FETCH_ASSOC);

// Lấy số bài kiểm tra đã hoàn thành
$testsStmt = $conn->prepare("SELECT COUNT(*) as test_count FROM TestResult WHERE StudentID = ?");
$testsStmt->execute([$studentID]);
$testCount = $testsStmt->fetch(PDO::FETCH_ASSOC)['test_count'];

// Lấy danh sách bài học đã học (dựa trên TestResult)
$completedLessonsStmt = $conn->prepare("
    SELECT DISTINCT l.LessonName 
    FROM TestResult tr 
    JOIN Test t ON tr.TestID = t.TestID 
    JOIN Lesson l ON t.LessonID = l.LessonID 
    WHERE tr.StudentID = ?
");
$completedLessonsStmt->execute([$studentID]);
$completedLessons = $completedLessonsStmt->fetchAll(PDO::FETCH_ASSOC);

// Lấy tin tức
$newsStmt = $conn->prepare("SELECT Title, Content FROM News ORDER BY CreatedDate DESC LIMIT 2");
$newsStmt->execute();
$news = $newsStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ - Nhóm 8</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Navigation -->
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold">Nhóm 8</div>
            <ul class="flex space-x-6">
                <li><a href="#" class="hover:underline">Trang chủ</a></li>
                <li><a href="#" class="hover:underline">Cá nhân</a></li>
                <li><a href="#" class="hover:underline">Cài đặt</a></li>
                <li><a href="#" class="hover:underline">Tra cứu từ tiếng Anh</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto p-6 flex flex-col md:flex-row gap-6">
        <!-- Left Section (70%) - Lessons -->
        <div class="w-full md:w-7/10 bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold mb-4">Danh sách bài học</h2>
            <div class="space-y-4">
                <?php foreach ($lessons as $lesson): ?>
                    <div class="border p-4 rounded flex items-center">
                        <img src="<?php echo htmlspecialchars($lesson['Image'] ?: 'https://via.placeholder.com/100'); ?>" 
                             alt="Lesson Image" class="w-24 h-24 mr-4 object-cover">
                        <div>
                            <h3 class="text-lg font-semibold"><?php echo htmlspecialchars($lesson['LessonName']); ?></h3>
                            <p class="text-gray-600"><?php echo htmlspecialchars($lesson['Description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Right Section (30%) - Stats and News -->
        <div class="w-full md:w-3/10 bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold mb-4">Thông tin cá nhân</h2>
            <div class="space-y-4">
                <div>
                    <h3 class="text-lg font-semibold">Thành tích</h3>
                    <p>Số bài kiểm tra đã hoàn thành: <span class="font-bold"><?php echo $testCount; ?></span></p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Bài học đã học</h3>
                    <ul class="list-disc pl-5">
                        <?php if (count($completedLessons) > 0): ?>
                            <?php foreach ($completedLessons as $lesson): ?>
                                <li><?php echo htmlspecialchars($lesson['LessonName']); ?></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>Chưa hoàn thành bài học nào.</li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Tin tức</h3>
                    <div class="space-y-2">
                        <?php if (count($news) > 0): ?>
                            <?php foreach ($news as $item): ?>
                                <div>
                                    <h4 class="font-semibold"><?php echo htmlspecialchars($item['Title']); ?></h4>
                                    <p class="text-gray-600"><?php echo htmlspecialchars($item['Content']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Chưa có tin tức.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>