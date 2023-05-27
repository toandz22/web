<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$user_id = $_GET['id'];
// Lấy thông tin user từ database
$sql_select = "SELECT * FROM member WHERE id = $user_id";
$result_select = mysqli_query($conn,$sql_select);
$row = mysqli_fetch_assoc($result_select);

// Kiểm tra nếu user có role là admin thì hiển thị thông báo và dừng chương trình
if ($row['role'] == 'admin') {
  die('<script language="javascript"> alert("Không được phép xóa tài khoản admin!"); window.location="http://localhost/web/admin/admin.php";</script>');
}
// Nếu không phải là tài khoản admin thì tiến hành xóa user
$sql_delete = "DELETE FROM member WHERE id = $user_id";
$result_delete = mysqli_query($conn,$sql_delete);

if($result_delete == true){
    echo '<script language="javascript"> alert("Xóa user thành công ! "); window.location="http://localhost/web/admin/admin.php";</script>';
}

mysqli_close($conn);

?>