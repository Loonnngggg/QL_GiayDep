<?php
// Kết nối CSDL
$conn = mysqli_connect('localhost', 'root', '', 'giaydepnt')
    or die('Không thể kết nối tới database' . mysqli_connect_error());
mysqli_set_charset($conn, 'UTF8'); // lệnh để hiển thị tiếng Việt khi bị lỗi
?>