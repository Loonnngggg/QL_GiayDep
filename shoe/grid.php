<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin giày</title>
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php //include("../header.php"); ?>
    <?php
        session_start();
        if ($_SESSION['Quyen'] == 0) {
            include ("../header_admin.php");
        } elseif ($_SESSION['Quyen'] == 1) {
            include ("../header_nv.php");
        } else {
            include ("../header.php");
        }
    ?>
    <section class="grid">
        <div class="container">
            <div class="row">
                <div class="grid-left">
                    <h3>LOẠI GIÀY</h3>
                    <ul>
                    <?php 
                    require ("../connect.php");
                    $sql = "SELECT MaLG, TenLG
                            FROM LoaiGiay";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) <> 0) {
                        while ($row = mysqli_fetch_row($result)) {
                            echo "<li><a href='". $_SERVER['PHP_SELF'] . "?MaLG=$row[0]" ."'>$row[1]</a>";
                            echo "</li>";
                        }
                    }
                    ?>
                    </ul>
                    <h3>HÃNG GIÀY</h3>
                    <ul>
                    <?php 
                    $sql = "SELECT MaHG, TenHG
                            FROM HangGiay";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) <> 0) {
                        while ($row = mysqli_fetch_row($result)) {
                            echo "<li><a href='". $_SERVER['PHP_SELF'] . "?MaHG=$row[0]" ."'>$row[1]</a>";
                            echo "</li>";
                        }
                    }
                    ?>
                    </ul>
                </div>
                <div class="grid-right">
                    <div class="grid-right-top row">
                        <div class="grid-right-top-item">
                            <?php
                            $rowsPerPage = 8; //số mẩu tin trên mỗi trang
                            if (!isset($_GET['page'])) {
                                $_GET['page'] = 1;
                            }
                            //vị trí của mẩu tin đầu tiên trên mỗi trang
                            $offset = ($_GET['page'] - 1) * $rowsPerPage;

                            if (isset($_GET['MaLG']))
                                $maLG = $_GET['MaLG'];
                            else $maLG = '';

                            if (isset($_GET['MaHG']))
                                $maHG = $_GET['MaHG'];
                            else $maHG = '';

                            if (isset($_GET['TenGiay']))
                                $tenGiay = trim($_GET['TenGiay']);
                            else $tenGiay = '';

                            $sql = "SELECT MaGiay, TenGiay, Gia, Anh1
                                    FROM Giay
                                    WHERE MaLG LIKE '$maLG%' AND MaHG LIKE '$maHG%' AND TenGiay LIKE '%$tenGiay%'
                                    LIMIT $offset, $rowsPerPage";
                            $result = mysqli_query($conn, $sql);

                            $re = mysqli_query($conn, "SELECT * FROM Giay WHERE MaLG LIKE '$maLG%' AND MaHG LIKE '$maHG%'");
                            $numRows = mysqli_num_rows($re); //tổng số mẩu tin cần hiển thị
                            if ($numRows % $rowsPerPage == 0)
                                $maxPage = $numRows / $rowsPerPage;
                            else
                                $maxPage = floor($numRows / $rowsPerPage) + 1; //tổng số trang
                            $first = $offset + 1; // vị trí đầu
                            $last = $offset + mysqli_num_rows($result); // vị trí cuối

                            echo "<p>Đã hiển thị $first - $last trên tổng số $numRows sản phẩm </p>";
                            ?>
                        </div>
                        <div class="grid-right-top-item">
                            <select name="" id="">
                                <option value="">Sắp xếp</option>
                                <option value="">Giá cao đến thấp</option>
                                <option value="">Giá thấp đến cao</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid-right-content row">
                        <?php
                        if (mysqli_num_rows($result) <> 0) {
                            while ($row = mysqli_fetch_row($result)) {
                                echo "<div class='grid-right-content-item'>
                                    <a href='detail.php?MaGiay=$row[0]'><img src='images/$row[3]' alt=''></a>
                                    <a href='detail.php?MaGiay=$row[0]'><h1>$row[1]</h1></a>
                                    <p>$row[2] VNĐ</p>
                                </div>";
                            }
                        }
                        else echo "<font color='red' size='5'>Không tìm thấy thông tin giày</font>";
                        ?>
                    </div>
                    
                    <div class="grid-right-bottom">
                        <?php
                        $strGet = "";
                        if (isset($_GET['MaLG']) && isset($_GET['MaHG']) && isset($_GET['TenGiay']))
                            $strGet = "MaLG=$maLG&MaHG=$maHG&TenGiay=$tenGiay&";
                        elseif (isset($_GET['MaLG']) && isset($_GET['MaHG']))
                            $strGet = "MaLG=$maLG&MaHG=$maHG&";
                        elseif (isset($_GET['MaLG']) && isset($_GET['TenGiay']))
                            $strGet = "MaLG=$maLG&TenGiay=$tenGiay&";
                        elseif (isset($_GET['MaHG']) && isset($_GET['TenGiay']))
                            $strGet = "MaHG=$maHG&TenGiay=$tenGiay&";
                        else {
                            if (isset($_GET['MaLG']))
                                $strGet = "MaLG=$maLG&";
                            elseif (isset($_GET['MaHG']))
                                $strGet = "MaHG=$maHG&";
                            elseif (isset($_GET['TenGiay']))
                                $strGet = "TenGiay=$tenGiay&";
                            else $strGet = "";
                        } 

                        echo "<p>";
    
                        //nút Back
                        if ($_GET['page'] > 1) {
                            echo "<a href=" . $_SERVER['PHP_SELF'] . "?" . $strGet . "page=1> << </a> ";
                            echo "<a href=" . $_SERVER['PHP_SELF'] . "?" . $strGet . "page=" . ($_GET['page'] - 1) . "> < </a> ";
                        }

                        //tạo link tương ứng tới các trang
                        for ($i = 1; $i <= $maxPage; $i++) {
                            if ($i == $_GET['page']) {
                                echo '<b>' . $i . '</b> '; //trang hiện tại sẽ được bôi đậm
                            } else
                                echo "<a href=" . $_SERVER['PHP_SELF'] . "?" . $strGet . "page=" . $i . ">" . $i . "</a> ";
                        }

                        //nút Next
                        if ($_GET['page'] < $maxPage) {
                            echo "<a href=" . $_SERVER['PHP_SELF'] . "?" . $strGet . "page=" . ($_GET['page'] + 1) . "> > </a>";
                            echo "<a href=" . $_SERVER['PHP_SELF'] . "?" . $strGet . "page=" . $maxPage . "> >> </a>";
                        }
                        echo "</p>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include("../footer.php"); ?>
</body>
</html>