<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="style.css"/>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
</head>
<button onclick >
	<a href="../">Trang Chủ</a>
</button>
<body>

<form method="post" action="register.php" class="form">
<h2>Đăng ký thành viên</h2>
<form>
<div class="form-group">
    <label for="name">Tên đăng nhập</label>
    Username: <input type="text" class="form-control" name="username"  placeholder="Nhập họ tên">
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control"name="email"  placeholder="Nhập email">
</div>
<div class="form-group">
    <label for="password">Mật khẩu</label>
     <input type="password" class="form-control"name="password" placeholder="Nhập mật khẩu">
</div>
<div class="form-group">
    <label for="text">Số Điện Thoại</label>
    Phone: <input type="text" class="form-control" name="phone" placeholder="Nhập số điện thoại">
</div>
  <input type='submit' class="button" name="dangky" value='Đăng ký'/>
<div class="back">
  <a href="http://localhost/web/dangnhap/login.php"> Đăng nhập </a> </p>
</div>
</form>
<?php require 'xuly.php';?>
</form>
</body>
</html>