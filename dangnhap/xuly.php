<?php
//Khai báo sử dụng session
session_start();
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');
//Xử lý đăng nhập
if (isset($_POST['dangnhap']))
{
//Kết nối tới database
include('connect.php');
  
//Lấy dữ liệu nhập vào
$username = addslashes($_POST['username']);
$password = addslashes($_POST['password']);
  
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$username || !$password) {
echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
  

//Kiểm tra tên đăng nhập có tồn tại không
$query = "SELECT username, password, role FROM member WHERE username='$username'";

$result = mysqli_query($connect, $query) or die( mysqli_error($connect));

if (!$result) {
echo "Tên đăng nhập hoặc mật khẩu không đúng!";
} 
  
//Lấy mật khẩu và role trong database ra
$row = mysqli_fetch_array($result);
$role = $row['role'];
//So sánh 2 mật khẩu có trùng khớp hay không
if ($password != $row['password']) {
    echo '<script language="javascript"> alert("Mật khẩu hoặc tài khoản không đúng. Vui lòng nhập lại. "); window.location="http://localhost/web/dangnhap/login.php";</script>';
exit;
}

//Lưu tên đăng nhập
$_SESSION['username'] = $username;
if ($role == 'admin') {
    //Chuyển hướng đến trang admin
    echo '<script language="javascript"> alert("Đăng nhập thành công! Xin chào '.$username.'"); window.location="http://localhost/web/admin/admin.php";</script>';
    exit;
} 
echo '<script language="javascript"> alert("Đăng nhập thành công! Xin chào '.$username.'"); window.location="http://localhost/web/user/user.php";</script>';

die();
$connect->close();
}
?>