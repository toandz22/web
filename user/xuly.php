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
    echo '<script language="javascript"> alert("Không được bỏ trống !Vui lòng nhập đầy đủ ^^ "); window.location="http://localhost/web/user/add_post.php";</script>';
    exit;
    }
   // Sử dụng câu lệnh SQL INSERT để thêm bài viết mới vào bảng posts
   $sql = "INSERT INTO posts (title, content, category, author) VALUES ('$title', '$content','$category','$author')";

   if ($conn->query($sql) === TRUE) {
    echo '<script language="javascript"> alert("Thêm mới bài viết thành công ! "); window.location="http://localhost/web/user/user.php";</script>';
   } else {
     echo "Lỗi: " . $sql . "<br>" . $conn->error;
   }
}


// Đóng kết nối
$conn->close();
?>
