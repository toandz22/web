<html>
    <head>
        <title>Sửa đổi bài đăng</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <form method="post" action="http://localhost/web/admin/admin.php" >
        <input type="submit" name="logout" value="Back">
   </form>
<body>
    <div class="container">
            <h1 class="mb-4">Sửa đổi bài đăng</h1>
            <form method="post">
                <div class="form-group mb-3">
                    <label for="title">Tiêu đề:</label>
                    <input type="text" class="form-control" id="title" name="title" value="">
                </div>
                <div class="form-group mb-3">
                    <label for="content">Nội dung:</label>
                    <textarea class="form-control" id="content" name="content"></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="category">Danh Mục:</label>
                    <select class="form-control" id="category" name="category">
                        <option >Đời Sống</option>
                        <option >Thể Thao</option>
                        <option >Giải Trí</option>
                        <option >Drama</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="author">Tên ẩn danh:</label>
                    <input type="text" class="form-control" id="author" name="author" value="">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Lưu thay đổi</button>
            </form>
    </div>

</body>
</html>
<?php

// Kiểm tra xem người dùng đã đăng nhập chưa
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect('localhost', 'root', '', 'data');

// Lấy thông tin bài đăng từ cơ sở dữ liệu
$post_id = $_GET['id'];
$sql = "SELECT * FROM posts WHERE id='$post_id'";
$result = mysqli_query($conn, $sql);
$post = mysqli_fetch_assoc($result);

// Xử lý thay đổi dữ liệu bài đăng
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $sql = "UPDATE posts SET title='$title', content='$content', author='$author', category='$category' WHERE id='$post_id'";
    mysqli_query($conn, $sql);
    echo '<script language="javascript"> alert("Sửa bài viết thành công ! "); window.location="http://localhost/web/admin/admin.php";</script>';
    header("Refresh:2; url=view.php");
    exit();
}
?>
