<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"> <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="js/jquery-1.11.1.min.js"></script>
    <title>Dashboard</title>
</head>
<style>
    .panel-table .panel-body {
padding:0;
}
.panel-table .panel-body .table-bordered {
border-style: none;
margin:0;
}
.panel-table .panel-body .table-bordered > thead > tr > th:first-of-type {
text-align:center;  width: 100px;}.panel-table .panel-body .table-bordered > thead > tr > th:last-of-type, .panel-table .panel-body .table-bordered > tbody > tr > td:last-of-type {
border-right: 0px;
}
.panel-table .panel-body .table-bordered > thead > tr > th:first-of-type, .panel-table .panel-body .table-bordered > tbody > tr > td:first-of-type {
border-left: 0px;
}
.panel-table .panel-body .table-bordered > tbody > tr:first-of-type > td {
border-bottom: 0px;
}
.panel-table .panel-body .table-bordered > thead > tr:first-of-type > th {
border-top: 0px;
}
.panel-table .panel-footer .pagination {
margin:0;
}
.panel-table .panel-footer .col {
line-height: 34px;
height: 34px;
}
.panel-table .panel-heading .col h3 {
line-height: 30px;
height: 30px;
}
.panel-table .panel-body .table-bordered > tbody > tr > td {
line-height: 34px;
}
.panel-title{
    font-size: 40px;
    font-weight: bold;
    color: black;
}
.hidden-xs, th{
    background-color: silver;
}
h1{
    text-align: center;
    font-size: 35px;
    font-weight: bold;
    color: black;
    
}
h4{
    text-align: center;
    font-weight: bold;
    color: black; 
}
</style>
<form method="post" action="http://localhost/web/index.php" >
    <input type="submit" name="logout" value="Home">
</form>
<body>
    <h1>Trang Quản trị </h1>
    <?php
        echo"<h4>"."Bạn đang đăng nhập với tư cách là :" .$_SESSION["username"]."</h4>";
    ?>
<div class="panel-footer">
     <div class="row">
      <div class="col col-xs-8">
       <ul class="pagination hidden-xs pull-right">
       </ul>
       <ul class="pagination visible-xs pull-right">
        </li>
       </ul>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>
<div class="panel panel-default panel-table">
    <div class="panel-heading">
        <div class="row">
            <div class="col col-xs-6">
                <h3 class="panel-title">Danh sách User</h3>
            </div>
            <div class="col col-xs-6 text-right">
            <a href="../admin/add_user.php"><button type="button" class="btn btn-sm btn-primary btn-create" >Thêm mới</button></a>
            </div>
        </div>
    </div>
    <div class="panel-body">
    <table class="table table-striped table-bordered table-list">
        <thead>
         <tr>
          <th class="hidden-xs">id</th>
          <th>username</th>
          <th>Email</th>
          <th>Role</th>
          <th><em class="fa fa-cog"></em>
          </th>
         </tr>
        </thead>
      <tbody><tr>
<?php

//Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//Lấy danh sách user từ cơ sở dữ liệu
$sql_user = "SELECT * FROM member ";
$result_user = mysqli_query($conn, $sql_user);

//Hiển thị danh sách user
while ($row_user = mysqli_fetch_assoc($result_user)) {
    echo "<tr>";
    echo "<td>" . $row_user['id'] . "</td>";
    echo "<td>" . $row_user['username'] . "</td>";
    echo "<td>" . $row_user['email'] . "</td>";
    echo "<td>" . $row_user['role'] . "</td>";
    echo "<td><a href='edit_user.php?id=" . $row_user['id'] . "'>Edit</a> | <a href='delete_user.php?id=" . $row_user['id'] . "'>Delete</a></td>";
    echo "</tr>";
}
mysqli_close($conn);

?>
     </tbody></table>
    </div>
    <div class="panel-footer">
     <div class="row">
      <div class="col col-xs-8">
       <ul class="pagination hidden-xs pull-right">
       </ul>
       <ul class="pagination visible-xs pull-right">
        </li>
       </ul>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>
<div class="panel panel-default panel-table">
    <div class="panel-heading">
        <div class="row">
            <div class="col col-xs-6">
                <h3 class="panel-title">Danh sách bài viết</h3>
            </div>
            <div class="col col-xs-6 text-right">
                <a href="../admin/add_post.php"><button type="button" class="btn btn-sm btn-primary btn-create" >Thêm mới</button></a>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered table-list">
            <thead>
                <tr>
                    <th class="hidden-xs">id</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th><em class="fa fa-cog"></em></th>
                </tr>
            </thead>
            <tbody>
<?php
$current_username = $_SESSION['username'];
//Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//Lấy danh sách user từ cơ sở dữ liệu
$sql_post = "SELECT * FROM posts ";
$result_post = mysqli_query($conn, $sql_post);

//Hiển thị danh sách user
while ($row_post = mysqli_fetch_assoc($result_post)) {
    echo "<tr>";
    echo "<td>" . $row_post['id'] . "</td>";
    echo "<td>" . $row_post['title'] . "</td>";
    echo '<td>' . substr($row_post['content'], 0, 60) . '....' . '</td>';
    echo "<td>" . $row_post['category'] . "</td>";
    echo "<td>" . $row_post['author'] . "</td>";
    echo "<td>" . $row_post['date'] . "</td>";
    echo "<td><a href='edit_post.php?id=" . $row_user['id'] . "'>Edit</a> | <a href='delete_post.php?id=" . $row_user['id'] . "'>Delete</a></td>";
    echo "</tr>";
}
mysqli_close($conn);

?>
            </tbody>
        </table>
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col col-xs-8">
                <ul class="pagination hidden-xs pull-right"></ul>
                <ul class="pagination visible-xs pull-right"></ul>
            </div>
        </div>
    </div>
</div>

</body>
</html>