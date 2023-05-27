<?php
$connect = mysqli_connect ('localhost', 'root', '', 'data') or die ('Không thể kết nối tới database');
mysqli_set_charset($connect, 'UTF8');
if($connect === false){ 
die("ERROR: Could not connect. " . mysqli_connect_error()); 
}
// Lấy ID của comment từ yêu cầu POST
$id = $_POST['id'];

// Xóa comment khỏi database
$query = "DELETE FROM comments WHERE id = $id";
$result = mysqli_query($connect, $query);

if($result == true){
    echo '<script language="javascript"> alert("Xóa comment thành công ! "); window.location="http://localhost/web/index.php";</script>';
}
?>
 