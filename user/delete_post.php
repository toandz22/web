<?php
//Khai báo sử dụng session
session_start();

//Kiểm tra đăng nhập
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

//Kiểm tra id của bài viết cần xóa
if (!isset($_GET['id'])) {
    header('Location: user.php');
    exit;
}
$id = $_GET['id'];

//Kết nối tới database
include('connect.php');

//Xác nhận yêu cầu xóa bài viết từ người dùng
if (isset($_POST['delete_post'])) {
    $confirm = $_POST['confirm_delete'];
    if ($confirm == 'yes') {
        //Xóa bài viết khỏi database
        $query = "DELETE FROM posts WHERE id='$id'";
        $result = mysqli_query($connect, $query);

        //Thông báo kết quả xóa bài viết
        if ($result == true) {
            echo '<script language="javascript"> alert("Xóa bài viết thành công ! "); window.location="http://localhost/web/user/user.php";</script>';
        } else {
            echo "Lỗi: " . mysqli_error($connect);
        }
    } else {
        //Nếu người dùng không xác nhận xóa bài viết, chuyển hướng về trang quản lý bài viết
        header('Location: view.php');
        exit;
    }
}

$connect->close();
?>
<div class='del'>
<form method="post" action="">
  <p>Bạn có chắc chắn muốn xóa bài viết này không?</p>
  <input type="radio" name="confirm_delete" value="yes"> Có
  <input type="radio" name="confirm_delete" value="no" checked> Không
  <br><br>
  <input type="submit" name="delete_post" value="xác nhận">
</form>
</div>
