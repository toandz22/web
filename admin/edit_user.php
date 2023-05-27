<html>
    <head>
        <title>edit user</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script>
          function showErrorMessage() {
          alert("Bạn không được phép chỉnh sửa tài khoản này!");
        }
        </script>
    </head>
    <body>
    <form method="post" action="http://localhost/web/admin/admin.php" >
        <input type="submit" name="logout" value="Back">
   </form>
        <div class="container">
            <h1 class="mb-4">edit user</h1>
            <form method="post">
                <div class="form-group mb-3">
                    <label for="title">username: </label>
                    <input type="text" class="form-control" id="username" name="username" value="" required>
                </div>
                <div class="form-group mb-3">
                    <label for="content">password: </label>
                    <input type="text" class="form-control" id="password" name="password" value="" required>
                </div>
                <div class="form-group mb-3">
                    <label for="category">email: </label>
                    <input type="text" class="form-control" id="email" name="email" value="" required>
                </div>
                <div class="form-group mb-3">
                    <label for="category">Phone: </label>
                    <input type="text" class="form-control" id="phone" name="phone" value="" required>
                </div>
                <div class="form-group mb-3">
                    <label for="category">Role: </label>
                    <select name ="role">
                        <option value="admin">admin</option>
                        <option value="user">user</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Lưu thay đổi</button>
            </form>
            
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
<?php

// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect('localhost', 'root', '', 'data');

// Lấy thông tin 
$user_id = $_GET['id'];
$sql = "SELECT * FROM member WHERE id='$user_id'  ";
$result = mysqli_query($conn, $sql);
$post = mysqli_fetch_assoc($result);
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    if ($post['role'] == 'admin') {
        // Hiển thị thông báo lỗi bằng JavaScript
        echo '<script>showErrorMessage();</script>';
      } else {
    $sql = "UPDATE member SET username='$username', password='$password', email='$email', phone='$phone', role='$role' WHERE id='$user_id' and role='user'";
    mysqli_query($conn, $sql);
    echo '<script language="javascript"> alert("edit thành công ! "); window.location="http://localhost/web/admin/admin.php";</script>';
    header("Refresh:2; url=view.php");
    exit();
}
}
?>
