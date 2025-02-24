<?php
// Kết nối cơ sở dữ liệu
require ("../connect.php");

// Lấy giá trị id của giày được chọn
$ma = $_POST['MaGiay'];

// Truy vấn để lấy danh sách size dựa trên giày được chọn
$query = "SELECT SizeGiay.MaSize, Size 
    FROM SizeGiay, ChiTietGiay
    WHERE SizeGiay.MaSize = ChiTietGiay.MaSize AND MaGiay='$ma'";
$result = mysqli_query($conn, $query);

// Tạo danh sách các tùy chọn cho select box size
$options = "";
if (mysqli_num_rows($result) > 0) {
    while ($rows = mysqli_fetch_row($result)) {
        $options .= "<option value='$rows[0]'>$rows[1]</option>";
    }
}

// Trả về các tùy chọn size
echo $options;
?>
