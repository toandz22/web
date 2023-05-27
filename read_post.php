
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.raty/2.9.0/jquery.raty.min.js"></script>

	<style type="text/css">
		body {
			font-family: Arial, sans-serif;
			background-color: #f1f1f1;
			margin: 0;
			padding: 0;
		}

		.container {
			max-width: 800px;
			margin: 0 auto;
			padding: 20px;
			background-color: #fff;
			box-shadow: 0 0 10px rgba(0,0,0,0.2);
		}

		h1,  {
			font-size: 36px;
			margin-bottom: 20px;
		}
        h2{
            font-size: 24px;
			margin-bottom: 20px;
        }

		p {
			font-size: 18px;
			line-height: 1.5;
		}

        button{
            font-size: 15px;
			line-height: 1.5;
        }
		.comment-form {
            position: fixed;
            bottom: 0;
         }
         .comment {
  background-color: #f9f9f9;
  border-radius: 5px;
  padding: 10px;
  margin-bottom: 20px;
}

.comment {
  background-color: #f9f9f9;
  border-radius: 5px;
  padding: 10px;
  margin-bottom: 20px;
}

.comment p:first-of-type {
  font-weight: bold;
  margin-bottom: 5px;
}

.comment p:last-of-type {
  margin-top: 10px;
}


	</style>
</head>
<body>
<form method="post" action="http://localhost/web" >
  <input type="submit" name="logout" value="Back">
  </form>
  
<?php
//Kết nối tới database
//Kết nối tới database
$connect = mysqli_connect('localhost', 'root', '', 'data') or die('Không thể kết nối tới database');
mysqli_set_charset($connect, 'UTF8');
if ($connect === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());}
//Lấy ID của bài viết từ URL
$id = $_GET['id'];
//Lấy thông tin bài viết từ database
$query = "SELECT * FROM posts WHERE id = $id";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_array($result);

//Hiển thị nội dung bài viết
echo '<h1>' . $row['title'] . '</h1>';
echo '<div style="background-color: #fff; border: 1px solid #ccc; padding: 10px;">' . $row['content'] . '</div>';

?>
</body>
<form method="post" action="submit_comment.php">
  <div class="form-group">
    <label for="name">Tên:</label>
    <input type="text" name="name" id="name" class="form-control" required>
  </div>
  <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" class="form-control" required>
  </div>
  <div class="form-group">
    <label for="content">Nội dung comment:</label>
    <textarea name="content" id="content" class="form-control" required></textarea>
  </div>
  <input type="hidden" name="post_id" value="<?php echo $row['id']; ?>">
  <button type="submit" class="btn btn-primary">Gửi bình luận</button>
  
</form>

<!-- Phần comment -->

<?php
// Lấy các comment từ database
$query = "SELECT * FROM comments WHERE post_id = $id ORDER BY created_at DESC";
$result = mysqli_query($connect, $query);

echo "<h2><br> Comment: </br></h2>";
// Hiển thị các comment
while ($row = mysqli_fetch_assoc($result)) {
  echo '<div class="comment">';
  echo '<p><strong>' . $row['name'] . '</strong> - ' . $row['created_at'] . '</p>';
  echo '<p>' . $row['content'] . '</p>';
  echo '<form method="post" action="delete_comment.php">';
  echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
  echo '<button type="submit" class="btn btn-outline-danger">Xóa</button>';
  echo '</form>';
  echo '</div>';
  
}
?>
</html>

