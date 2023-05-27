<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <form method="post" action="http://localhost/web/admin/admin.php" >
  <input type="submit" name="logout" value="Back">
  </form>
</head>
<body>
<form method="post">
<div class="form-group">
    <label for="inputsm">title :</label>
    <input class="form-control input-sm" id="inputsm" type="text" name ="title">
</div>
<div class="form-group">
  <label for="comment">Comment:</label>
  <textarea class="form-control" rows="5" id="comment" name ="content"></textarea>
</div>
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

<div class="form-group">
    <label for="inputsm">Tên tác giả :</label>
    <input class="form-control input-sm" id="inputsm" type="text" name ="author">
</div>
  <input type="submit" value="Thêm mới">
</form>
<?php
//Kết nối đến CSDL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data";
// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);
// Kiểm tra kết nối
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

// Thực hiện thêm mới bài viết vào CSDL
if(isset($_POST['title']) && isset($_POST['content']) && isset($_POST['category'])) {
   $title = $_POST['title'];
   $content = $_POST['content'];
   $category = $_POST['category'];
   $author = $_POST['author'];
   
if (!$title || !$content || !$author ) {
    echo '<script language="javascript"> alert("Không được bỏ trống !Vui lòng nhập đầy đủ ^^ "); window.location="http://localhost/web/admin/add_post.php";</script>';
    exit;
    }
   // Sử dụng câu lệnh SQL INSERT để thêm bài viết mới vào bảng posts
   $sql = "INSERT INTO posts (title, content, category, author) VALUES ('$title', '$content','$category','$author')";

   if ($conn->query($sql) === TRUE) {
    echo '<script language="javascript"> alert("Thêm mới bài viết thành công ! "); window.location="http://localhost/web/admin/admin.php";</script>';
   } else {
     echo "Lỗi: " . $sql . "<br>" . $conn->error;
   }
}
// Đóng kết nối
$conn->close();
?>
</body>
</html>
