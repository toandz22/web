<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title> Dashboard </title>
	<link rel="stylesheet" type="text/css" href="style.css">
  <title>blog</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.23.0/themes/prism.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.23.0/prism.min.js"></script>

<button onclick >
	<a href="../">Trang Chủ</a>
</button>

<body>
	<header>
		<h1>My Blog</h1>
        <?php
        echo"Bạn đang đăng nhập với tư cách là :" .$_SESSION["username"];
        ?>
	</header>
<div class="menu">
    <ul>
        <li><a href="view.php">Quản lí bài viết</a></li>
        <li><a href="add_post.php">Thêm mới bài viết </a></li>
    </ul>
</div>
<table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th> Tiêu đề </th>
                <th> Nội dung </th>
                <th> Danh Mục </th>
				        <th> Tác Gỉa </th>
				         <th> thời gian </th>
            </tr>
        </thead>
        <tbody id="myTable">
            <?php
//Kết nối tới database
$connect = mysqli_connect('localhost', 'root', '', 'data') or die('Không thể kết nối tới database');
mysqli_set_charset($connect, 'UTF8');
if ($connect === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
//Lấy danh sách các bài viết từ database
$query = "SELECT * FROM posts";
$result = mysqli_query($connect, $query);
$search_by = isset($_GET['search-by']) ? $_GET['search-by'] : 'title';
$search_term = isset($_GET['search']) ? $_GET['search'] : '';
if ($search_by === 'title') {
    $query = "SELECT * FROM posts WHERE title LIKE '%$search_term%'";
} else {
    $query = "SELECT * FROM posts WHERE category LIKE '%$search_term%'";
}

$result = mysqli_query($connect, $query);
//Hiển thị danh sách các bài viết

while ($row = mysqli_fetch_array($result)) {
    echo '<tr>';
    echo '<td>' . '<a href="../read_post.php?id=' . $row['id'] . '">' . $row['title'] . '</a>' . '</td>';
    echo '<td>' . substr($row['content'], 0, 60) . '....' . '</td>';
    echo '<td>' . $row['category'] . '</td>';
    echo '<td>' . $row['author'] . '</td>';
    echo '<td>' . $row['date'] . '</td>';
    echo '</tr>';
}
?>
</tbody>
</table>
	<script type="text/javascript" src="script.js"></script>
</body>
</html>

