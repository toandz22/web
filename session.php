<?php
session_start();
if(isset($_POST['logout'])) {
// Xóa tất cả các biến session và hủy toàn bộ session
session_unset();
session_destroy();
header('Location: ../web/index.php');
exit;
}
?>