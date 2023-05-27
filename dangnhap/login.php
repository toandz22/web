<!DOCTYPE html> 
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<link rel="stylesheet" href="style.css"/> 
<title>Login</title>
<script>
function togglePassword() {
    var passwordInput = document.getElementById("password");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}
</script>
<button onclick >
	<a href="../">Trang Chủ</a>
</button>
</head> 
<body> 
  <form action='login.php' class="dangnhap" method='POST'> 
    <h2> Tên đăng nhập : 
    <input type='text' name='username'placeholder="Nhập username" /> 
    <h2> Mật khẩu : 
<input type='password' name='password' id="password" placeholder="Nhập password" > 
    <!-- <button type="button" onclick="togglePassword()">Hiển thị mật khẩu</button><br> -->
    <input type='submit' class="button" name="dangnhap" value='Đăng nhập' /><br>
   <a href='http://localhost/web/dangky/register.php' title='Đăng ký'> Chưa có tài khoản ?</a> 
<?php require 'xuly.php';?> 
  </form> 
</body> 
</html>
