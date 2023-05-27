<?php
//Khai báo sử dụng session
session_start();

//Kiểm tra id của bài viết cần xóa
if (!isset($_GET['id'])) {
    header('Location: admin.php');
    exit;
}

$id = $_GET['id'];

//Kết nối tới database
$connect = mysqli_connect ('localhost', 'root', '', 'data') or die ('Không thể kết nối tới database');
mysqli_set_charset($connect, 'UTF8');
if($connect === false){ 
die("ERROR: Could not connect. " . mysqli_connect_error()); 
}
//Xác nhận yêu cầu xóa bài viết từ người dùng
if (isset($_POST['delete_post'])) {
    $confirm = $_POST['confirm_delete'];
    if ($confirm == 'yes') {
        
        //Xóa bài viết khỏi database
        $query = "DELETE FROM posts WHERE id='$id'";
        $result = mysqli_query($connect, $query);

        //Thông báo kết quả xóa bài viết
        if ($result == true) {
            echo '<script language="javascript"> alert("Xóa bài viết thành công ! "); window.location="http://localhost/web/admin/admin.php";</script>';
        } else {
            echo "Lỗi: " . mysqli_error($connect);
        }
    } else {
        //Nếu người dùng không xác nhận xóa bài viết, chuyển hướng về trang quản lý bài viết
        header('Location: admin.php');
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
