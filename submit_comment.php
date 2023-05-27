<?php
// Kết nối database
$connect = mysqli_connect('localhost', 'root', '', 'data');

// Lấy thông tin bình luận từ form
$name = $_POST['name'];
$email = $_POST['email'];
$content = $_POST['content'];
$post_id = $_POST['post_id'];

// Thêm bình luận vào database
$query = "INSERT INTO comments (post_id, name, email, content) VALUES ('$post_id', '$name', '$email', '$content')";
mysqli_query($connect, $query);

// Chuyển hướng trở lại trang read
header('Location: read_post.php?id=' . $post_id);
?>