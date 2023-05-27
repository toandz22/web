<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="style.css"/>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
</head>
<body>
   <form method="post" action="add_user.php" class="form">
      <h2>Thêm thành viên</h2>
   <form>
   <div class="form-group">
      <label for="name">Tên đăng nhập</label>
      <input type="text" class="form-control" name="username"  placeholder="Nhập họ tên">
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
      <input type="text" class="form-control" name="phone" placeholder="Nhập số điện thoại">
    </div>
    <div class="form-group mb-3" >
      <label for="category">Role: </label>
      <select name="role">
        <option value="admin">admin</option>
        <option value="user">user</option>
      </select>
    </div>
      <input type='submit' class="button" name="dangky" value='Add user'/>
    </form>
    </form>
<?php require 'xuly.php';?>
</body>
</html>