<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bài viết</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <form method="post" action="http://localhost/web/user/user.php" >
  <input type="submit" name="logout" value="Back">
  </form>
    <h1>Danh sách bài viết</h1>
    <table>
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Nội dung</th>
                <th>Danh Mục </th>
                <th>Tên ẩn danh </th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
<?php
//Kết nối tới database
include 'connect.php';
//Lấy danh sách các bài viết từ database
$query = "SELECT * FROM posts";
$result = mysqli_query($connect, $query);
//Hiển thị danh sách các bài viết
while ($row = mysqli_fetch_array($result)) {
    echo '<tr>';
    echo '<td>' . $row['title'] . '</td>';
    echo '<td>' . substr($row['content'], 0, 60) . '....' . '</td>';
    echo '<td>' . $row['category'] . '</td>';
    echo '<td>' . $row['author'] . '</td>';
    echo '<td><a href="edit_post.php?id=' . $row['id'] . '">Sửa</a> | <a href="delete_post.php?id=' . $row['id'] . '">Xóa</a></td>';
    echo '</tr>';
}
?>
        </tbody>
    </table>
</body>
</html>

