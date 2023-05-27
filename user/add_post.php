<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <form method="post" action="http://localhost/web/user/user.php" >
  <input type="submit" name="logout" value="Back">
  </form>
</head>
<body>
<form method="post">
  <label>Tiêu đề:</label><br>
  <input type="text" name="title"><br>
  <label>Nội dung:</label><br>
  <textarea name="content"></textarea><br>
  <label>Danh Mục:</label><br>
  <div class="form-group">
  <label for="sel1">Select category:</label>
  <select class="form-control" name="category" id="sel1">
    <option>Đời Sống</option>
    <option>Thể Thao</option>
    <option>Giải Trí</option>
    <option>Drama</option>
  </select>
  </div>
  <label>Ảnh:</label><br>
<input type="file" name="image"><br>

  <label>Tên tác giả(ẩn danh):</label><br>
  <input type="text" name="author"><br>
  <input type="submit" value="Thêm mới">
</form>
<?php require 'xuly.php' ?>
</body>
</html>
